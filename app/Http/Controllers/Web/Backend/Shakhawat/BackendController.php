<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Log;

class BackendController extends Controller
{
    public function index()
    {
        // Only guests
        $totalGuests = User::where('is_guest', true)->count();
        // $totalDiscussions = DB::table('discussions')->count(); 
        // $totalReplies = DB::table('replies')->count();
        // $totalReactions = DB::table('reactions')->count();

        $recentGuests = User::where('is_guest', true)->latest()->take(10)->get();

        // Chart last 10 months
        $chartLabels = [];
        $guestChartData = [];

        for($i=9; $i>=0; $i--){
            $date = Carbon::now()->subMonths($i);
            $start = $date->copy()->startOfMonth();
            $end = $date->copy()->endOfMonth();

            $chartLabels[] = $date->format('M Y');
            $guestChartData[] = User::where('is_guest', true)->whereBetween('created_at', [$start,$end])->count();
        }

        return view('backend.layouts.home.index', compact(
            'totalGuests',
            'recentGuests','chartLabels','guestChartData'
        ));
    }

    /**
     * Safely count records from a model
     */
    private function safeCount($modelClass)
    {
        try {
            return $modelClass::count();
        } catch (\Exception $e) {
            \Log::warning("Model {$modelClass} count error: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Safely count records between dates
     */
    private function safeCountBetween($modelClass, $startDate, $endDate)
    {
        try {
            return $modelClass::whereBetween('created_at', [$startDate, $endDate])->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Calculate percentage change for a model
     */
    private function calculatePercentageChange($modelClass)
    {
        try {
            $thisMonth = $modelClass::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
            
            $lastMonth = $modelClass::whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->whereYear('created_at', Carbon::now()->subMonth()->year)
                ->count();
            
            return $lastMonth > 0 
                ? round((($thisMonth - $lastMonth) / $lastMonth) * 100, 1)
                : ($thisMonth > 0 ? 100 : 0);
        } catch (\Exception $e) {
            return 0;
        }
    }
}