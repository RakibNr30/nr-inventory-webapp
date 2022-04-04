<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Dashboard routes...
Route::resource('dashboard', 'DashboardController')->only(['index']);
// Slider routes...
Route::resource('slider', 'SliderController');
// Menu routes...
Route::resource('menu', 'MenuController');
// MenuLink routes...
Route::resource('menu-link', 'MenuLinkController');
// PageCategory routes...
Route::resource('page-category', 'PageCategoryController');
// Page routes...
Route::resource('page', 'PageController');
// Faq routes...
Route::resource('faq', 'FaqController');
// Testimonial routes...
Route::resource('testimonial', 'TestimonialController');

// Campaign routes...
Route::resource('campaign', 'CampaignController');
// Brand routes...
Route::resource('brand', 'BrandController');
// Product routes...
Route::resource('product', 'ProductController');
