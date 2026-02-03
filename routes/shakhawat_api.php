<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Backend\BannerController;
use App\Http\Controllers\Api\Backend\BranchController;
use App\Http\Controllers\Api\Backend\DivisionWiseSecurityController;
use App\Http\Controllers\Api\Backend\EmployeeController;
use App\Http\Controllers\Api\Backend\VissionController;
use App\Http\Controllers\Api\Backend\MissionController;
use App\Http\Controllers\Api\Backend\OurServicesController;
use App\Http\Controllers\Api\Backend\OurJourneyController;
use App\Http\Controllers\Api\Backend\ManagementController;
use App\Http\Controllers\Api\Backend\GalleryController;
use App\Http\Controllers\Api\Backend\PartnerController;
use App\Http\Controllers\Api\Backend\AboutPageBannerController;
use App\Http\Controllers\Api\Backend\ServicePageBannerController;
use App\Http\Controllers\Api\Backend\ContactPageBannerController;
use App\Http\Controllers\Api\Backend\ManagementPageBannerController;
use App\Http\Controllers\Api\Backend\SecuritytPageBannerController;


Route::get('/branches', [BranchController::class, 'index']);

Route::get('/banners', [BannerController::class, 'index']);
Route::get('/about-page-banners', [AboutPageBannerController::class, 'index']);
Route::get('/service-page-banners', [ServicePageBannerController::class, 'index']);
Route::get('/contact-page-banners', [ContactPageBannerController::class, 'index']);
Route::get('/management-page-banners', [ManagementPageBannerController::class, 'index']);
Route::get('/security-page-banners', [SecuritytPageBannerController::class, 'index']);

Route::get('/division-wise-securities', [DivisionWiseSecurityController::class, 'index']);

Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/employee/{id}', [EmployeeController::class, 'show']);

Route::get('/vissions', [VissionController::class, 'index']);

Route::get('/missions', [MissionController::class, 'index']);

Route::get('/our-services', [OurServicesController::class, 'index']);

Route::get('/our-journeys', [OurJourneyController::class, 'index']);

Route::get('/managements', [ManagementController::class, 'index']);
Route::get('/management/{id}', [ManagementController::class, 'show']);

Route::get('/galleries', [GalleryController::class, 'index']);

Route::get('/partners', [PartnerController::class, 'index']);
