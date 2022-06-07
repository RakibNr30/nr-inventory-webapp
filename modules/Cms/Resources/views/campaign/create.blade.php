@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Create Campaign</h3>
                            <a href="{{ route('backend.cms.campaign.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Campaign List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.cms.campaign.store'), 'method' => 'campaign', 'files' => true]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="@error('title') text-danger @enderror">Title</label>
                                            <input id="title" name="title" value="{{ old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title" autofocus>
                                            @error('title')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="logo" class="@error('logo') text-danger @enderror">Upload Logo</label>
                                            <div class="custom-file">
                                                <input type="file" name="logo" value="{{ old('logo') }}" class="custom-file-input @error('logo') is-invalid @enderror" id="customFile">
                                                <label class="custom-file-label font-weight-normal" for="customFile">Choose file</label>
                                            </div>
                                            @error('logo')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="brand_id" class="@error('brand_id') text-danger @enderror">Brand</label>
                                            <select id="brand_id" name="brand_id"
                                                    class="form-control select2 @error('brand_id') is-invalid @enderror" data-placeholder="Select a brand">
                                                <option value="">Select a brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->additionalInfo->first_name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date" class="@error('start_date') text-danger @enderror">Start Date</label>
                                            <input id="start_date" name="start_date" value="{{ old('start_date') }}" type="text" class="form-control datepicker @error('start_date') is-invalid @enderror" placeholder="Enter start date" autofocus>
                                            @error('start_date')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_content_online" class="@error('first_content_online') text-danger @enderror">First Content Online</label>
                                            <input id="first_content_online" name="first_content_online" value="{{ old('first_content_online') }}" type="text" class="form-control datepicker @error('first_content_online') is-invalid @enderror" placeholder="Enter first content online" autofocus>
                                            @error('first_content_online')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cycle_count" class="@error('cycle_count') text-danger @enderror">Cycle Count</label>
                                            <input id="cycle_count" name="cycle_count" value="{{ old('cycle_count') }}" type="number" min="0" class="form-control @error('cycle_count') is-invalid @enderror" placeholder="Enter cycle count" autofocus>
                                            @error('cycle_count')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
{{--                                            <label for="cycle_time_unit" class="d-block @error('cycle_time_unit') text-danger @enderror">--}}
{{--                                                Cycle Time Unit--}}
{{--                                            </label>--}}
                                            <div class="custom-control custom-radio d-inline-" style="margin-top: 22px">
                                                <input class="custom-control-input" type="radio" id="customRadio1" name="cycle_time_unit" value="1" checked>
                                                <label for="customRadio1" class="custom-control-label">Monthly</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline- ml-3-">
                                                <input class="custom-control-input" type="radio" id="customRadio2" name="cycle_time_unit" value="2">
                                                <label for="customRadio2" class="custom-control-label">Weekly</label>
                                            </div>
                                            @error('cycle_time_unit')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="product_ids" class="@error('product_ids') text-danger @enderror">Product</label>
                                            <select id="product_ids" name="product_ids[]"
                                                    class="form-control select2 @error('product_ids') is-invalid @enderror" data-placeholder="Select products" multiple>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_ids')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="target_influencer_category_ids" class="@error('target_influencer_category_ids') text-danger @enderror">
                                                Influencer Target Group Category
                                            </label>
                                            <select id="target_influencer_category_ids" name="target_influencer_category_ids[]"
                                                    class="form-control select2 @error('target_influencer_category_ids') is-invalid @enderror" data-placeholder="Select Categories" multiple>
                                                @foreach($influencerCategories as $influencerCategorie)
                                                    <option value="{{ $influencerCategorie->id }}">{{ $influencerCategorie->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('target_influencer_category_ids')
                                            <span class="invalid-feedback d-block"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="target_influencer_genders" class="d-block @error('target_influencer_genders') text-danger @enderror">
                                                Influencer Target Group Gender
                                            </label>
                                            @foreach(config('core.genders') as $gender_key => $gender)
                                                <div class="custom-control custom-checkbox d-inline">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox{{ $gender_key }}" name="target_influencer_genders[]" value="{{ $gender_key }}" checked>
                                                    <label for="customCheckbox{{ $gender_key }}" class="custom-control-label ml-3 font-weight-normal">{{ $gender }}</label>
                                                </div>
                                            @endforeach
                                            @error('target_influencer_genders')
                                            <span class="invalid-feedback d-block"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="target_influencer_lower_age" class="@error('target_influencer_lower_age') text-danger @enderror">Age From</label>
                                            <input id="target_influencer_lower_age" name="target_influencer_lower_age" value="{{ old('target_influencer_lower_age') }}" type="number" min="0" class="form-control @error('target_influencer_lower_age') is-invalid @enderror" placeholder="Enter age from" autofocus>
                                            @error('target_influencer_lower_age')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="target_influencer_upper_age" class="@error('target_influencer_upper_age') text-danger @enderror">Age To</label>
                                            <input id="target_influencer_upper_age" name="target_influencer_upper_age" value="{{ old('target_influencer_upper_age') }}" type="number" min="0" class="form-control @error('target_influencer_upper_age') is-invalid @enderror" placeholder="Enter age to" autofocus>
                                            @error('target_influencer_upper_age')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="target_influencer_details" class="@error('target_influencer_details') text-danger @enderror">Influencer Target Group Details</label>
                                            <textarea id="target_influencer_details" name="target_influencer_details" class="form-control" rows="3" placeholder="Enter target influencer details">{{ old('target_influencer_details') }}</textarea>
                                            @error('target_influencer_details')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amount_of_influencer_per_cycle" class="@error('amount_of_influencer_per_cycle') text-danger @enderror">Amount of Influencer Per Cycle</label>
                                            <input id="amount_of_influencer_per_cycle" name="amount_of_influencer_per_cycle" value="{{ old('amount_of_influencer_per_cycle') }}" type="number" min="0" class="form-control @error('amount_of_influencer_per_cycle') is-invalid @enderror" placeholder="Enter amount of influencer per cycle" autofocus>
                                            @error('amount_of_influencer_per_cycle')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amount_of_influencer_follower_per_cycle" class="@error('amount_of_influencer_follower_per_cycle') text-danger @enderror">Amount of Influencer Follower Per Cycle</label>
                                            <input id="amount_of_influencer_follower_per_cycle" name="amount_of_influencer_follower_per_cycle" value="{{ old('amount_of_influencer_follower_per_cycle') }}" type="number" min="0" class="form-control @error('amount_of_influencer_follower_per_cycle') is-invalid @enderror" placeholder="Enter amount of influencer follower per cycle" autofocus>
                                            @error('amount_of_influencer_follower_per_cycle')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="extra_agreements" class="@error('extra_agreements') text-danger @enderror">Extra Agreements</label>
                                            <textarea id="extra_agreements" name="extra_agreements" class="form-control" rows="3" placeholder="Enter extra agreements">{{ old('extra_agreements') }}</textarea>
                                            @error('extra_agreements')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="d-block">
                                                Individual Coupon Codes
                                            </label>
                                            <div class="custom-control custom-checkbox d-inline">
                                                <input class="custom-control-input" type="checkbox" id="IcustomCheckbox1" name="individual_coupon_code_internal" value="{{ 1 }}">
                                                <label for="IcustomCheckbox1" class="custom-control-label ml-3 font-weight-normal">Internal</label>
                                            </div>
                                            <div class="custom-control custom-checkbox d-inline">
                                                <input class="custom-control-input" type="checkbox" id="IcustomCheckbox2" name="individual_coupon_code_brand" value="{{ 1 }}">
                                                <label for="IcustomCheckbox2" class="custom-control-label ml-3 font-weight-normal">Brand</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="d-block">
                                                Individual Swipe-Up Links
                                            </label>
                                            <div class="custom-control custom-checkbox d-inline">
                                                <input class="custom-control-input" type="checkbox" id="IcustomCheckbox3" name="individual_swipe_up_link_internal" value="{{ 1 }}">
                                                <label for="IcustomCheckbox3" class="custom-control-label ml-3 font-weight-normal">Internal</label>
                                            </div>
                                            <div class="custom-control custom-checkbox d-inline">
                                                <input class="custom-control-input" type="checkbox" id="IcustomCheckbox4" name="individual_swipe_up_link_brand" value="{{ 1 }}">
                                                <label for="IcustomCheckbox4" class="custom-control-label ml-3 font-weight-normal">Brand</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="d-block">
                                                Influencer Shipping Address
                                            </label>
                                            <div class="custom-control custom-checkbox d-inline">
                                                <input class="custom-control-input" type="checkbox" id="IcustomCheckbox5" name="influencer_shipping_address_brand" value="{{ 1 }}">
                                                <label for="IcustomCheckbox5" class="custom-control-label ml-3 font-weight-normal">Brand</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="campaign_goals" class="d-block @error('campaign_goals') text-danger @enderror">
                                                Campaign Goals
                                            </label>
                                            @foreach(config('core.campaign_goals') as $goal_key => $campaign_goal)
                                                <div class="custom-control custom-checkbox d-inline">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox{{ $goal_key }}" name="campaign_goals[]" value="{{ $goal_key }}">
                                                    <label for="customCheckbox{{ $goal_key }}" class="custom-control-label ml-3 font-weight-normal">{{ $campaign_goal }}</label>
                                                </div>
                                            @endforeach
                                            @error('campaign_goals')
                                            <span class="invalid-feedback d-block"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="desired_content_notes" class="@error('desired_content_notes') text-danger @enderror">Desired Content Notes</label>
                                            <textarea id="desired_content_notes" name="desired_content_notes" class="form-control" rows="3" placeholder="Enter extra agreements">{{ old('desired_content_notes') }}</textarea>
                                            @error('desired_content_notes')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="d-block">
                                            Content Requirements
                                        </label>
                                        <span class="d-block font-weight-light">
                                            Leave blank if there are no specific requirements.
                                        </span>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Placements</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="float-right">
                                                    Your settings must match 100%.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table w-100">
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="instagram_story" class="font-weight-normal @error('instagram_story') text-danger @enderror">
                                                            Instagram Story
                                                        </label>
                                                        <input id="instagram_story" name="instagram_story" value="{{ old('instagram_story') ?? 0 }}" type="number" min="0" max="100" class="form-control percentages @error('instagram_story') is-invalid @enderror" placeholder="" autofocus>
                                                        @error('instagram_story')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="instagram_feed" class="font-weight-normal @error('instagram_feed') text-danger @enderror">
                                                            Instagram Feed
                                                        </label>
                                                        <input id="instagram_feed" name="instagram_feed" value="{{ old('instagram_feed') ?? 0 }}" type="number" min="0" max="100" class="form-control @error('instagram_feed') is-invalid @enderror" placeholder="" autofocus>
                                                        @error('instagram_feed')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="instagram_reel" class="font-weight-normal @error('instagram_reel') text-danger @enderror">
                                                            Instagram Reel
                                                        </label>
                                                        <input id="instagram_reel" name="instagram_reel" value="{{ old('instagram_reel') ?? 0 }}" type="number" min="0" max="100" class="form-control @error('instagram_reel') is-invalid @enderror" placeholder="" autofocus>
                                                        @error('instagram_reel')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="instagram_igtv" class="font-weight-normal @error('instagram_igtv') text-danger @enderror">
                                                            Instagram IGTV
                                                        </label>
                                                        <input id="instagram_igtv" name="instagram_igtv" value="{{ old('instagram_igtv') ?? 0 }}" type="number" min="0" max="100" class="form-control @error('instagram_igtv') is-invalid @enderror" placeholder="" autofocus>
                                                        @error('instagram_igtv')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="tiktok_video" class="font-weight-normal @error('tiktok_video') text-danger @enderror">
                                                            TikTok Video
                                                        </label>
                                                        <input id="tiktok_video" name="tiktok_video" value="{{ old('tiktok_video') ?? 0 }}" type="number" min="0" max="100" class="form-control @error('tiktok_video') is-invalid @enderror" placeholder="" autofocus>
                                                        @error('tiktok_video')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="d-block">
                                                    Extras
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="float-right">
                                                    Your settings can not exceed 100%.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table w-100 mb-0">
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="extra_content_1" placeholder="Your requirement" class="form-control extra_content" value="{{ old('extra_content_1') }}">
                                                        <input id="extra_content_1_value" name="extra_content_1_value" value="{{ old('extra_content_1_value') ?? 0 }}" type="number" min="0" max="100" class="form-control percentages @error('extra_content_1_value') is-invalid @enderror" placeholder="" autofocus>
                                                        @error('extra_content_1_value')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="extra_content_2" placeholder="Your requirement" class="form-control extra_content" value="{{ old('extra_content_2') }}">
                                                        <input id="extra_content_2_value" name="extra_content_2_value" value="{{ old('extra_content_2_value') ?? 0 }}" type="number" min="0" max="100" class="form-control percentages @error('extra_content_2_value') is-invalid @enderror" placeholder="" autofocus>
                                                        @error('extra_content_2_value')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="extra_content_3" placeholder="Your requirement" class="form-control extra_content" value="{{ old('extra_content_3') }}">
                                                        <input id="extra_content_3_value" name="extra_content_3_value" value="{{ old('extra_content_3_value') ?? 0 }}" type="number" min="0" max="100" class="form-control percentages @error('extra_content_3_value') is-invalid @enderror" placeholder="" autofocus>
                                                        @error('extra_content_3_value')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="extra_content_4" placeholder="Your requirement" class="form-control extra_content" value="{{ old('extra_content_4') }}">
                                                        <input id="extra_content_4_value" name="extra_content_4_value" value="{{ old('extra_content_4_value') ?? 0 }}" type="number" min="0" max="100" class="form-control percentages @error('extra_content_4_value') is-invalid @enderror" placeholder="" autofocus>
                                                        @error('extra_content_4_value')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="extra_content_5" placeholder="Your requirement" class="form-control extra_content" value="{{ old('extra_content_5') }}">
                                                        <input id="extra_content_5_value" name="extra_content_5_value" value="{{ old('extra_content_5_value') ?? 0 }}" type="number" min="0" max="100" class="form-control percentages @error('extra_content_5_value') is-invalid @enderror" placeholder="" autofocus>
                                                        @error('extra_content_5_value')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="briefing_pdf" class="@error('briefing_pdf') text-danger @enderror">Briefing PDF</label>
                                            <div class="custom-file">
                                                <input type="file" name="briefing_pdf" value="{{ old('briefing_pdf') }}" class="custom-file-input @error('briefing_pdf') is-invalid @enderror" id="customFile">
                                                <label class="custom-file-label font-weight-normal" for="customFile">Choose file</label>
                                            </div>
                                            @error('briefing_pdf')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="additional_info" class="@error('additional_info') text-danger @enderror">Additional Info</label>
                                            <textarea id="additional_info" name="additional_info" rows="3"
                                                      class="form-control @error('additional_info') is-invalid @enderror"
                                                      placeholder="Enter additional info">{{ old('additional_info') }}</textarea>
                                            @error('additional_info')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="personal_notes" class="@error('personal_notes') text-danger @enderror">Personal Notes</label>
                                            <textarea id="personal_notes" name="personal_notes" class="form-control" rows="3" placeholder="Enter extra agreements">{{ old('personal_notes') }}</textarea>
                                            @error('personal_notes')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="offer_signed" class="d-block @error('offer_signed') text-danger @enderror">Offer Signed</label>
                                            <div class="custom-control custom-radio d-inline">
                                                <input class="custom-control-input" type="radio" id="customRadio11" name="offer_signed" value="1" checked>
                                                <label for="customRadio11" class="custom-control-label">Yes</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline ml-3">
                                                <input class="custom-control-input" type="radio" id="customRadio12" name="offer_signed" value="0">
                                                <label for="customRadio12" class="custom-control-label">No</label>
                                            </div>
                                            @error('offer_signed')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_of_recurring_bill" class="@error('start_of_recurring_bill') text-danger @enderror">Start of Recurring Bill</label>
                                            <input id="start_of_recurring_bill" name="start_of_recurring_bill" value="{{ old('start_of_recurring_bill') }}" type="text" class="form-control datepicker @error('start_of_recurring_bill') is-invalid @enderror" placeholder="Enter start of recurring bill" autofocus>
                                            @error('start_of_recurring_bill')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="billing_cycle_count" class="@error('billing_cycle_count') text-danger @enderror">Billing Cycle</label>
                                            <input id="billing_cycle_count" name="billing_cycle_count" value="{{ old('billing_cycle_count') }}" type="number" min="0" class="form-control @error('billing_cycle_count') is-invalid @enderror" placeholder="Enter billing cycle count" autofocus>
                                            @error('billing_cycle_count')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
{{--                                            <label for="billing_cycle_time_unit" class="d-block @error('billing_cycle_time_unit') text-danger @enderror">--}}
{{--                                                Billing Cycle Time Unit--}}
{{--                                            </label>--}}
                                            <div class="custom-control custom-radio d-inline- mt-4-" style="margin-top: 22px">
                                                <input class="custom-control-input" type="radio" id="customRadio21" name="billing_cycle_time_unit" value="1" checked>
                                                <label for="customRadio21" class="custom-control-label">Monthly</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline- ml-3-">
                                                <input class="custom-control-input" type="radio" id="customRadio22" name="billing_cycle_time_unit" value="2">
                                                <label for="customRadio22" class="custom-control-label">Weekly</label>
                                            </div>
                                            @error('billing_cycle_time_unit')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="euros_total" class="@error('euros_total') text-danger @enderror">Euros Total</label>
                                            <input id="euros_total" name="euros_total" value="{{ old('euros_total') }}" type="number" step="any" min="0" class="form-control @error('euros_total') is-invalid @enderror" placeholder="Enter euros total" autofocus>
                                            @error('euros_total')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                                <a href="{{ route('backend.cms.campaign.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('style')
    <style>
        .select2-selection__rendered {
            /line-height: 28px !important;
        }
        .select2-selection {
            /height: auto !important;
        }
        .form-control.extra_content {
            margin-bottom: 2px;
            border: none;
            padding-left: 0;
        }
    </style>
@stop

@section('script')
@stop
