<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Backend\BannerController;
use App\Http\Controllers\Api\Backend\BranchController;

Route::get('/banners', [BannerController::class, 'index']);
Route::get('/branches', [BranchController::class, 'index']);



