<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPageBanner;
use App\Traits\ApiResponse;

class AboutPageBannerController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $aboutPageBanner = AboutPageBanner::where('status', 1)->get()->map(function ($aboutPageBanner) {
                $aboutPageBanner->image = $aboutPageBanner->image ? asset($aboutPageBanner->image) : asset('admin/assets/images/default.png');
                return $aboutPageBanner;
            });
            return $this->successResponse($aboutPageBanner, 'About Page Banners retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve About Page Banners.', 500);
        }

    }
}
