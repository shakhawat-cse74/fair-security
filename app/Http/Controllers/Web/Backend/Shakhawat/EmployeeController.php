<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Branch;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageService;
use Exception;

class EmployeeController extends Controller
{
    public function getData(Request $request)
    {
        $data = Employee::with('branch')->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('branch_name', function ($row) {
                return $row->branch ? $row->branch->name : 'N/A';
            })

            ->addColumn('photo', function ($row) {
                $url = $row->photo ? asset($row->photo) : asset('admin/assets/images/users/1.jpg');
                return '<img src="' . $url . '" class="rounded-circle" width="35" height="35" />';
            })

            ->addColumn('status', function ($row) {
                return (int) $row->status;
            })

            ->rawColumns(['photo', 'status'])
            ->make(true);

    }

    public function index()
    {
        try {
            $employees = Employee::all();
            return view('backend.layouts.employee.index', compact('employees'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve employees.');
        }
    }

    public function create()
    {
        try {
            $branches = Branch::where('status', 1)->get();
            return view('backend.layouts.employee.create', compact('branches'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load employee creation form.');
        }
    }

    public function store(Request $request, ImageService $imageService)
    {
        try {
            $request->validate([
                'branch_id'        => 'required|exists:branches,id',
                'name'             => 'required|string|max:255',
                'employee_id'      => 'required|string|max:100|unique:employees,employee_id',
                'photo'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                'designation'      => 'nullable|string|max:255',
                'email'            => 'nullable|string|email|max:255|unique:employees,email',
                'phone'            => 'nullable|string|max:20',
                'nid_number'       => 'nullable|string|max:20',
                'present_address'  => 'nullable|string|max:500',
                'permanent_address'=> 'nullable|string|max:500',
                'joining_date'     => 'nullable|date',
                'workplace_address'=> 'nullable|string|max:500',
                'shift'            => 'nullable|string|max:100',
                'status'           => 'nullable|boolean',
            ]);

            $employee = new Employee();
            $employee->branch_id = $request->branch_id;
            $employee->name = $request->name;
            $employee->employee_id = $request->employee_id;

            if ($request->hasFile('photo')) {
                $imagePath = $imageService->uploadImage($request->file('photo'), 'uploads/employees', 300, 300);
                $employee->photo = $imagePath;
            }

            $employee->designation = $request->designation;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->nid_number = $request->nid_number;
            $employee->present_address = $request->present_address;
            $employee->permanent_address = $request->permanent_address;
            $employee->joining_date = $request->joining_date;
            $employee->workplace_address = $request->workplace_address;
            $employee->shift = $request->shift;
            $employee->status = $request->status ?? 1;
            $employee->save();

            return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create employee.');
        }
    }

    public function edit($id)
    {
        try {
            $employee = Employee::find($id);
            $branches = Branch::where('status', 1)->get();
            return view('backend.layouts.employee.edit', compact('employee', 'branches'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Branch not found.');
        }
    }

    public function update(Request $request, $id, ImageService $imageService)
    {
        try {
            $request->validate([
                'branch_id'        => 'required|exists:branches,id',
                'name'             => 'required|string|max:255',
                'employee_id'      => 'required|string|max:100|unique:employees,employee_id,' . $id,
                'photo'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                'designation'      => 'nullable|string|max:255',
                'email'            => 'nullable|string|email|max:255|unique:employees,email,' . $id,
                'phone'            => 'nullable|string|max:20',
                'nid_number'       => 'nullable|string|max:20',
                'present_address'  => 'nullable|string|max:500',
                'permanent_address'=> 'nullable|string|max:500',
                'joining_date'     => 'nullable|date',
                'workplace_address'=> 'nullable|string|max:500',
                'shift'            => 'nullable|string|max:100',
                'status'           => 'nullable|boolean',
            ]);

            $employee = Employee::find($id);
            $employee->branch_id = $request->branch_id;
            $employee->name = $request->name;
            $employee->employee_id = $request->employee_id;

            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($employee->photo) {
                    $imageService->deleteImage($employee->photo);
                }
                $imagePath = $imageService->uploadImage($request->file('photo'), 'uploads/employees', 300, 300);
                $employee->photo = $imagePath;
            }

            $employee->designation = $request->designation;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->nid_number = $request->nid_number;
            $employee->present_address = $request->present_address;
            $employee->permanent_address = $request->permanent_address;
            $employee->joining_date = $request->joining_date;
            $employee->workplace_address = $request->workplace_address;
            $employee->shift = $request->shift;
            $employee->status = $request->status ?? 1;
            $employee->save();

            return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update employee.');
        }

    }


    public function UpdateStatus(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->status = $request->status;
            $employee->save();

            return response()->json(['success' => true, 'message' => 'Employee status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update employee status.'], 500);
        }
    }


    public function show($id)
    {
        try {
            $employee = Employee::find($id);
            return view('backend.layouts.employee.show', compact('employee'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Employee not found.');
        }
    }

    public function destroy($id, ImageService $imageService)
    {
        try {
            $employee = Employee::findOrFail($id);
            // Delete photo if exists
            if ($employee->photo) {
                $imageService->deleteImage($employee->photo);
            }
            $employee->delete();

            return redirect()->back()->with('success', 'Employee deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete employee.');
        }
    }

}
