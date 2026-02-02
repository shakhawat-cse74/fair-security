<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Backend\BannerController;
use App\Http\Controllers\Api\Backend\BranchController;
use App\Http\Controllers\Api\Backend\DivisionWiseSecurityController;

Route::get('/banners', [BannerController::class, 'index']);
Route::get('/branches', [BranchController::class, 'index']);
Route::get('/division-wise-securities', [DivisionWiseSecurityController::class, 'index']);


