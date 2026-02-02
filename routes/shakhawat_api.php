<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Backend\BannerController;

Route::get('/banners', [BannerController::class, 'index']);



