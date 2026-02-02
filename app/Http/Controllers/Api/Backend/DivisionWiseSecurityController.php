<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DivisionWiseSecurity;
use App\Traits\ApiResponse;

class DivisionWiseSecurityController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $divisionWiseSecurities = DivisionWiseSecurity::where('status', 1)->get();
            
            $totalSecurity = $divisionWiseSecurities->sum('security_qty');
            $totalSupportStaff = $divisionWiseSecurities->sum('support_staff');
            $grandTotal = $divisionWiseSecurities->sum('total_employees');
            
            $response = [
                'data' => $divisionWiseSecurities,
                'total_security' => $totalSecurity,
                'total_support_staff' => $totalSupportStaff,
                'grand_total' => $grandTotal,
            ];
            
            return $this->successResponse($response, 'Division Wise Securities retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve Division Wise Securities.', 500);
        }
    }

    
}
