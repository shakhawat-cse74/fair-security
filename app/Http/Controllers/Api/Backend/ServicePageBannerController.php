<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServicePageBanner;
use App\Traits\ApiResponse;

class ServicePageBannerController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $servicePageBanner = ServicePageBanner::where('status', 1)->get()->map(function ($servicePageBanner) {
                $servicePageBanner->image = $servicePageBanner->image ? asset($servicePageBanner->image) : asset('admin/assets/images/default.png');
                return $servicePageBanner;
            });
            return $this->successResponse($servicePageBanner, 'Service Page Banners retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve Service Page Banners.', 500);
        }

    }
}
