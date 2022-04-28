@extends('admin.layouts.master')
@php
    $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
@endphp

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.partials._alert')
                    @if(\App\Helpers\AuthManager::isSuperAdmin() || \App\Helpers\AuthManager::isAdmin() || \App\Helpers\AuthManager::isInfluencerManager())
                        <div class="card card-gray-dark card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Dashboard</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="p-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">
                                                        Overall Influencers
                                                    </span>
                                                    <span class="info-box-number fa-2x">
                                                        {{ $dashboard->statistics->overall_influencers }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">
                                                        Pending Influencers
                                                    </span>
                                                    <span class="info-box-number fa-2x">
                                                        {{ $dashboard->statistics->pending_influencers }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">
                                                        Accepted Influencers
                                                    </span>
                                                    <span class="info-box-number fa-2x">
                                                        {{ $dashboard->statistics->accepted_influencers }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">
                                                        Denied Influencers
                                                    </span>
                                                    <span class="info-box-number fa-2x">
                                                        {{ $dashboard->statistics->denied_influencers }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">
                                                        Favourite Influencers
                                                    </span>
                                                    <span class="info-box-number fa-2x">
                                                        {{ $dashboard->statistics->favourite_influencers }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(\App\Helpers\AuthManager::isBrand())
                        <div class="card card-gray-dark card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Dashboard</h3>
                            </div>
                            <card class="card-body" style="background: #f4f6f9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-box bg-white">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-bold">
                                                    Active Campaigns
                                                </span>
                                                <div class="info-box mt-2 mb-2" style="background: #f4f6f9">
                                                    <div class="info-box-content table-responsive">
                                                        <table class="table mb-0">
                                                            <tr>
                                                                <td>
                                                                    <span class="info-box-number">
                                                                        {{ $dashboard->statistics->campaign->title ?? '' }}
                                                                        <span class="badge badge-danger badge-pill">
                                                                            {{ $dashboard->statistics->overall_campaigns }}
                                                                        </span>
                                                                    </span>
                                                                    <small class="d-block">
                                                                        Start Date: {{ $dashboard->statistics->campaign->start_date ?? '00.00.0000' }}
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <i class="fa fa-user"></i> {{ $dashboard->statistics->overall_influencers }}
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('backend.cms.campaign.index') }}" class="btn btn-primary btn-sm text-white">
                                                                        View
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-box bg-white">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-bold">
                                                    Reporting Tool
                                                </span>
                                                <div class="info-box mt-2 mb-2" style="background: #f4f6f9">
                                                    <div class="info-box-content table-responsive">
                                                        <table class="table mb-0">
                                                            <tr>
                                                                <td>
                                                                    <span class="info-box-number">
                                                                        Reporting Tool
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-primary btn-sm text-white">
                                                                        Open
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-box bg-white">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-bold">
                                                    Favourites
                                                </span>
                                                <div class="info-box mt-2 mb-2" style="background: #f4f6f9">
                                                    <div class="info-box-content table-responsive">
                                                        <table class="table mb-0">
                                                            <tr>
                                                                <td>
                                                                    <span class="info-box-number">
                                                                        Favourite Influencer
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <i class="fa fa-user"></i> {{ $dashboard->statistics->favourite_influencers }}
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('backend.ums.influencer.index', ['favourite' => 1]) }}" class="btn btn-primary btn-sm text-white">
                                                                        View
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-box bg-white">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-bold">
                                                    Setting
                                                </span>
                                                <div class="info-box mt-2 mb-2" style="background: #f4f6f9">
                                                    <div class="info-box-content table-responsive">
                                                        <table class="table mb-0">
                                                            <tr>
                                                                <td>
                                                                    <span class="info-box-number">
                                                                        Company Details
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-primary btn-sm text-white">
                                                                        View
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </card>
                        </div>
                </div>
                @endif

                    @if(\App\Helpers\AuthManager::isInfluencer())
                        <div class="card card-gray-dark card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Dashboard</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="p-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">
                                                        Overall Campaigns
                                                    </span>
                                                    <span class="info-box-number fa-2x">
                                                        {{ $dashboard->statistics->overall_campaigns }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">
                                                        Active Campaigns
                                                    </span>
                                                    <span class="info-box-number fa-2x">
                                                        {{ $dashboard->statistics->active_campaigns }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">
                                                        Expired Campaigns
                                                    </span>
                                                    <span class="info-box-number fa-2x">
                                                        {{ $dashboard->statistics->expired_campaigns }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">
                                                        Pending Campaigns
                                                    </span>
                                                    <span class="info-box-number fa-2x">
                                                        {{ $dashboard->statistics->pending_campaigns }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">
                                                        Accepted Campaigns
                                                    </span>
                                                    <span class="info-box-number fa-2x">
                                                        {{ $dashboard->statistics->accepted_campaigns }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">
                                                        Denied Campaigns
                                                    </span>
                                                    <span class="info-box-number fa-2x">
                                                        {{ $dashboard->statistics->denied_campaigns }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('style')
    <style>
        form {
            display: unset;
        }

        .table td, .table th {
            padding: 0.5rem;
            vertical-align: middle;
            horiz-align: center;
            border-top: unset;
        }
    </style>
@stop
