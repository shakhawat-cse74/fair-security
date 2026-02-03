<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Traits\ApiResponse;

class MissionController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $missions = Mission::where('status', 1)->get()->map(function ($mission) {
                $mission->image = $mission->image ? asset($mission->image) : asset('admin/assets/images/default.png');
                return $mission;
            });
            return $this->successResponse($missions, 'Missions retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve missions.', 500);
        }
    }
}
