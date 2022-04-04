<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Site routes...
Route::apiResource('site', 'Api\SiteController');
// Contact routes...
Route::apiResource('contact', 'Api\ContactController');
// Seo routes...
Route::apiResource('seo', 'Api\SeoController');
// Socialite routes...
Route::apiResource('socialite', 'Api\SocialiteController');
