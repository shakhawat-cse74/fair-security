<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DivisionWiseSecurity;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;


class DivisionWiseSecurityController extends Controller
{
     public function getData(Request $request)
    {
        $data = DivisionWiseSecurity::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('division_name', function ($row) {
                return $row->division_name;
            })

            ->addColumn('security_qty', function ($row) {
                return $row->security_qty;
            })

            ->addColumn('security_purpose', function ($row) {
                return $row->security_purpose;
            })

            ->addColumn('deployment_area', function ($row) {
                return $row->deployment_area;
            })

            ->addColumn('support_staff', function ($row) {
                return $row->support_staff;
            })

            ->addColumn('total_employees', function ($row) {
                return $row->total_employees;
            })

            ->addColumn('status', function ($row) {
                return (int) $row->status;
            })

            ->rawColumns(['status'])
            ->make(true);
    }

    public function index()
    {
        try {
            $divisionWiseSecurities = DivisionWiseSecurity::all();
            return view('backend.layouts.division_wise_security.index', compact('divisionWiseSecurities'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve division wise security.');
        }
    }

    public function create()
    {
        try {
            return view('backend.layouts.division_wise_security.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load division wise security creation form.');
        }
    }

    public function store(Request $request, ImageService $imageService)
    {
        $request->validate([
            'division_name' => 'required|string|max:255',
            'security_qty' => 'required|integer|min:0',
            'security_purpose' => 'nullable|string|max:10000',
            'deployment_area' => 'nullable|string|max:255',
            'support_staff' => 'nullable|integer|min:0',
            'total_employees' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        try {
            $divisionWiseSecurity = new DivisionWiseSecurity();
            $divisionWiseSecurity->division_name = $request->division_name;
            $divisionWiseSecurity->security_qty = $request->security_qty;
            $divisionWiseSecurity->security_purpose = $request->security_purpose;
            $divisionWiseSecurity->deployment_area = $request->deployment_area;
            $divisionWiseSecurity->support_staff = $request->support_staff;
            $divisionWiseSecurity->total_employees = $request->security_qty + $request->support_staff;
            $divisionWiseSecurity->status = $request->status ?? 1;
            $divisionWiseSecurity->save();

            return redirect()->route('division-wise-security.index')->with('success', 'Division Wise Security created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create division wise security.');
        }
    }

    public function edit($id)
    {
        try {
            $divisionWiseSecurity = DivisionWiseSecurity::findOrFail($id);
            return view('backend.layouts.division_wise_security.edit', compact('divisionWiseSecurity'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load division wise security edit form.');
        }
    }

    public function update(Request $request, $id, ImageService $imageService)
    {
        $request->validate([
            'division_name' => 'required|string|max:255',
            'security_qty' => 'required|integer|min:0',
            'security_purpose' => 'nullable|string|max:10000',
            'deployment_area' => 'nullable|string|max:255',
            'support_staff' => 'nullable|integer|min:0',
            'total_employees' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        try {
            $divisionWiseSecurity = DivisionWiseSecurity::findOrFail($id);
            $divisionWiseSecurity->division_name = $request->division_name;
            $divisionWiseSecurity->security_qty = $request->security_qty;
            $divisionWiseSecurity->security_purpose = $request->security_purpose;
            $divisionWiseSecurity->deployment_area = $request->deployment_area;
            $divisionWiseSecurity->support_staff = $request->support_staff;
            $divisionWiseSecurity->total_employees = $request->security_qty + $request->support_staff;
            $divisionWiseSecurity->status = $request->status ?? 1;
            $divisionWiseSecurity->save();

            return redirect()->route('division-wise-security.index')->with('success', 'Division Wise Security updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update division wise security.');
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        try {
            $divisionWiseSecurity = DivisionWiseSecurity::findOrFail($id);
            $divisionWiseSecurity->status = $request->status;
            $divisionWiseSecurity->save();

            return response()->json(['success' => true, 'message' => 'Division Wise Security status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update division wise security status.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $divisionWiseSecurity = DivisionWiseSecurity::findOrFail($id);
            $divisionWiseSecurity->delete();

            return redirect()->route('division-wise-security.index')->with('success', 'Division Wise Security deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete division wise security.');
        }
    }
}
