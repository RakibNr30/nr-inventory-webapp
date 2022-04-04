<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'verify' => true,
    'register' => true,
    'reset' => true
]);

// login route
Route::get('/', function () {
    return redirect()->route('login');
});

// register almost ready
Route::get('/register/almost-ready', 'Auth\RegisterController@showAlmostReady')->name('register.almost-ready');
Route::post('/register/almost-ready', 'Auth\RegisterController@storeAlmostReady')->name('register.almost-ready.store');

/*Route::get('oc', function() {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return "Optimise Cleared.";
});*/

/*Route::get('stlink', function() {
    \Artisan::call('storage:link');
    return "Storage has been linked.";
});

Route::get('oc', function() {
    \Artisan::call('optimise:clear');
    return "Optimise Cleared.";
});

Route::get('migrate', function() {
    \Artisan::call('migrate:fresh');
    return "Migrated.";
});

Route::get('seed', function() {
    \Artisan::call('db:seed', [
        '--force' => true
    ]);
    //dd(\DB::unprepared(file_get_contents(resource_path('mgt.sql'))));
    return "Seeded.";
});*/

/*
Route::get('migrate', function() {
    \Artisan::call('migrate');
    return "Migrated.";
});
*/
