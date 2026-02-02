<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Management;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;
use App\Models\Branch;

class ManagementController extends Controller
{
    public function getData(Request $request)
    {
        $data = Management::with('branch')->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('branch_name', function ($row) {
                return $row->branch ? $row->branch->name : 'N/A';
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
            $managements = Management::all();
            return view('backend.layouts.management.index', compact('managements'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve management records.');
        }
    }

    public function create()
    {
        try {
            $branches = Branch::where('status', 1)->get();
            return view('backend.layouts.management.create', compact('branches'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load management creation form.');
        }
    }

    public function store(Request $request, ImageService $imageService)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'employee_id' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:5000',
            'joining_date' => 'nullable|date',

        ]);

        try {
            $management = new Management();
            $management->branch_id = $request->input('branch_id');
            $management->name = $request->input('name');
            $management->designation = $request->input('designation');
            $management->email = $request->input('email');
            $management->phone = $request->input('phone');
            $management->employee_id = $request->input('employee_id');
            $management->message = $request->input('message');
            $management->joining_date = $request->input('joining_date');

            if ($request->hasFile('image')) {
                $imagePath = $imageService->uploadImage($request->file('image'), 'management_images');
                $management->image = $imagePath;
            }

            $management->save();

            return redirect()->route('management.index')->with('success', 'Management record created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create management record.');
        }
    }

    public function show($id)
    {
        try {
            $management = Management::findOrFail($id);
            return view('backend.layouts.management.show', compact('management'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Management record not found.');
        }
    }

    public function edit($id)
    {
        try {
            $management = Management::findOrFail($id);
            $branches = Branch::where('status', 1)->get();
            return view('backend.layouts.management.edit', compact('management', 'branches'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load management edit form.');
        }
    }

    public function update(Request $request, $id, ImageService $imageService)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'employee_id' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:5000',
            'joining_date' => 'nullable|date',
        ]);

        try {
            $management = Management::findOrFail($id);
            $management->branch_id = $request->input('branch_id');
            $management->name = $request->input('name');
            $management->designation = $request->input('designation');
            $management->email = $request->input('email');
            $management->phone = $request->input('phone');
            $management->employee_id = $request->input('employee_id');
            $management->message = $request->input('message');
            $management->joining_date = $request->input('joining_date');

            if ($request->hasFile('image')) {
                $imagePath = $imageService->uploadImage($request->file('image'), 'management_images');
                $management->image = $imagePath;
            }

            $management->save();

            return redirect()->route('management.index')->with('success', 'Management record updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update management record.');
        }
    }
    
    public function UpdateStatus(Request $request, $id)
    {
        try {
            $management = Management::findOrFail($id);
            $management->status = $request->status;
            $management->save();

            return response()->json(['success' => true, 'message' => 'Management status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update management status.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $management = Management::findOrFail($id);
            $management->delete();
            return redirect()->route('management.index')->with('success', 'Management record deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete management record.');
        }
    }

}
