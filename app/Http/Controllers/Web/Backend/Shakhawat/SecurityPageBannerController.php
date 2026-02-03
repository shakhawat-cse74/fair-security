<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SecurityPageBanner;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;

class SecurityPageBannerController extends Controller
{
    public function getData(Request $request)
    {
        $data = SecurityPageBanner::latest()->get();

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
            $securityPageBanners = SecurityPageBanner::all();
            return view('backend.layouts.security_page_banner.index', compact('securityPageBanners'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve security page banners.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.security_page_banner.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load security page banner creation form.');
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

            $securityPageBanner = new SecurityPageBanner();
            $securityPageBanner->title = $request->title;
            $securityPageBanner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                $securityPageBanner->image = $imageService->uploadImage($request->file('image'), 'uploads/security_page_banners', 1200, 400);
            } else {
                $securityPageBanner->image = 'admin/assets/images/default.png';
            }
            $securityPageBanner->status = $request->status ?? 1;
            $securityPageBanner->save();

            return redirect()->route('security-page-banners.index')->with('success', 'Security page banner created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create security page banner.');
        }
    }

    public function edit($id)
    {
        try {
            $securityPageBanner = SecurityPageBanner::findOrFail($id);
            return view('backend.layouts.security_page_banner.edit', compact('securityPageBanner'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load security page banner edit form.');
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

            $securityPageBanner = SecurityPageBanner::findOrFail($id);
            $securityPageBanner->title = $request->title;
            $securityPageBanner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                // Delete the old image
                $imageService->deleteImage($securityPageBanner->image);
                // Upload the new image
                $securityPageBanner->image = $imageService->uploadImage($request->file('image'), 'uploads/security_page_banners', 1200, 400);
            }
            $securityPageBanner->status = $request->status ?? 1;
            $securityPageBanner->save();

            return redirect()->route('security-page-banners.index')->with('success', 'Security page banner updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update security page banner.');
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $securityPageBanner = SecurityPageBanner::findOrFail($id);
            $securityPageBanner->status = $request->status;
            $securityPageBanner->save();

            return response()->json(['success' => true, 'message' => 'Security page banner status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update security page banner status.'], 500);
        }
    }

    public function destroy($id, ImageService $imageService)
    {
        try {
            $securityPageBanner = SecurityPageBanner::findOrFail($id);
            // Delete the associated image
            $imageService->deleteImage($securityPageBanner->image);
            $securityPageBanner->delete();

            return redirect()->route('security-page-banners.index')->with('success', 'Security page banner deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete security page banner.');
        }
    }
}
