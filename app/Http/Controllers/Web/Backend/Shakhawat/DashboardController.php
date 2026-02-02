<?php

namespace App\Http\Controllers\Web\Backend\Shakhawat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
