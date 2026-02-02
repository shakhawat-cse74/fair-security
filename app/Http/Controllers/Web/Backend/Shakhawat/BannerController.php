<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;


class BannerController extends Controller
{
    public function getData(Request $request)
    {
        $data = Banner::latest()->get();

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
            $banners = Banner::all();
            return view('backend.layouts.banner.index', compact('banners'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve banners.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.banner.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load banner creation form.');
        }
    }

    public function store(Request $request, ImageService $imageService)
    {
        try {
            $request->validate([
                'title'     => 'nullable|string|max:255',
                'sub_title' => 'nullable|string|max:255',
                'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                'status'    => 'nullable|boolean',
            ]);

            $banner = new Banner();
            $banner->title = $request->title;
            $banner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                $banner->image = $imageService->uploadImage($request->file('image'), 'uploads/banners', 1200, 400);
            }
            $banner->status = $request->status ?? 1;
            $banner->save();

            return redirect()->route('banners.index')->with('success', 'Banner created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create banner.');
        }
    }

    public function edit($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            return view('backend.layouts.banner.edit', compact('banner'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load banner edit form.');
        }
    }

    public function update(Request $request, $id, ImageService $imageService)
    {
        try {
            $request->validate([
                'title'     => 'nullable|string|max:255',
                'sub_title' => 'nullable|string|max:255',
                'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
                'status'    => 'nullable|boolean',
            ]);

            $banner = Banner::findOrFail($id);
            $banner->title = $request->title;
            $banner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                // Delete the old image
                $imageService->deleteImage($banner->image);
                // Upload the new image
                $banner->image = $imageService->uploadImage($request->file('image'), 'uploads/banners', 1200, 400);
            }
            $banner->status = $request->status ?? 1;
            $banner->save();

            return redirect()->route('banners.index')->with('success', 'Banner updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update banner.');
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $banner = Banner::findOrFail($id);
            $banner->status = $request->status;
            $banner->save();

            return response()->json(['success' => true, 'message' => 'Banner status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update banner status.'], 500);
        }
    }

    public function destroy($id, ImageService $imageService)
    {
        try {
            $banner = Banner::findOrFail($id);
            // Delete the associated image
            $imageService->deleteImage($banner->image);
            $banner->delete();

            return redirect()->route('banners.index')->with('success', 'Banner deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete banner.');
        }
    }
}
