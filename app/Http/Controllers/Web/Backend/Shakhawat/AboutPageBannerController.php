<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPageBanner;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;

class AboutPageBannerController extends Controller
{
    public function getData(Request $request)
    {
        $data = AboutPageBanner::latest()->get();

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
            $aboutPageBanners = AboutPageBanner::all();
            return view('backend.layouts.about_page_banner.index', compact('aboutPageBanners'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve about page banners.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.about_page_banner.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load about page banner creation form.');
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

            $aboutPageBanner = new AboutPageBanner();
            $aboutPageBanner->title = $request->title;
            $aboutPageBanner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                $aboutPageBanner->image = $imageService->uploadImage($request->file('image'), 'uploads/about_page_banners', 1200, 400);
            } else {
                $aboutPageBanner->image = 'admin/assets/images/default.png';
            }
            $aboutPageBanner->status = $request->status ?? 1;
            $aboutPageBanner->save();

            return redirect()->route('about-page-banners.index')->with('success', 'About page banner created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create about page banner.');
        }
    }

    public function edit($id)
    {
        try {
            $aboutPageBanner = AboutPageBanner::findOrFail($id);
            return view('backend.layouts.about_page_banner.edit', compact('aboutPageBanner'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load about page banner edit form.');
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

            $aboutPageBanner = AboutPageBanner::findOrFail($id);
            $aboutPageBanner->title = $request->title;
            $aboutPageBanner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                // Delete the old image
                $imageService->deleteImage($aboutPageBanner->image);
                // Upload the new image
                $aboutPageBanner->image = $imageService->uploadImage($request->file('image'), 'uploads/about_page_banners', 1200, 400);
            }
            $aboutPageBanner->status = $request->status ?? 1;
            $aboutPageBanner->save();

            return redirect()->route('about-page-banners.index')->with('success', 'About page banner updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update about page banner.');
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $aboutPageBanner = AboutPageBanner::findOrFail($id);
            $aboutPageBanner->status = $request->status;
            $aboutPageBanner->save();

            return response()->json(['success' => true, 'message' => 'About page banner status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update about page banner status.'], 500);
        }
    }

    public function destroy($id, ImageService $imageService)
    {
        try {
            $aboutPageBanner = AboutPageBanner::findOrFail($id);
            // Delete the associated image
            $imageService->deleteImage($aboutPageBanner->image);
            $aboutPageBanner->delete();

            return redirect()->route('about-page-banners.index')->with('success', 'About page banner deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete about page banner.');
        }
    }
}
