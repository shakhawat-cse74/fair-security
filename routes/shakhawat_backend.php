<?php

use App\Http\Controllers\Web\Backend\Shakhawat\BackendController;
use App\Http\Controllers\Web\Backend\Shakhawat\UserController;
use App\Http\Controllers\Web\Backend\Shakhawat\SettingController;
use App\Http\Controllers\Web\Backend\Shakhawat\ProfileSettingController;
use App\Http\Controllers\Web\Backend\Shakhawat\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\Shakhawat\PermissionController;
use App\Http\Controllers\Web\Backend\Shakhawat\BranchController;
use App\Http\Controllers\Web\Backend\Shakhawat\EmployeeController;
use App\Http\Controllers\Web\Backend\Shakhawat\BannerController;
use App\Http\Controllers\Web\Backend\Shakhawat\ManagementController;
use App\Http\Controllers\Web\Backend\Shakhawat\MissionController;
use App\Http\Controllers\Web\Backend\Shakhawat\VissionController;
use App\Http\Controllers\Web\Backend\Shakhawat\PartnerController;
use App\Http\Controllers\Web\Backend\Shakhawat\GalleryController;
use App\Http\Controllers\Web\Backend\Shakhawat\OurJourneyController;
use App\Http\Controllers\Web\Backend\Shakhawat\OurServicesController;
use App\Http\Controllers\Web\Backend\Shakhawat\DivisionWiseSecurityController;
use App\Http\Controllers\Web\Backend\Shakhawat\AboutPageBannerController;
use App\Http\Controllers\Web\Backend\Shakhawat\ServicePageBannerController;



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', [BackendController::class, 'index'])->name('dashboard');
    //User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/data', [UserController::class, 'getData'])->name('users.data');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    //setting Management
    Route::get('/mail', [SettingController::class, 'mail'])->name('settings.mail');
    Route::post('/mail/store', [SettingController::class, 'mailstore'])->name('settings.mailstore');


    //Profile Settings
    Route::get('/profile_upload/index', [ProfileSettingController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileSettingController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password/update', [ProfileSettingController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/profile/avatar', [ProfileSettingController::class, 'updatePhoto'])->name('profile.avatar.update');
    // Route::delete('/profile/avatar', [ProfileController::class, 'removeAvatar'])->name('profile.avatar.remove');


    //Role Management
    Route::get('role', [RoleController::class, 'index'])->name('role.index');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::get('role/permission/{id}', [RoleController::class, 'permission'])->name('role.permission');
    Route::post('role/set-permission', [RoleController::class, 'setPermission'])->name('role.setPermission');
    Route::delete('role/delete/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

    //Branch Management
    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/branches/data', [BranchController::class, 'getData'])->name('branches.data');
    Route::get('/branches/{id}/show', [BranchController::class, 'show'])->name('branches.show');
    Route::get('/branches/{id}/edit', [BranchController::class, 'edit'])->name('branches.edit');
    Route::post('/branches/{id}', [BranchController::class, 'update'])->name('branches.update');
    Route::post('/branches/{id}/status', [BranchController::class, 'UpdateStatus'])->name('branches.updateStatus');
    Route::delete('/branches/{id}', [BranchController::class, 'destroy'])->name('branches.destroy');

    //Employee Management
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/data', [EmployeeController::class, 'getData'])->name('employees.data');
    Route::get('/employees/{id}/show', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::post('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::post('/employees/{id}/status', [EmployeeController::class, 'UpdateStatus'])->name('employees.updateStatus');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    //Banner Management
    Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
    Route::get('/banners/create', [BannerController::class, 'create'])->name('banners.create');
    Route::post('/banners', [BannerController::class, 'store'])->name('banners.store');
    Route::get('/banners/data', [BannerController::class, 'getData'])->name('banners.data');
    Route::get('/banners/{id}/show', [BannerController::class, 'show'])->name('banners.show');
    Route::get('/banners/{id}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    Route::post('/banners/{id}', [BannerController::class, 'update'])->name('banners.update');
    Route::post('/banners/{id}/status', [BannerController::class, 'UpdateStatus'])->name('banners.updateStatus');
    Route::delete('/banners/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');

    //About Page Banner Management
    Route::get('/about-page-banners', [AboutPageBannerController::class, 'index'])->name('about-page-banners.index');
    Route::get('/about-page-banners/create', [AboutPageBannerController::class, 'create'])->name('about-page-banners.create');
    Route::post('/about-page-banners', [AboutPageBannerController::class, 'store'])->name('about-page-banners.store');
    Route::get('/about-page-banners/data', [AboutPageBannerController::class, 'getData'])->name('about-page-banners.data');
    Route::get('/about-page-banners/{id}/show', [AboutPageBannerController::class, 'show'])->name('about-page-banners.show');
    Route::get('/about-page-banners/{id}/edit', [AboutPageBannerController::class, 'edit'])->name('about-page-banners.edit');
    Route::post('/about-page-banners/{id}', [AboutPageBannerController::class, 'update'])->name('about-page-banners.update');
    Route::post('/about-page-banners/{id}/status', [AboutPageBannerController::class, 'UpdateStatus'])->name('about-page-banners.updateStatus');
    Route::delete('/about-page-banners/{id}', [AboutPageBannerController::class, 'destroy'])->name('about-page-banners.destroy');

    //Service Page Banner Management
    Route::get('/service-page-banners', [ServicePageBannerController::class, 'index'])->name('service-page-banners.index');
    Route::get('/service-page-banners/create', [ServicePageBannerController::class, 'create'])->name('service-page-banners.create');
    Route::post('/service-page-banners', [ServicePageBannerController::class, 'store'])->name('service-page-banners.store');
    Route::get('/service-page-banners/data', [ServicePageBannerController::class, 'getData'])->name('service-page-banners.data');
    Route::get('/service-page-banners/{id}/show', [ServicePageBannerController::class, 'show'])->name('service-page-banners.show');
    Route::get('/service-page-banners/{id}/edit', [ServicePageBannerController::class, 'edit'])->name('service-page-banners.edit');
    Route::post('/service-page-banners/{id}', [ServicePageBannerController::class, 'update'])->name('service-page-banners.update');
    Route::post('/service-page-banners/{id}/status', [ServicePageBannerController::class, 'UpdateStatus'])->name('service-page-banners.updateStatus');
    Route::delete('/service-page-banners/{id}', [ServicePageBannerController::class, 'destroy'])->name('service-page-banners.destroy');

    

    //Management Management
    Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
    Route::get('/management/create', [ManagementController::class, 'create'])->name('management.create');
    Route::post('/management', [ManagementController::class, 'store'])->name('management.store');
    Route::get('/management/data', [ManagementController::class, 'getData'])->name('management.data');
    Route::get('/management/{id}/show', [ManagementController::class, 'show'])->name('management.show');
    Route::get('/management/{id}/edit', [ManagementController::class, 'edit'])->name('management.edit');
    Route::post('/management/{id}', [ManagementController::class, 'update'])->name('management.update');
    Route::post('/management/{id}/status', [ManagementController::class, 'UpdateStatus'])->name('management.updateStatus');
    Route::delete('/management/{id}', [ManagementController::class, 'destroy'])->name('management.destroy');

        //Mission Management
        Route::get('/missions', [MissionController::class, 'index'])->name('missions.index');
        Route::get('/missions/create', [MissionController::class, 'create'])->name('missions.create');
        Route::post('/missions', [MissionController::class, 'store'])->name('missions.store');
        Route::get('/missions/data', [MissionController::class, 'getData'])->name('missions.data');
        Route::get('/missions/{id}/show', [MissionController::class, 'show'])->name('missions.show');
        Route::get('/missions/{id}/edit', [MissionController::class, 'edit'])->name('missions.edit');
        Route::post('/missions/{id}', [MissionController::class, 'update'])->name('missions.update');
        Route::post('/missions/{id}/status', [MissionController::class, 'updateStatus'])->name('missions.updateStatus');
        Route::delete('/missions/{id}', [MissionController::class, 'destroy'])->name('missions.destroy');

        //Vission Management
        Route::get('/vissions', [VissionController::class, 'index'])->name('vissions.index');
        Route::get('/vissions/create', [VissionController::class, 'create'])->name('vissions.create');
        Route::post('/vissions', [VissionController::class, 'store'])->name('vissions.store');
        Route::get('/vissions/data', [VissionController::class, 'getData'])->name('vissions.data'); 
        Route::get('/vissions/{id}/show', [VissionController::class, 'show'])->name('vissions.show');
        Route::get('/vissions/{id}/edit', [VissionController::class, 'edit'])->name('vissions.edit');
        Route::post('/vissions/{id}', [VissionController::class, 'update'])->name('vissions.update');
        Route::post('/vissions/{id}/status', [VissionController::class, 'updateStatus'])->name('vissions.updateStatus');
        Route::delete('/vissions/{id}', [VissionController::class, 'destroy'])->name('vissions.destroy');

        //Partner Management
        Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
        Route::get('/partners/create', [PartnerController::class, 'create'])->name('partners.create');
        Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
        Route::get('/partners/data', [PartnerController::class, 'getData'])->name('partners.data'); 
        Route::get('/partners/{id}/show', [PartnerController::class, 'show'])->name('partners.show');
        Route::get('/partners/{id}/edit', [PartnerController::class, 'edit'])->name('partners.edit');
        Route::post('/partners/{id}', [PartnerController::class, 'update'])->name('partners.update');
        Route::post('/partners/{id}/status', [PartnerController::class, 'updateStatus'])->name('partners.updateStatus');
        Route::delete('/partners/{id}', [PartnerController::class, 'destroy'])->name('partners.destroy');

        //Gallery Management
        Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
        Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
        Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
        Route::get('/galleries/data', [GalleryController::class, 'getData'])->name('galleries.data'); 
        Route::get('/galleries/{id}/show', [GalleryController::class, 'show'])->name('galleries.show');
        Route::get('/galleries/{id}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
        Route::post('/galleries/{id}', [GalleryController::class, 'update'])->name('galleries.update');
        Route::post('/galleries/{id}/status', [GalleryController::class, 'updateStatus'])->name('galleries.updateStatus');
        Route::delete('/galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
        Route::post('/gallery/delete-image', [GalleryController::class, 'deleteSingleImage'])->name('gallery.delete.image');

        //Our Journey Management
        Route::get('/our-journeys', [OurJourneyController::class, 'index'])->name('our-journeys.index');
        Route::get('/our-journeys/create', [OurJourneyController::class, 'create'])->name('our-journeys.create');
        Route::post('/our-journeys', [OurJourneyController::class, 'store'])->name('our-journeys.store');
        Route::get('/our-journeys/data', [OurJourneyController::class, 'getData'])->name('our-journeys.data'); 
        Route::get('/our-journeys/{id}/show', [OurJourneyController::class, 'show'])->name('our-journeys.show');
        Route::get('/our-journeys/{id}/edit', [OurJourneyController::class, 'edit'])->name('our-journeys.edit');
        Route::post('/our-journeys/{id}', [OurJourneyController::class, 'update'])->name('our-journeys.update');
        Route::post('/our-journeys/{id}/status', [OurJourneyController::class, 'updateStatus'])->name('our-journeys.updateStatus');
        Route::delete('/our-journeys/{id}', [OurJourneyController::class, 'destroy'])->name('our-journeys.destroy');  

        //Our Services Management
        Route::get('/our-services', [OurServicesController::class, 'index'])->name('our-services.index');
        Route::get('/our-services/create', [OurServicesController::class, 'create'])->name('our-services.create');
        Route::post('/our-services', [OurServicesController::class, 'store'])->name('our-services.store');
        Route::get('/our-services/data', [OurServicesController::class, 'getData'])->name('our-services.data'); 
        Route::get('/our-services/{id}/show', [OurServicesController::class, 'show'])->name('our-services.show');
        Route::get('/our-services/{id}/edit', [OurServicesController::class, 'edit'])->name('our-services.edit');
        Route::post('/our-services/{id}', [OurServicesController::class, 'update'])->name('our-services.update');
        Route::post('/our-services/{id}/status', [OurServicesController::class, 'updateStatus'])->name('our-services.updateStatus');
        Route::delete('/our-services/{id}', [OurServicesController::class, 'destroy'])->name('our-services.destroy');

        //Division Wise Security Management
        Route::get('/division-wise-security', [DivisionWiseSecurityController::class, 'index'])->name('division-wise-security.index');
        Route::get('/division-wise-security/create', [DivisionWiseSecurityController::class, 'create'])->name('division-wise-security.create');
        Route::post('/division-wise-security', [DivisionWiseSecurityController::class, 'store'])->name('division-wise-security.store');
        Route::get('/division-wise-security/data', [DivisionWiseSecurityController::class, 'getData'])->name('division-wise-security.data'); 
        Route::get('/division-wise-security/{id}/show', [DivisionWiseSecurityController::class, 'show'])->name('division-wise-security.show');
        Route::get('/division-wise-security/{id}/edit', [DivisionWiseSecurityController::class, 'edit'])->name('division-wise-security.edit');
        Route::post('/division-wise-security/{id}', [DivisionWiseSecurityController::class, 'update'])->name('division-wise-security.update');
        Route::post('/division-wise-security/{id}/status', [DivisionWiseSecurityController::class, 'updateStatus'])->name('division-wise-security.updateStatus');
        Route::delete('/division-wise-security/{id}', [DivisionWiseSecurityController::class, 'destroy'])->name('division-wise-security.destroy');
        
});