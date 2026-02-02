<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurServices;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;

class OurServicesController extends Controller
{
    public function getData(Request $request)
    {
        $data = OurServices::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('name', function ($row) {
                return $row->name;
            })

            ->addColumn('description', function ($row) {
                return $row->description;
            })

            ->addColumn('image', function ($row) {
                $url = $row->image ? asset($row->image) : asset('admin/assets/images/default.png');
                return '<img src="' . $url . '" class="rounded" width="100" height="40" />';
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
            $ourServices = OurServices::all();
            return view('backend.layouts.our_services.index', compact('ourServices'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve our services.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.our_services.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load our services creation form.');
        }
    }

    public function store(Request $request, ImageService $imageService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'status' => 'nullable|boolean',
        ]);

        try {
            $ourService = new OurServices();
            $ourService->name = $request->name;
            $ourService->description = $request->description;
            $ourService->status = $request->status ?? 1;

            if ($request->hasFile('image')) {
                $imagePath = $imageService->uploadImage($request->file('image'), 'uploads/our_services');
                $ourService->image = $imagePath;
            }

            $ourService->save();

            return redirect()->route('our-services.index')->with('success', 'Our Service created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create our service.');
        }
    }

    public function edit($id)
    {
        try {
            $ourService = OurServices::findOrFail($id);
            return view('backend.layouts.our_services.edit', compact('ourService'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load our services edit form.');
        }
    }

    public function update(Request $request, $id, ImageService $imageService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'status' => 'nullable|boolean',
        ]);

        try {
            $ourService = OurServices::findOrFail($id);
            $ourService->name = $request->name;
            $ourService->description = $request->description;
            $ourService->status = $request->status ?? 1;

            if ($request->hasFile('image')) {
                $imagePath = $imageService->uploadImage($request->file('image'), 'uploads/our_services');
                $ourService->image = $imagePath;
            }

            $ourService->save();

            return redirect()->route('our-services.index')->with('success', 'Our Service updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update our service.');
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $ourService = OurServices::findOrFail($id);
            $ourService->status = $request->status;
            $ourService->save();

            return response()->json(['success' => true, 'message' => 'Our Service status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update our service status.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $ourService = OurServices::findOrFail($id);
            $ourService->delete();

            return redirect()->route('our-services.index')->with('success', 'Our Service deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete our service.');
        }
    }
}
