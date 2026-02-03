<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurJourney;
use App\Traits\ApiResponse;

class OurJourneyController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $journeys = OurJourney::where('status', 1)->get()->map(function ($journey) {
                $journey->image = $journey->image ? asset($journey->image) : asset('admin/assets/images/default.png');
                return $journey;
            });
            return $this->successResponse($journeys, 'Journeys retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve journeys.', 500);
        }
    }
}
