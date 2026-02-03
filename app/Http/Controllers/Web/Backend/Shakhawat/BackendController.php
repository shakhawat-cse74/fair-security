<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Partner;
use App\Models\Employee;
use App\Models\Management;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Log;

class BackendController extends Controller
{
    public function index()
    {
        // Stats
        $totalPartners = $this->safeCount(Partner::class);
        $totalEmployees = $this->safeCount(Employee::class);
        $totalManagement = $this->safeCount(Management::class);

        // Recent Items
        $recentPartners = Partner::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();

        // Chart last 10 months
        $chartLabels = [];
        $contactChartData = [];
        $partnerChartData = [];

        for($i=9; $i>=0; $i--){
            $date = Carbon::now()->subMonths($i);
            $start = $date->copy()->startOfMonth();
            $end = $date->copy()->endOfMonth();

            $chartLabels[] = $date->format('M Y');
            $contactChartData[] = $this->safeCountBetween(Contact::class, $start, $end);
            $partnerChartData[] = $this->safeCountBetween(Partner::class, $start, $end);
        }

        return view('backend.layouts.home.index', compact(
            'totalPartners',
            'totalEmployees',
            'totalManagement',
            'recentPartners',
            'recentContacts',
            'chartLabels',
            'contactChartData',
            'partnerChartData'
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