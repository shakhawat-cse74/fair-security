<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Traits\ApiResponse;

class BranchController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $branches = Branch::where('status', 1)->get();
            return $this->successResponse($branches, 'Branches retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve branches.', 500);
        }

    }
}
