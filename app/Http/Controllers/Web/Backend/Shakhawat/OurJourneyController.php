<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurJourney;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;

class OurJourneyController extends Controller
{
    public function getData(Request $request)
    {
        $data = OurJourney::latest()->get();

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
            $ourJourneys = OurJourney::all();
            return view('backend.layouts.our_journey.index', compact('ourJourneys'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve our journeys.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.our_journey.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load our journey creation form.');
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
            $ourJourney = new OurJourney();
            $ourJourney->title = $request->title;
            $ourJourney->sub_title = $request->sub_title;
            $ourJourney->status = $request->status ?? 1;

            if ($request->hasFile('image')) {
                $imagePath = $imageService->uploadImage($request->file('image'), 'uploads/our_journeys');
                $ourJourney->image = $imagePath;
            }

            $ourJourney->save();

            return redirect()->route('our-journeys.index')->with('success', 'Our Journey created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create our journey.');
        }
    }

    public function edit($id)
    {
        try {
            $ourJourney = OurJourney::findOrFail($id);
            return view('backend.layouts.our_journey.edit', compact('ourJourney'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load our journey edit form.');
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
            $ourJourney = OurJourney::findOrFail($id);
            $ourJourney->title = $request->title;
            $ourJourney->sub_title = $request->sub_title;
            $ourJourney->status = $request->status ?? 1;

            if ($request->hasFile('image')) {
                $imagePath = $imageService->uploadImage($request->file('image'), 'uploads/our_journeys');
                $ourJourney->image = $imagePath;
            }

            $ourJourney->save();

            return redirect()->route('our-journeys.index')->with('success', 'Our Journey updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update our journey.');
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $ourJourney = OurJourney::findOrFail($id);
            $ourJourney->status = $request->status;
            $ourJourney->save();

            return response()->json(['success' => true, 'message' => 'Our Journey status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update our journey status.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $ourJourney = OurJourney::findOrFail($id);
            $ourJourney->delete();

            return redirect()->route('our-journeys.index')->with('success', 'Our Journey deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete our journey.');
        }
    }
}
