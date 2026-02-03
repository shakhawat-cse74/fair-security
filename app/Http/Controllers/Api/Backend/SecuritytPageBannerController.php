<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SecurityPageBanner;
use App\Traits\ApiResponse;

class SecuritytPageBannerController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $securityPageBanner = SecurityPageBanner::where('status', 1)->get()->map(function ($securityPageBanner) {
                $securityPageBanner->image = $securityPageBanner->image ? asset($securityPageBanner->image) : asset('admin/assets/images/default.png');
                return $securityPageBanner;
            });
            return $this->successResponse($securityPageBanner, 'Security Page Banner retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve Security Page Banner.', 500);
        }

    }
}
