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
                            <h3 class="card-title mt-1">Campaign Details</h3>
                            <a href="{{ route('backend.cms.campaign.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Campaign List</a>
                            @if(\App\Helpers\AuthManager::isSuperAdmin() || \App\Helpers\AuthManager::isAdmin() || \App\Helpers\AuthManager::isInfluencerManager())
                                <a href="{{ route('backend.cms.campaign.influencer.create', [$campaign->id]) }}" type="button" class="btn btn-primary btn-sm text-white float-right mr-2">
                                    Add Influencer to Campaign
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <div class="profile-user-img img-fluid img-circle"
                                     style="background-image: url({{ $campaign->logo->file_url ?? config('core.image.default.logo_preview') }})">
                                </div>
                            </div>
                            <h3 class="profile-username text-center">{{ $campaign->title ?? '' }}</h3>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-body">
                            <strong>
                                Brand
                            </strong>
                            <p class="text-muted mb-0">
                                <span class="text-dark">Name: </span> {{ $campaign->brand->additionalInfo->first_name ?? '' }}
                                <br>
                                <span class="text-dark">Contact: </span> {{ $campaign->brand->email ?? '' }}
                                <br>
                                <a href="{{ route('backend.cms.brand.show', [$campaign->brand->id]) }}">
                                    <span class="badge badge-primary">
                                        View
                                    </span>
                                </a>
                            </p>
                            <hr>
                            <strong>
                                Start Date
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->start_date ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                First Content Online
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->first_content_online ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Cycle Count
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->cycle_count ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Cycle Time Unit
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->cycle_time_unit == 1 ? 'Monthly' : 'Weekly' }}
                            </p>
                            <hr>
                            <strong>
                                Next Deadline
                            </strong>
                            <p class="text-muted mb-0">
                                @php
                                    $start_date = \Carbon\Carbon::parse($campaign->start_date);
                                    if ($campaign->cycle_time_unit == 1)
                                        $next_deadline = $start_date->addMonths($campaign->cycle_count);
                                    else if ($campaign->cycle_time_unit == 2)
                                        $next_deadline = $start_date->addWeeks($campaign->cycle_count);
                                @endphp
                                {{ $next_deadline->format('M d, Y') ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Products
                            </strong>
                            <p class="text-muted mb-0">
                                @if(count($campaign->product_ids ?? []))
                                    @foreach($campaign->product_ids as $index => $category)
                                        <span class="badge badge-primary">
                                            {{ $category }}
                                        </span>
                                    @endforeach
                                @else
                                    Not Found
                                @endif
                            </p>
                            <hr>
                            <strong>
                                Target Group Influencer Category
                            </strong>
                            <p class="text-muted mb-0">
                                @if(count($campaign->target_influencer_category_ids ?? []))
                                    @foreach($campaign->target_influencer_category_ids as $index => $category)
                                        <span class="badge badge-primary">
                                            {{ $category }}
                                        </span>
                                    @endforeach
                                @else
                                    Not Found
                                @endif
                            </p>
                            <hr>
                            <strong>
                                Target Group Influencer Gender
                            </strong>
                            <p class="text-muted mb-0">
                                @if(count($campaign->target_influencer_genders ?? []))
                                    @foreach($campaign->target_influencer_genders as $index => $gender)
                                        <span class="badge badge-success">
                                            {{ $gender == 1 ? 'Male' : '' }}
                                            {{ $gender == 2 ? 'Female' : '' }}
                                            {{ $gender == 3 ? 'Others' : '' }}
                                        </span>
                                    @endforeach
                                @else
                                    Not Found
                                @endif
                            </p>
                            <hr>
                            <strong>
                                Age Range
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->target_influencer_lower_age ?? 0 }} - {{ $campaign->target_influencer_upper_age ?? 0 }}
                            </p>
                            <hr>
                            <strong>
                                Amount of Influencer Per Cycle
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->amount_of_influencer_per_cycle ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Amount of Influencer Follower Per Cycle
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->amount_of_influencer_follower_per_cycle ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Offer Signed
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->offer_signed == 1 ? 'Yes' : 'No' }}
                            </p>
                            <hr>
                            <strong>
                                Start of Recurring Bill
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->start_of_recurring_bill ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Billing Cycle Count
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->billing_cycle_count ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Billing Cycle Time Unit
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->billing_cycle_time_unit == 1 ? 'Monthly' : 'Weekly' }}
                            </p>
                            <hr>
                            <strong>
                                Billing Cycle Next Deadline
                            </strong>
                            <p class="text-muted mb-0">
                                @php
                                    $start_of_recurring_bill = \Carbon\Carbon::parse($campaign->start_of_recurring_bill);
                                    if ($campaign->billing_cycle_time_unit == 1)
                                        $next_deadline = $start_of_recurring_bill->addMonths($campaign->billing_cycle_count);
                                    else if ($campaign->billing_cycle_time_unit == 2)
                                        $next_deadline = $start_of_recurring_bill->addWeeks($campaign->billing_cycle_count);
                                @endphp
                                {{ $next_deadline->format('M d, Y') ?? '' }}
                            </p>
                            <hr>
                            <strong>
                                Euros Total
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $campaign->euros_total ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    @if(!\App\Helpers\AuthManager::isInfluencer())
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                Influencers
                            </div>
                            <div class="card-body">
                                @if(count($campaign->campaignInfluencers))
                                    <div class="influencer-list">
                                        <div class="table-responsive w-100">
                                            <table class="table table-striped projects">
                                                <tbody>
                                                @foreach($campaign->campaignInfluencers as $index => $campaignInfluencer)
                                                    <tr>
                                                        @php
                                                            $influencer = $campaignInfluencer->user ?? null;
                                                        @endphp

                                                        <td>
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <img alt="Avatar" class="table-avatar" src="{{ config('core.image.default.avatar_male') }}">
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <a class="font-weight-bold">
                                                                {{ $influencer->additionalInfo->first_name ?? '' }}
                                                                {{ $influencer->additionalInfo->last_name ?? '' }}
                                                            </a>
                                                            <br>
                                                            <small class="text-primary font-weight-bold">
                                                                @foreach($campaignInfluencer->content_types as $index => $content_type)
                                                                    {{ $content_type }}
                                                                    @if($index + 1 < count($campaignInfluencer->content_types))
                                                                        ,
                                                                    @endif
                                                                @endforeach
                                                            </small>
                                                        </td>
                                                        <td>
                                                            <a class="font-weight-bold">
                                                                Username
                                                            </a>
                                                            <br>
                                                            <div class="mt-1">
                                                                <i class="fas fa-check">
                                                                </i>
                                                                <a class="" href="javascript:void(0)">
                                                                    {{ $influencer->socialAccountInfo->instagram_username ?? '' }}
                                                                </a>
                                                            </div>
                                                            <div class="mt-1">
                                                                <i class="fas fa-check">
                                                                </i>
                                                                <a class="" href="javascript:void(0)">
                                                                    {{ $influencer->socialAccountInfo->tiktok_username ?? '' }}
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a class="font-weight-bold">
                                                                Follower
                                                            </a>
                                                            <br>
                                                            <div class="mt-1">
                                                                <a>
                                                                    {{ \App\Helpers\NumberManager::shortFormat($influencer->socialAccountInfo->instagram_followers ?? 0) }}
                                                                </a>
                                                            </div>
                                                            <div class="mt-1">
                                                                <a>
                                                                    {{ \App\Helpers\NumberManager::shortFormat($influencer->socialAccountInfo->tiktok_followers ?? 0) }}
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <i class="fa fa-user"></i>
                                        <span class="d-block">No Influencer Here</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    {{--<div class="card">
                        <div class="card-header font-weight-bold">
                            Brands
                        </div>
                        <div class="card-body">
                            @if(count($brands))
                                <div class="brand-list">
                                    <div class="row">
                                        @foreach($brands as $index => $brand)
                                            <div class="col-lg-6 col-6">
                                                <div class="small-box bg-gradient-secondary">
                                                    <div class="inner text-justify">
                                                        <h5 class="font-weight-bold text-center">{{ $brand->title }}</h5>
                                                        <hr>
                                                        <div class="row" style="font-size: 12px">
                                                            <div class="col-6">
                                                                <span>Products:</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span>{{ $brand->products_count }}</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span>Contact:</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span>{{ $brand->user->email ?? '' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a href="{{ route('backend.cms.brand.show', [$brand->id]) }}" class="small-box-footer">
                                                        More Info <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="text-center">
                                    <i class="fa fa-product-hunt"></i>
                                    <span class="d-block">No Brand Here</span>
                                </div>
                            @endif
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('style')
    <style>
        .influencer-list {
            max-height: 600px;
            overflow-y: scroll;
        }
        .influencer-list::-webkit-scrollbar {
            display: none;
        }

        .brand-list {
            max-height: 400px;
            overflow-y: scroll;
        }
        .brand-list::-webkit-scrollbar {
            display: none;
        }

        ul.box-footer {
            list-style: none;
            display: flex;
            background-color: rgba(0,0,0,.1);
            color: rgba(255,255,255,.8);
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
        }
        ul.box-footer li {
            width: 33.33%;
        }
        ul.box-footer li a {
            color: #fff;
        }
        ul.box-footer li a:hover {
            color: #fff3cd;
        }

        ul.box-body {

        }
        ul.box-body li {
            width: 42%;
        }
    </style>
@stop
