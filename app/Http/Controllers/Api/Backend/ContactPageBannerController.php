<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactPageBanner;
use App\Traits\ApiResponse;

class ContactPageBannerController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $contactPageBanners = ContactPageBanner::where('status', 1)->get()->map(function ($contactPageBanner) {
                $contactPageBanner->image = $contactPageBanner->image ? asset($contactPageBanner->image) : asset('admin/assets/images/default.png');
                return $contactPageBanner;
            });
            return $this->successResponse($contactPageBanners, 'Contact Page Banners retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve Contact Page Banners.', 500);
        }

    }
}
