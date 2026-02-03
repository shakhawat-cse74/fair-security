<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurServices;
use App\Traits\ApiResponse;

class OurServicesController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $services = OurServices::where('status', 1)->get()->map(function ($service) {
                $service->image = $service->image ? asset($service->image) : asset('admin/assets/images/default.png');
                return $service;
            });
            return $this->successResponse($services, 'Services retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve services.', 500);
        }
    }
}
