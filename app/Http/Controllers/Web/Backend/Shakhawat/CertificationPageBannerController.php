<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CertificationPageBanner;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;

class CertificationPageBannerController extends Controller
{
    public function getData(Request $request)
    {
        $data = CertificationPageBanner::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('title', function ($row) {
                return $row->title;
            })

            ->addColumn('sub_title', function ($row) {
                return $row->sub_title;
            })

            ->addColumn('image', function ($row) {
                $url = $row->image ? asset($row->image) : asset('admin/assets/images/default.png');
                return '<img src="' . $url . '" class="rounded" width="50" height="50" style="object-fit: cover;" />';
            })

            ->addColumn('status', function ($row) {
                return (int) $row->status;
            })

            ->rawColumns(['image', 'status'])
            ->make(true);
    }

    public function index()
    {
        try {
            $certificationPageBanners = CertificationPageBanner::all();
            return view('backend.layouts.certification_page_banner.index', compact('certificationPageBanners'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve certification page banners.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.certification_page_banner.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load certification page banner creation form.');
        }
    }

    public function store(Request $request, ImageService $imageService)
    {
        try {
            $request->validate([
                'title'     => 'nullable|string|max:255',
                'sub_title' => 'nullable|string|max:255',
                'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                'status'    => 'nullable|boolean',
            ]);

            $certificationPageBanner = new CertificationPageBanner();
            $certificationPageBanner->title = $request->title;
            $certificationPageBanner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                $certificationPageBanner->image = $imageService->uploadImage($request->file('image'), 'uploads/certification_page_banners', 1200, 400);
            } else {
                $certificationPageBanner->image = 'admin/assets/images/default.png';
            }
            $certificationPageBanner->status = $request->status ?? 1;
            $certificationPageBanner->save();

            return redirect()->route('certification-page-banners.index')->with('success', 'Certification page banner created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create certification page banner.');
        }
    }

    public function edit($id)
    {
        try {
            $certificationPageBanner = CertificationPageBanner::findOrFail($id);
            return view('backend.layouts.certification_page_banner.edit', compact('certificationPageBanner'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load certification page banner edit form.');
        }
    }

    public function update(Request $request, $id, ImageService $imageService)
    {
        try {
            $request->validate([
                'title'     => 'nullable|string|max:255',
                'sub_title' => 'nullable|string|max:255',
                'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                'status'    => 'nullable|boolean',
            ]);

            $certificationPageBanner = CertificationPageBanner::findOrFail($id);
            $certificationPageBanner->title = $request->title;
            $certificationPageBanner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                // Delete the old image
                $imageService->deleteImage($certificationPageBanner->image);
                // Upload the new image
                $certificationPageBanner->image = $imageService->uploadImage($request->file('image'), 'uploads/certification_page_banners', 1200, 400);
            }
            $certificationPageBanner->status = $request->status ?? 1;
            $certificationPageBanner->save();

            return redirect()->route('certification-page-banners.index')->with('success', 'Certification page banner updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update certification page banner.');
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $certificationPageBanner = CertificationPageBanner::findOrFail($id);
            $certificationPageBanner->status = $request->status;
            $certificationPageBanner->save();

            return response()->json(['success' => true, 'message' => 'Certification page banner status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update certification page banner status.'], 500);
        }
    }

    public function destroy($id, ImageService $imageService)
    {
        try {
            $certificationPageBanner = CertificationPageBanner::findOrFail($id);
            // Delete the associated image
            $imageService->deleteImage($certificationPageBanner->image);
            $certificationPageBanner->delete();

            return redirect()->route('certification-page-banners.index')->with('success', 'Certification page banner deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete certification page banner.');
        }
    }
}
