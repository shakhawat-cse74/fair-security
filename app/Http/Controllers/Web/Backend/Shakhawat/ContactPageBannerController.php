<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactPageBanner;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;

class ContactPageBannerController extends Controller
{
    public function getData(Request $request)
    {
        $data = ContactPageBanner::latest()->get();

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
            $contactPageBanners = ContactPageBanner::all();
            return view('backend.layouts.contact_page_banner.index', compact('contactPageBanners'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve contact page banners.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.contact_page_banner.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load contact page banner creation form.');
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

            $contactPageBanner = new ContactPageBanner();
            $contactPageBanner->title = $request->title;
            $contactPageBanner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                $contactPageBanner->image = $imageService->uploadImage($request->file('image'), 'uploads/contact_page_banners', 1200, 400);
            } else {
                $contactPageBanner->image = 'admin/assets/images/default.png';
            }
            $contactPageBanner->status = $request->status ?? 1;
            $contactPageBanner->save();

            return redirect()->route('contact-page-banners.index')->with('success', 'Contact page banner created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create contact page banner.');
        }
    }

    public function edit($id)
    {
        try {
            $contactPageBanner = ContactPageBanner::findOrFail($id);
            return view('backend.layouts.contact_page_banner.edit', compact('contactPageBanner'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load contact page banner edit form.');
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

            $contactPageBanner = ContactPageBanner::findOrFail($id);
            $contactPageBanner->title = $request->title;
            $contactPageBanner->sub_title = $request->sub_title;
            if ($request->hasFile('image')) {
                // Delete the old image
                $imageService->deleteImage($contactPageBanner->image);
                // Upload the new image
                $contactPageBanner->image = $imageService->uploadImage($request->file('image'), 'uploads/contact_page_banners', 1200, 400);
            }
            $contactPageBanner->status = $request->status ?? 1;
            $contactPageBanner->save();

            return redirect()->route('contact-page-banners.index')->with('success', 'Contact page banner updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update contact page banner.');
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $contactPageBanner = ContactPageBanner::findOrFail($id);
            $contactPageBanner->status = $request->status;
            $contactPageBanner->save();

            return response()->json(['success' => true, 'message' => 'Contact page banner status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update contact page banner status.'], 500);
        }
    }

    public function destroy($id, ImageService $imageService)
    {
        try {
            $contactPageBanner = ContactPageBanner::findOrFail($id);
            // Delete the associated image
            $imageService->deleteImage($contactPageBanner->image);
            $contactPageBanner->delete();

            return redirect()->route('contact-page-banners.index')->with('success', 'Contact page banner deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete contact page banner.');
        }
    }
}
