<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CertificationPageBanner;
use App\Traits\ApiResponse;

class CertificationPageBannerController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $certificationPageBanner = CertificationPageBanner::where('status', 1)->get()->map(function ($certificationPageBanner) {
                $certificationPageBanner->image = $certificationPageBanner->image ? asset($certificationPageBanner->image) : asset('admin/assets/images/default.png');
                return $certificationPageBanner;
            });
            return $this->successResponse($certificationPageBanner, 'Certification Page Banner retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve certification page banner.', 500);
        }

    }
}
