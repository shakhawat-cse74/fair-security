<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServicePageBanner;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;

class ServicePageBannerController extends Controller
{
    public function getData(Request $request)
    {
        $data = ServicePageBanner::latest()->get();

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
            $servicePageBanners = ServicePageBanner::all();
            return view('backend.layouts.service_page_banner.index', compact('servicePageBanners'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve service page banners.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.service_page_banner.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load service page banner creation form.');
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

            $servicePageBanner = new ServicePageBanner();
            $servicePageBanner->title = $request->title;
            $servicePageBanner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                $servicePageBanner->image = $imageService->uploadImage($request->file('image'), 'uploads/service_page_banners', 1200, 400);
            } else {
                $servicePageBanner->image = 'admin/assets/images/default.png';
            }
            $servicePageBanner->status = $request->status ?? 1;
            $servicePageBanner->save();

            return redirect()->route('service-page-banners.index')->with('success', 'Service page banner created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create service page banner.');
        }
    }

    public function edit($id)
    {
        try {
            $servicePageBanner = ServicePageBanner::findOrFail($id);
            return view('backend.layouts.service_page_banner.edit', compact('servicePageBanner'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load service page banner edit form.');
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

            $servicePageBanner = ServicePageBanner::findOrFail($id);
            $servicePageBanner->title = $request->title;
            $servicePageBanner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                // Delete the old image
                $imageService->deleteImage($servicePageBanner->image);
                // Upload the new image
                $servicePageBanner->image = $imageService->uploadImage($request->file('image'), 'uploads/service_page_banners', 1200, 400);
            }
            $servicePageBanner->status = $request->status ?? 1;
            $servicePageBanner->save();

            return redirect()->route('service-page-banners.index')->with('success', 'Service page banner updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update service page banner.');
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $servicePageBanner = ServicePageBanner::findOrFail($id);
            $servicePageBanner->status = $request->status;
            $servicePageBanner->save();

            return response()->json(['success' => true, 'message' => 'Service page banner status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update service page banner status.'], 500);
        }
    }

    public function destroy($id, ImageService $imageService)
    {
        try {
            $servicePageBanner = ServicePageBanner::findOrFail($id);
            // Delete the associated image
            $imageService->deleteImage($servicePageBanner->image);
            $servicePageBanner->delete();

            return redirect()->route('service-page-banners.index')->with('success', 'Service page banner deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete service page banner.');
        }
    }
}
