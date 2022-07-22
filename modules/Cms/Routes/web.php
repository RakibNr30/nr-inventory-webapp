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
Route::get('campaign/{id}/pre-selection', 'CampaignController@preSelection')->name('campaign.pre-selection');
Route::get('campaign/{id}/pre-selection/{influencerId}/create', 'CampaignController@preSelectionCreate')->name('campaign.influencer.pre-selection.create');
Route::get('campaign/{id}/influencer/create', 'CampaignInfluencerController@create')->name('campaign.influencer.create');
Route::post('campaign/{id}/influencer/store', 'CampaignInfluencerController@store')->name('campaign.influencer.store');
Route::get('campaign-influencer-manager', 'CampaignInfluencerController@campaignInfluencerManager')->name('campaign.influencer-manager.list');
Route::post('campaign/{id}/active-status/update', 'CampaignController@updateActiveStatus')->name('campaign.active-status.update');
// Brand routes...
Route::resource('brand', 'BrandController');
Route::get('brand/{id}/campaign_influencer/{campaign_influencer_id}/content', 'BrandController@content')->name('brand.content');
Route::put('brand/{id}/campaign_influencer/{campaign_influencer_id}/content-upload', 'BrandController@contentUpload')->name('brand.content.upload');
// Product routes...
Route::resource('product', 'ProductController');
// Influencer category routes...
Route::resource('influencer-category', 'InfluencerCategoryController');
// Campaign influencer routes...
Route::resource('campaign-influencer', 'CampaignInfluencerController');
Route::put('campaign-influencer/{id}/brand/{brand_id}/feedback', 'CampaignInfluencerController@feedback')->name('campaign-influencer.feedback');
Route::put('campaign-influencer/{id}/brand/{brand_id}/feedback/content', 'CampaignInfluencerController@feedbackContent')->name('campaign-influencer.feedbackContent');
Route::put('campaign-influencer/{id}/reminder', 'CampaignInfluencerController@reminder')->name('campaign-influencer.reminder');
Route::put('campaign-influencer/{id}/report', 'CampaignInfluencerController@report')->name('campaign-influencer.report');
Route::put('campaign-influencer/{id}/brand/{brand_id}/remove', 'CampaignInfluencerController@brandRemove')->name('campaign-influencer.brand.remove');

// Logistic routes...
Route::resource('logistic', 'LogisticController')->only(['index', 'create', 'store']);
Route::post('logistic/spipping-status/{id}/update', 'LogisticController@updateShippingStatus')->name('logistic.shipping-status.update');
