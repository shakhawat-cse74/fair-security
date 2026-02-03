<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManagementPageBanner;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;

class ManagementPageBannerController extends Controller
{
    public function getData(Request $request)
    {
        $data = ManagementPageBanner::latest()->get();

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
            $managementPageBanners = ManagementPageBanner::all();
            return view('backend.layouts.management_page_banner.index', compact('managementPageBanners'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve management page banners.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.management_page_banner.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load management page banner creation form.');
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

            $managementPageBanner = new ManagementPageBanner();
            $managementPageBanner->title = $request->title;
            $managementPageBanner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                $managementPageBanner->image = $imageService->uploadImage($request->file('image'), 'uploads/management_page_banners', 1200, 400);
            } else {
                $managementPageBanner->image = 'admin/assets/images/default.png';
            }
            $managementPageBanner->status = $request->status ?? 1;
            $managementPageBanner->save();

            return redirect()->route('management-page-banners.index')->with('success', 'Management page banner created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create management page banner.');
        }
    }

    public function edit($id)
    {
        try {
            $managementPageBanner = ManagementPageBanner::findOrFail($id);
            return view('backend.layouts.management_page_banner.edit', compact('managementPageBanner'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load management page banner edit form.');
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

            $managementPageBanner = ManagementPageBanner::findOrFail($id);
            $managementPageBanner->title = $request->title;
            $managementPageBanner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                // Delete the old image
                $imageService->deleteImage($managementPageBanner->image);
                // Upload the new image
                $managementPageBanner->image = $imageService->uploadImage($request->file('image'), 'uploads/management_page_banners', 1200, 400);
            }
            $managementPageBanner->status = $request->status ?? 1;
            $managementPageBanner->save();

            return redirect()->route('management-page-banners.index')->with('success', 'Management page banner updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update management page banner.');
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $managementPageBanner = ManagementPageBanner::findOrFail($id);
            $managementPageBanner->status = $request->status;
            $managementPageBanner->save();

            return response()->json(['success' => true, 'message' => 'Management page banner status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update management page banner status.'], 500);
        }
    }

    public function destroy($id, ImageService $imageService)
    {
        try {
            $managementPageBanner = ManagementPageBanner::findOrFail($id);
            // Delete the associated image
            $imageService->deleteImage($managementPageBanner->image);
            $managementPageBanner->delete();

            return redirect()->route('management-page-banners.index')->with('success', 'Management page banner deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete management page banner.');
        }
    }
}
