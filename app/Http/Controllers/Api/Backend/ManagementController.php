<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Management;
use App\Traits\ApiResponse;

class ManagementController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $managements = Management::where('status', 1)->get()->map(function ($management) {
                $management->image = $management->image ? asset($management->image) : asset('admin/assets/images/default.png');
                return $management;
            });
            return $this->successResponse($managements, 'Management members retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve management members.', 500);
        }
    }

    public function show($id)
    {
        try {
            $management = Management::findOrFail($id);
            $management->image = $management->image ? asset($management->image) : asset('admin/assets/images/default.png');
            return $this->successResponse($management, 'Management member retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve management member.', 500);
        }
    }
}
