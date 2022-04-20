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
                                <h3 class="card-title">Influencer List</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="p-4">
                                    <div class="row">
                                        <!--<div class="col-md-5">
                                                <div class="form-group mb-0">
                                                    <label>Sort by</label>
                                                    <select class="form-control d-inline ml-2 w-auto">
                                                        <option>Filters</option>
                                                        <option>Name</option>
                                                    </select>
                                                </div>
                                            </div>-->
                                        <div class="col-md-12">
                                            <div class="table-responsive shadow w-100">
                                                <table class="table mb-0 text-center">
                                                    <tbody>
                                                    <tr>
                                                        <td class="border-top-0 p-0 pl-1">
                                                            Statistics
                                                        </td>
                                                        <td class="border-top-0 p-0">
                                                            <small class="font-weight-bold">
                                                                Overall
                                                            </small>
                                                            <br>
                                                            <small class="text-primary font-weight-bold">
                                                                {{ $dashboard->statistics->overall_influencers }}
                                                            </small>
                                                        </td>
                                                        <td class="border-top-0 p-0">
                                                            <small class="font-weight-bold">
                                                                Pending
                                                            </small>
                                                            <br>
                                                            <small class="text-primary font-weight-bold">
                                                                {{ $dashboard->statistics->pending_influencers }}
                                                            </small>
                                                        </td>
                                                        <td class="border-top-0 p-0">
                                                            <small class="font-weight-bold">
                                                                Accepted
                                                            </small>
                                                            <br>
                                                            <small class="text-primary font-weight-bold">
                                                                {{ $dashboard->statistics->accepted_influencers }}
                                                            </small>
                                                        </td>
                                                        <td class="border-top-0 p-0">
                                                            <small class="font-weight-bold">
                                                                Denied
                                                            </small>
                                                            <br>
                                                            <small class="text-primary font-weight-bold">
                                                                {{ $dashboard->statistics->denied_influencers }}
                                                            </small>
                                                        </td>
                                                        <td class="border-top-0 p-0 pr-1">
                                                            <small class="font-weight-bold">
                                                                Favourites
                                                            </small>
                                                            <br>
                                                            <small class="text-primary font-weight-bold">
                                                                {{ $dashboard->statistics->favourite_influencers }}
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(count($dashboard->influencers))
                                    <div class="table-responsive w-100">
                                        <table class="table table-striped projects">
                                            <tbody>
                                            @foreach($dashboard->influencers as $index => $influencer)
                                                <tr>
                                                    <td>
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item">
                                                                <img alt="Avatar" class="table-avatar"
                                                                     src="{{ config('core.image.default.avatar_male') }}">
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
                                                            Instagram Story, TikTok Video
                                                        </small>
                                                        <br>
                                                        <div class="mt-1">
                                                            <!--<a class="btn btn-info btn-xs" href="#">
                                                                <i class="fas fa-clone">
                                                                </i>
                                                            </a>-->
                                                            @if($influencer->is_influencer_accepted == 0)
                                                                {!! Form::open(['url' => route('backend.ums.influencer.status', [$influencer->id]), 'method' => 'put']) !!}
                                                                <input type="hidden" name="is_influencer_accepted"
                                                                       value="1">
                                                                <button class="btn btn-primary btn-xs">
                                                                    <i class="fas fa-check">
                                                                    </i>
                                                                    Accept
                                                                </button>
                                                                {!! Form::close() !!}
                                                                {!! Form::open(['url' => route('backend.ums.influencer.status', [$influencer->id]), 'method' => 'put']) !!}
                                                                <input type="hidden" name="is_influencer_accepted"
                                                                       value="-1">
                                                                <button class="btn btn-danger btn-xs" href="#">
                                                                    <i class="fas fa-minus-circle">
                                                                    </i>
                                                                    Deny
                                                                </button>
                                                                {!! Form::close() !!}
                                                            @endif
                                                            @if($influencer->is_influencer_accepted == 1)
                                                                <span class="text-success">
                                                            <i class="fas fa-check">
                                                            </i>
                                                            <strong>Accepted</strong>
                                                        </span>
                                                            @endif
                                                            @if($influencer->is_influencer_accepted == -1)
                                                                <span class="text-danger">
                                                            <i class="fas fa-minus-circle">
                                                            </i>
                                                            <strong>Denied</strong>
                                                        </span>
                                                            @endif
                                                        </div>
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
                                                    <td>
                                                        @if(!$influencer->is_influencer_add_to_favourite)
                                                            {!! Form::open(['url' => route('backend.ums.influencer.status', [$influencer->id]), 'method' => 'put']) !!}
                                                            <input type="hidden" name="is_influencer_add_to_favourite"
                                                                   value="1">
                                                            <button class="btn btn-secondary btn-sm">
                                                                Add to favourites
                                                            </button>
                                                            {!! Form::close() !!}
                                                        @endif
                                                        @if($influencer->is_influencer_add_to_favourite)
                                                            {!! Form::open(['url' => route('backend.ums.influencer.status', [$influencer->id]), 'method' => 'put']) !!}
                                                            <input type="hidden" name="is_influencer_add_to_favourite"
                                                                   value="0">
                                                            <button class="btn btn-success btn-sm">
                                                                Remove from favourites
                                                            </button>
                                                            {!! Form::close() !!}
                                                        @endif
                                                        <!--<a class="btn btn-info btn-sm" href="#">
                                                    <i class="fas fa-ellipsis-v">
                                                    </i>
                                                </a>-->
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center mb-3">
                                        <i class="fa fa-user"></i>
                                        <span class="d-block">No Influencer Here</span>
                                    </div>
                                @endif
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
                            <h3 class="card-title">Campaigns</h3>
                            <br>
                            <p class="text-sm text-primary">Choose a campaign you want to take part in.</p>
                        </div>
                        @if(count($dashboard->campaigns))
                            <div class="table-responsive w-100">
                                <table class="table table-striped projects">
                                    <tbody>
                                    @foreach($dashboard->campaigns as $index => $campaign)
                                        <tr>
                                            <td>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item-">
                                                        <span class="font-weight-bold d-block">Available Until</span>
                                                        @php
                                                            $start_date = \Carbon\Carbon::parse($campaign->start_date);
                                                            if ($campaign->cycle_time_unit == 1)
                                                                $next_deadline = $start_date->addMonths($campaign->cycle_count);
                                                            else if ($campaign->cycle_time_unit == 2)
                                                                $next_deadline = $start_date->addWeeks($campaign->cycle_count);
                                                        @endphp
                                                        <span>{{ $next_deadline->format('M d, Y') }}</span>
                                                    </li>
                                                    <li class="list-inline-item- mt-3 font-weight-bold">
                                                        Brands
                                                    </li>
                                                    <li class="list-inline-item- mt-3 font-weight-bold">
                                                        Briefings
                                                    </li>
                                                </ul>
                                            </td>

                                            @php
                                                $brands = Modules\Cms\Entities\Brand::query()->whereIn('id', $campaign->brand_ids)->get();
                                                $campaign_accept = \Modules\Cms\Entities\CampaignInfluencer::query()
                                                                                         ->where('influencer_id', auth()->user()->id)
                                                                                         ->where('campaign_id', $campaign->id)
                                                                                         ->first();
                                            @endphp

                                            @for($index = 0; $index < 5; $index++)
                                                <td>
                                                    @if(isset($brands[$index]))
                                                        <ul class="list-inline text-center">
                                                            <li class="list-inline-item m-auto">
                                                                <img alt="Avatar" class="table-avatar"
                                                                     src="{{ config('core.image.default.avatar_male') }}">
                                                            </li>
                                                            <li class="list-inline-item- mt-3 font-weight-bold">
                                                                {{ $brands[$index]->title ?? '' }}
                                                            </li>
                                                            <li class="list-inline-item- mt-3 font-weight-bold">
                                                                <a class="btn btn-secondary btn-sm {{ isset($campaign_accept->status) ? ($campaign_accept->status == 0 ? 'disabled' : '') : '' }}"
                                                                   href="{{ route('backend.cms.brand.show', [$brands[$index]->id]) }}">
                                                                    Read
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    @else
                                                        <ul class="list-inline text-center">
                                                            <li class="list-inline-item m-auto">
                                                                <img class="table-avatar">
                                                            </li>
                                                            <li class="list-inline-item- mt-3 font-weight-bold">
                                                                {{ '' }}
                                                            </li>
                                                            <li class="list-inline-item- mt-3 font-weight-bold">
                                                                {{ '' }}
                                                            </li>
                                                        </ul>
                                                    @endif
                                                </td>
                                            @endfor

                                            <td>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item font-weight-bold"
                                                        style="height: 2.5rem;">
                                                        {{ count($brands) }} Brands
                                                        <br>
                                                        <a class="btn btn-outline-primary btn-sm pt-0 pb-0"
                                                           href="{{ route('backend.cms.campaign.show', [$campaign->id]) }}">
                                                            More
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item- mt-3 font-weight-bold">
                                                        {{ '' }}
                                                    </li>
                                                    <li class="list-inline-item- mt-3 font-weight-bold">
                                                        {{ '' }}
                                                    </li>
                                                </ul>

                                                <div class="mt-1">
                                                    @if(!$campaign_accept)
                                                        {!! Form::open(['url' => route('backend.cms.campaign-accept.store'), 'method' => 'campaign-accept']) !!}
                                                        <input type="hidden" name="campaign_id"
                                                               value="{{ $campaign->id }}">
                                                        <input type="hidden" name="status" value="{{ 1 }}">
                                                        <button class="btn btn-primary btn-xs">
                                                            <i class="fas fa-check">
                                                            </i>
                                                            Accept
                                                        </button>
                                                        {!! Form::close() !!}
                                                        {!! Form::open(['url' => route('backend.cms.campaign-accept.store'), 'method' => 'campaign-accept']) !!}
                                                        <input type="hidden" name="campaign_id"
                                                               value="{{ $campaign->id }}">
                                                        <input type="hidden" name="status" value="{{ 0 }}">
                                                        <button class="btn btn-danger btn-xs" href="#">
                                                            <i class="fas fa-minus-circle">
                                                            </i>
                                                            Deny
                                                        </button>
                                                        {!! Form::close() !!}
                                                    @endif
                                                    @if(isset($campaign_accept->status) && $campaign_accept->status == 1)
                                                        <small class="font-weight-bold text-success">
                                                            Accepted
                                                        </small>
                                                    @endif
                                                    @if(isset($campaign_accept->status) && $campaign_accept->status == 0)
                                                        <small class="font-weight-bold text-danger">
                                                            Denied
                                                        </small>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center mb-5 mt-5">
                                <i class="fa fa-exclamation-circle"></i>
                                <span class="d-block">No Campaign Here</span>
                            </div>
                        @endif

                    </div>
            </div>
            @endif
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
