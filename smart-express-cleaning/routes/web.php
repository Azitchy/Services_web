<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminBlogPostController;
use App\Http\Controllers\Admin\AdminContactInquiryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminSitePageController;
use App\Http\Controllers\ContactInquiryController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about-us', [FrontendController::class, 'about'])->name('about');
Route::get('/our-services', [FrontendController::class, 'servicesPage'])->name('services');
Route::get('/blogs', [FrontendController::class, 'blogs'])->name('blogs.index');
Route::get('/blogs/{slug}', [FrontendController::class, 'blogShow'])->name('blogs.show');

Route::post('/contact', [ContactInquiryController::class, 'store'])->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login');

    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('/site-pages', AdminSitePageController::class)->except(['show']);
        Route::resource('/services', AdminServiceController::class)->except(['show']);
        Route::resource('/blog-posts', AdminBlogPostController::class)->except(['show']);
        Route::resource('/banners', \App\Http\Controllers\Admin\AdminBannerController::class)->except(['show']);

        Route::resource('/contact-inquiries', AdminContactInquiryController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('/why-choose-us', App\Http\Controllers\Admin\WhyChooseUsController::class)->except(['show']);
        Route::resource('/about-items', \App\Http\Controllers\Admin\AdminAboutItemController::class)->except(['show']);
    });
});
