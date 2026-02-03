<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use App\Traits\ApiResponse;

class PartnerController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $partners = Partner::where('status', 1)->get()->map(function ($partner) {
                $partner->logo = $partner->logo ? asset($partner->logo) : asset('admin/assets/images/default.png');
                return $partner;
            });
            return $this->successResponse($partners, 'Partners retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve partners.', 500);
        }
    }
}
