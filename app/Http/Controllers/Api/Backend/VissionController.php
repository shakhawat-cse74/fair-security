<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vission;
use App\Traits\ApiResponse;

class VissionController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $vissions = Vission::where('status', 1)->get()->map(function ($vission) {
                $vission->image = $vission->image ? asset($vission->image) : asset('admin/assets/images/default.png');
                return $vission;
            });
            return $this->successResponse($vissions, 'Vissions retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve vissions.', 500);
        }
    }
}
