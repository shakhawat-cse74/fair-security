<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Traits\ApiResponse;

class EmployeeController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $employees = Employee::where('status', 1)->get();
            $employees->each(function ($employee) {
                $employee->photo = $employee->photo ? asset($employee->photo) : asset('admin/assets/images/default.png');
            });
            return $this->successResponse($employees, 'Employees retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve employees.', 500);
        }
    }

    public function show($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->photo = $employee->photo ? asset($employee->photo) : asset('admin/assets/images/default.png');
            return $this->successResponse($employee, 'Employee retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve employee.', 500);
        }
    }

}
