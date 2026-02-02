<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Traits\ApiResponse;

class BannerController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $banners = Banner::where('status', 1)->get()->map(function ($banner) {
                $banner->image = $banner->image ? asset($banner->image) : asset('admin/assets/images/default.png');
                return $banner;
            });
            return $this->successResponse($banners, 'Banners retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve banners.', 500);
        }

    }
}   