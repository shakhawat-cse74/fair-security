<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class BranchController extends Controller
{

    public function getData(Request $request)
    {
        $data = Branch::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('status', function ($row) {
                return (int) $row->status;
            })

            ->make(true);
    }
    


    public function index()
    {
        try {
            $branches = Branch::all();
            return view('backend.layouts.branch.index', compact('branches'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve branches.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.branch.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load branch creation form.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'     => 'required|string|max:255|unique:branches,name',
                'location' => 'nullable|string|max:255',
                'mobile'   => 'nullable|string|max:20',
                'email'    => 'nullable|string|email|max:255',
            ]);

            $branch = new Branch();
            $branch->name = $request->name;
            $branch->location = $request->location;
            $branch->mobile = $request->mobile;
            $branch->email = $request->email;
            $branch->status = $request->status ?? 1;
            $branch->save();

            return redirect()->route('branches.index')->with('success', 'Branch created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create branch.');
        }
    }

    public function edit($id)
    {
        try {
            $branch = Branch::find($id);
            return view('backend.layouts.branch.edit', compact('branch'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Branch not found.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name'     => 'required|string|max:255|unique:branches,name,' . $id,
                'location' => 'nullable|string|max:255',
                'mobile'   => 'nullable|string|max:20',
                'email'    => 'nullable|string|email|max:255',
            ]);

            $branch = Branch::find($id);
            $branch->name = $request->name;
            $branch->location = $request->location;
            $branch->mobile = $request->mobile;
            $branch->email = $request->email;
            $branch->status = $request->status ?? 1;
            $branch->save();

            return redirect()->route('branches.index')->with('success', 'Branch updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update branch.');
        }
    }

    public function show($id)
    {
        try {
            $branch = Branch::find($id);
            return view('backend.layouts.branch.show', compact('branch'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Branch not found.');
        }
    }

    public function UpdateStatus(Request $request, $id)
{
    try {
        $branch = Branch::findOrFail($id);
        $branch->status = $request->status;
        $branch->save();

        return response()->json([
            'success' => true,
            'message' => 'Branch status updated successfully.'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to update branch status.'
        ], 500);
    }
}


    public function destroy($id)
    {
        try {
            $branch = Branch::find($id);
            $branch->delete();

            return redirect()->back()->with('success', 'Branch deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete branch.');
        }
    }
}
