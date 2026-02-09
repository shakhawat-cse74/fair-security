<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mission;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;
use Exception;

class MissionController extends Controller
{
    public function getData(Request $request)
    {
        $data = Mission::latest()->get();

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
            $missions = Mission::all();
            return view('backend.layouts.mission.index', compact('missions'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve missions.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.mission.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load mission creation form.');
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
            $mission = new Mission();
            $mission->title = $request->title;
            $mission->sub_title = $request->sub_title;
            $mission->status = $request->status ?? 1;

            if ($request->hasFile('image')) {
                $imagePath = $imageService->uploadImage($request->file('image'), 'uploads/missions');
                $mission->image = $imagePath;
            } else {
                $mission->image = 'admin/assets/images/default.png';
            }

            $mission->save();

            return redirect()->route('missions.index')->with('success', 'Mission created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create mission.');
        }
    }

    public function edit($id)
    {
        try {
            $mission = Mission::findOrFail($id);
            return view('backend.layouts.mission.edit', compact('mission'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load mission edit form.');
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
            $mission = Mission::findOrFail($id);
            $mission->title = $request->title;
            $mission->sub_title = $request->sub_title;
            $mission->status = $request->status ?? 1;

            if ($request->hasFile('image')) {
                $imagePath = $imageService->uploadImage($request->file('image'), 'uploads/missions');
                $mission->image = $imagePath;
            }

            $mission->save();

            return redirect()->route('missions.index')->with('success', 'Mission updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update mission.');
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $mission = Mission::findOrFail($id);
            $mission->status = $request->status;
            $mission->save();

            return response()->json(['success' => true, 'message' => 'Mission status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update mission status.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $mission = Mission::findOrFail($id);
            $mission->delete();

            return redirect()->route('missions.index')->with('success', 'Mission deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete mission.');
        }
    }
}
