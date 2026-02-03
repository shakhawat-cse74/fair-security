<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManagementPageBanner;
use App\Traits\ApiResponse;

class ManagementPageBannerController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $managementPageBanners = ManagementPageBanner::where('status', 1)->get()->map(function ($managementPageBanner) {
                $managementPageBanner->image = $managementPageBanner->image ? asset($managementPageBanner->image) : asset('admin/assets/images/default.png');
                return $managementPageBanner;
            });
            return $this->successResponse($managementPageBanners, 'Management Page Banners retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve Management Page Banners.', 500);
        }

    }
}
