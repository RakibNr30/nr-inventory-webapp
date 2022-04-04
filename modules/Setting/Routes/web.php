<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Site routes...
Route::resource('site', 'SiteController')->only(['index', 'update']);
// Contact routes...
Route::resource('contact', 'ContactController')->only(['index', 'update']);
// Seo routes...
Route::resource('seo', 'SeoController')->only(['index', 'update']);
// Socialite routes...
Route::resource('socialite', 'SocialiteController')->only(['index', 'update']);
