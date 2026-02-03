<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;
use Exception;

class GalleryController extends Controller
{
    public function getData(Request $request)
    {
        $data = Gallery::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('title', function ($row) {
                return $row->title ?? '-';
            })

            ->addColumn('image', function ($row) {
                $images = json_decode($row->image, true);

                if (!$images || !is_array($images)) {
                    $url = asset('admin/assets/images/default.png');
                    return '<img src="' . $url . '" width="50" height="50" class="rounded" style="object-fit: cover;" />';
                }

                $html = '';
                foreach ($images as $img) {
                    $url = asset($img);
                    $html .= '<img src="' . $url . '" width="50" height="50" class="me-1 mb-1 rounded" style="object-fit: cover;" />';
                }

                return $html;
            })

            ->rawColumns(['image'])
            ->make(true);
    }

    public function index()
    {
        try {
            $galleries = Gallery::latest()->get();
            return view('backend.layouts.gallery.index', compact('galleries'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve galleries.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.gallery.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load gallery creation form.');
        }
    }

    public function store(Request $request, ImageService $imageService)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'status' => 'nullable|boolean',
        ]);

        try {
            $gallery = new Gallery();
            $gallery->title = $request->title;
            $gallery->status = 1;

            $imagePaths = [];

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $imagePaths[] = $imageService->uploadImage($file, 'uploads/galleries');
                }
            } else {
                $imagePaths[] = 'admin/assets/images/default.png';
            }

            $gallery->image = json_encode($imagePaths);
            $gallery->save();

            return redirect()->route('galleries.index')->with('success', 'Gallery created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create gallery.');
        }
    }

    public function edit($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            return view('backend.layouts.gallery.edit', compact('gallery'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load gallery edit form.');
        }
    }

    public function update(Request $request, $id, ImageService $imageService)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'status' => 'nullable',
        ]);

        try {
            $gallery = Gallery::findOrFail($id);

            // Update title
            $gallery->title = $request->title;
            
            // Keep existing status or default to 1 if not set
            $gallery->status = $gallery->status ?? 1;

            // Get old images
            $existingImages = json_decode($gallery->image, true) ?? [];

            // Store new uploaded images
            $newImages = [];
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $newImages[] = $imageService->uploadImage($file, 'uploads/galleries');
                }
            }

            // Merge old + new images (Appending as requested)
            $finalImages = array_merge($existingImages, $newImages);

            // Save back to DB
            $gallery->image = json_encode($finalImages);
            $gallery->save();

            return redirect()->route('galleries.index')->with('success', 'Gallery updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update gallery.');
        }
    }

    public function deleteSingleImage(Request $request, ImageService $imageService)
    {
        try {
            $gallery = Gallery::findOrFail($request->id);
            $images = json_decode($gallery->image, true) ?? [];

            // Remove only selected image
            $newImages = array_values(array_filter($images, function ($img) use ($request) {
                return $img !== $request->image;
            }));

            // Delete file physically
            if ($request->image) {
                $imageService->deleteImage($request->image);
            }

            // Save remaining images
            $gallery->image = json_encode($newImages);
            $gallery->save();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image: ' . $e->getMessage()
            ], 500);
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            $gallery->status = $request->status;
            $gallery->save();

            return response()->json([
                'success' => true,
                'message' => 'Gallery status updated successfully.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update gallery status.'
            ], 500);
        }
    }
    

    public function destroy($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);

            $images = json_decode($gallery->image, true) ?? [];

            foreach ($images as $img) {
                if (file_exists(public_path($img))) {
                    unlink(public_path($img));
                }
            }

            $gallery->delete();

            return redirect()->route('galleries.index')->with('success', 'Gallery deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete gallery.');
        }
    }
}
