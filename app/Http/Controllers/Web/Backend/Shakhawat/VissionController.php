<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vission;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;

class VissionController extends Controller
{
    public function getData(Request $request)
    {
        $data = Vission::latest()->get();

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
            $vissions = Vission::all();
            return view('backend.layouts.vission.index', compact('vissions'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve vissions.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.vission.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load vission creation form.');
        }
    }

    public function store(Request $request, ImageService $imageService)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'status' => 'nullable|boolean',
        ]);

        try {
            $vission = new Vission();
            $vission->title = $request->title;
            $vission->sub_title = $request->sub_title;
            $vission->status = $request->status ?? 1;

            if ($request->hasFile('image')) {
                $imagePath = $imageService->uploadImage($request->file('image'), 'uploads/vissions');
                $vission->image = $imagePath;
            }

            $vission->save();

            return redirect()->route('vissions.index')->with('success', 'Vission created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create vission.');
        }
    }

    public function edit($id)
    {
        try {
            $vission = Vission::findOrFail($id);
            return view('backend.layouts.vission.edit', compact('vission'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load vission edit form.');
        }
    }

    public function update(Request $request, $id, ImageService $imageService)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'status' => 'nullable|boolean',
        ]);

        try {
            $vission = Vission::findOrFail($id);
            $vission->title = $request->title;
            $vission->sub_title = $request->sub_title;
            $vission->status = $request->status ?? 1;

            if ($request->hasFile('image')) {
                $imagePath = $imageService->uploadImage($request->file('image'), 'uploads/vissions');
                $vission->image = $imagePath;
            }

            $vission->save();

            return redirect()->route('vissions.index')->with('success', 'Vission updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update vission.');
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $vission = Vission::findOrFail($id);
            $vission->status = $request->status;
            $vission->save();

            return response()->json(['success' => true, 'message' => 'Vission status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update vission status.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $vission = Vission::findOrFail($id);
            $vission->delete();

            return redirect()->route('vissions.index')->with('success', 'Vission deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete vission.');
        }
    }
}
