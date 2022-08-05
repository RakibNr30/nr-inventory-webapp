@extends('admin.layouts.master')

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
                                <h3 class="card-title">Campaign List</h3>
                                <a href="{{ route('backend.cms.campaign.influencer-manager.list') }}" type="button"
                                   class="btn btn-primary btn-sm text-white float-right">Influencer Campaign Manager</a>
                                <a href="{{ route('backend.cms.campaign.create') }}" type="button"
                                   class="btn btn-success btn-sm text-white float-right mr-2">Add new campaign</a>
                            </div>

                            <div class="p-4">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="input-group mb-0">
                                            {!! Form::open(['url' => route('backend.cms.campaign.index'), 'id' => 'search_form', 'method' => 'get']) !!}
                                            <input type="text" name="search" class="form-control" placeholder="Search..." onkeyup="Search()" value="{{ request()->has('search') ? request()->get('search') : '' }}" onfocus="var temp=this.value; this.value=''; this.value=temp" autofocus>
                                            {!! Form::close() !!}
                                            <button class="btn btn-light ml-1"
                                                    data-toggle="collapse"
                                                    data-target="#filters"
                                                    aria-expanded="false"
                                            >
                                                Filter <i class="fas fa-sliders-h ml-1"></i>
                                            </button>
                                        </div>
                                        <div class="card {{ request()->has('filters') ? '' : 'collapse' }} navbar-collapse" id="filters">
                                            {!! Form::open(['url' => route('backend.cms.campaign.index'), 'id' => 'filter_form', 'method' => 'get']) !!}
                                            <div class="input-group text-sm">
                                                <div class="custom-control custom-checkbox d-inline">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="filters[]" value="1" onclick="Filter()" {{ in_array(1, request()->get('filters') ?? []) ? 'checked' : '' }}>
                                                    <label for="customCheckbox1" class="custom-control-label ml-2 font-weight-normal">
                                                        Running
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox d-inline">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="filters[]" value="2" onclick="Filter()" {{ in_array(2, request()->get('filters') ?? []) ? 'checked' : '' }}>
                                                    <label for="customCheckbox2" class="custom-control-label ml-2 font-weight-normal">
                                                        Overdue
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox d-inline">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox3" name="filters[]" value="3" onclick="Filter()" {{ in_array(3, request()->get('filters') ?? []) ? 'checked' : '' }}>
                                                    <label for="customCheckbox3" class="custom-control-label ml-2 font-weight-normal">
                                                        Completed
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox d-inline">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox4" name="filters[]" value="4" onclick="Filter()" {{ in_array(4, request()->get('filters') ?? []) ? 'checked' : '' }}>
                                                    <label for="customCheckbox4" class="custom-control-label ml-2 font-weight-normal">
                                                        Not Active
                                                    </label>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="table-responsive shadow w-100">
                                            <table class="table mb-0 text-center">
                                                <tbody>
                                                <tr>
                                                    <td class="border-top-0 p-0 pl-1">
                                                        Statistics
                                                    </td>
                                                    <td class="border-top-0 p-0">
                                                        <small class="font-weight-bold">
                                                            Running
                                                        </small>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            {{ $dashboard->statistics->running_campaigns }}
                                                        </small>
                                                    </td>
                                                    <td class="border-top-0 p-0">
                                                        <small class="font-weight-bold">
                                                            Overdue
                                                        </small>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            {{ $dashboard->statistics->overdue_campaigns }}
                                                        </small>
                                                    </td>
                                                    <td class="border-top-0 p-0">
                                                        <small class="font-weight-bold">
                                                            Completed
                                                        </small>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            {{ $dashboard->statistics->completed_campaigns }}
                                                        </small>
                                                    </td>
                                                    <td class="border-top-0 p-0">
                                                        <small class="font-weight-bold">
                                                            Not Active
                                                        </small>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            {{ $dashboard->statistics->not_active_campaigns }}
                                                        </small>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                @if(count($campaigns))
                                    <div class="row">
                                        @foreach($campaigns as $index => $campaign)
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-gradient-light">
                                                    <div class="inner text-justify {{ $campaign->is_active ? '' : 'bg-disabled' }}">
                                                        <h5 class="font-weight-bold text-center">{{ $campaign->title }}</h5>
                                                        <div class="row" style="font-size: 12px">
                                                            <div class="col-6">
                                                                <span>Start Date:</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span>{{ $campaign->is_active ? $campaign->start_date : '' }}</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span>Next Deadline:</span>
                                                            </div>
                                                            <div class="col-6">
                                                                @if($campaign->is_active)
                                                                    @php
                                                                        $start_date = \Carbon\Carbon::parse($campaign->start_date);
                                                                        if ($campaign->cycle_time_unit == 1)
                                                                            $next_deadline = $start_date->addMonths(1 + $start_date->diffInMonths(\Carbon\Carbon::now()));
                                                                        else if ($campaign->cycle_time_unit == 2)
                                                                            $next_deadline = $start_date->addWeeks(1 + $start_date->diffInWeeks(\Carbon\Carbon::now()));
                                                                    @endphp
                                                                    <span>{{ $next_deadline->format('d.m.Y') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="col-6 mt-1">
                                                                <i class="fa fa-user"></i>
                                                                <span class="ml-1">{{ \App\Helpers\NumberManager::shortFormat($campaign->campaign_influencers_count) }}/{{ \App\Helpers\NumberManager::shortFormat($campaign->amount_of_influencer_per_cycle) }}</span>
                                                                @if($campaign->is_active)
                                                                    @if($campaign->campaign_influencers_count >= $campaign->amount_of_influencer_per_cycle)
                                                                        <i class="fas fa-check text-primary"></i>
                                                                    @else
                                                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-6 mt-1">
                                                                <i class="fa fa-camera"></i>
                                                                <span class="ml-1">{{ \App\Helpers\NumberManager::shortFormat($campaign->uploaded_content_count) }}/{{ \App\Helpers\NumberManager::shortFormat($campaign->amount_of_influencer_per_cycle) }}</span>
                                                                @if($campaign->is_active)
                                                                    @if($campaign->uploaded_content_count >= $campaign->amount_of_influencer_per_cycle)
                                                                        <i class="fas fa-check text-primary"></i>
                                                                    @else
                                                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-12 mt-1">
                                                                <i class="fa fa-user"></i>
                                                                <span class="ml-1">{{ \App\Helpers\NumberManager::shortFormat($campaign->follower_count) }}/{{ \App\Helpers\NumberManager::shortFormat($campaign->amount_of_influencer_follower_per_cycle) }} Follower</span>
                                                                @if($campaign->is_active)
                                                                    @if($campaign->follower_count >= $campaign->amount_of_influencer_follower_per_cycle)
                                                                        <i class="fas fa-check text-primary"></i>
                                                                    @else
                                                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <ul class="box-footer {{ $campaign->is_active ? '' : 'bg-light' }}">
                                                        <li>
                                                            <a href="{{ route('backend.cms.campaign.show', [$campaign->id]) }}"
                                                               class="{{ $campaign->is_active ? '' : '' }}">
                                                                <i class="fas fa-eye"></i> View
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('backend.cms.campaign.edit', [$campaign->id]) }}"
                                                               class="{{ $campaign->is_active ? '' : '' }}" {{ $campaign->is_active ? '' : '' }} >
                                                                <i class="fa fa-pen"></i> Edit
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="d-block">No Campaign Here</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if(\App\Helpers\AuthManager::isInfluencer())
                        <div class="card card-gray-dark card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Campaigns</h3>
                                <br>
                                <p class="text-sm text-primary mb-0">Choose a campaign you want to take part in.</p>
                                <span>
                                    <i class="fa fa-star text-danger"></i> Main campaign brand. Not removable.
                                </span>
                                <br>
                            </div>

                            @if(count($campaign_influencers))
                                <div class="table-responsive w-100 p-2">
                                    <table class="table table-striped projects mb-0">
                                        <tbody>
                                        @foreach($campaign_influencers as $c_index => $campaign_influencer)
                                            <tr class="{{ $campaign_influencer->campaign->is_active ? '' : 'bg-disabled' }}" style="border-top: 3px solid #fff !important;">
                                                @php
                                                    $available_until = \Carbon\Carbon::parse($campaign_influencer->available_until);
                                                @endphp
                                                <td>
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item-">
                                                            <span class="font-weight-bold d-block">Available Until</span>
                                                            {{--@php
                                                                $start_date = \Carbon\Carbon::parse($campaign_influencer->start_date);
                                                                if ($campaign_influencer->campaign->cycle_time_unit == 1)
                                                                    $next_deadline = $start_date->addMonths($campaign_influencer->cycle_count);
                                                                else if ($campaign_influencer->campaign->cycle_time_unit == 2)
                                                                    $next_deadline = $start_date->addWeeks($campaign_influencer->cycle_count);
                                                            @endphp
                                                            <span>{{ $next_deadline->format('M d, Y') }}</span>--}}
                                                            <span>{{ \Carbon\Carbon::now()->lt($available_until) ? $available_until->format('M d, Y') : 'Expired' }}</span>
                                                            <span>{{ $campaign_influencer->campaign->is_active ? '' : ' / De-activate' }}</span>
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
                                                    $baseBrands = Modules\Ums\Entities\User::query()
                                                    ->whereIn('id', $campaign_influencer->brand_ids ?? [])
                                                    ->whereNotIn('id', $campaign_influencer->denied_brand_ids ?? [])->get();
                                                    $baseCampaignInfluencers = $campaign_influencer->base_campaign_influencers->take(5) ?? [];

                                                    $brands[] = $campaign_influencer->campaign->brand ?? null;
                                                    $campaignInfluencers[] = $campaign_influencer;

                                                    foreach ($baseBrands as $baseBrand) {
                                                        $brands[] = $baseBrand;
                                                    }
                                                    foreach ($baseCampaignInfluencers as $baseCampaignInfluencer) {
                                                        $campaignInfluencers[] = $baseCampaignInfluencer;
                                                    }
                                                @endphp

                                                @for($index = 0; $index < 5; $index++)
                                                    <td>
                                                        @if(isset($brands[$index]) && isset($campaignInfluencers[$index]))
                                                            <ul class="list-inline text-center">
                                                                @if(($campaign_influencer->campaign_accept_status_by_influencer == 0) && (\Carbon\Carbon::now()->lt($available_until)) && ($campaign_influencer->campaign->is_active))
                                                                    @if(count($brands) > 1)
                                                                        @if($campaignInfluencers[$index]->id == $campaign_influencer->id)
                                                                            <span class="brand-close-btn text-danger">
                                                                                <i class="fa fa-star text-danger"></i>
                                                                            </span>
                                                                        @else
                                                                            <span class="brand-close-btn" data-toggle="modal" href="#modal-lg-bc-{{ $c_index }}{{ $index }}">
                                                                                <i class="fa fa-times-circle"></i>
                                                                            </span>
                                                                        @endif
                                                                    @endif

                                                                    <div class="modal fade" id="modal-lg-bc-{{ $c_index }}{{ $index }}" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title text-lg font-weight-bold">
                                                                                        Deny this brand?
                                                                                    </h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">×</span>
                                                                                    </button>
                                                                                </div>
                                                                                {!! Form::open(['url' => route('backend.cms.campaign-influencer.brand.remove', [$campaign_influencer->id, $brands[$index]->id]), 'method' => 'put']) !!}
                                                                                <div class="modal-body">
                                                                                    <div class="form-group text-left mt-2">
                                                                                        <input type="hidden" name="base_campaign_influencer_id" value="{{ $campaignInfluencers[$index]->id }}">
                                                                                        <label for="brand_denied_reason" class="@error('brand_denied_reason') text-danger @enderror">
                                                                                            Write us if you don‘t want to show a specific brand or if you have any other concerns.
                                                                                        </label>
                                                                                        <textarea id="brand_denied_reason" rows="4" name="brand_denied_reason" class="form-control" placeholder="Please give us feedback" required autofocus>{{ old('brand_denied_reason') }}</textarea>
                                                                                        @error('brand_denied_reason')
                                                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="modal-footer justify-content-between">
                                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                                                        Close
                                                                                    </button>
                                                                                    <div class="form-group">
                                                                                        <button type="submit" class="btn btn-danger">
                                                                                            Deny Brand
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                                {!! Form::close() !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                <li class="list-inline-item m-auto">
                                                                    <img alt="Avatar" class="table-avatar"
                                                                         src="{{ $brands[$index]->avatar->file_url ?? config('core.image.default.logo_preview') }}">
                                                                </li>
                                                                <li class="list-inline-item- mt-3 font-weight-bold">
                                                                    {{ $brands[$index]->title ?? '' }}
                                                                </li>
                                                                <li class="list-inline-item- mt-3 font-weight-bold">
                                                                    <a class="btn btn-secondary btn-sm text-white {{ ($campaign_influencer->campaign_accept_status_by_influencer == -1) || (\Carbon\Carbon::now()->gte($available_until) || !$campaign_influencer->campaign->is_active) ? 'disabled' : '' }}"
                                                                       data-toggle="modal" href="#modal-lg-br-{{ $c_index }}{{ $index }}"
                                                                    >
                                                                        Read
                                                                    </a>

                                                                    <div class="modal fade" id="modal-lg-br-{{ $c_index }}{{ $index }}" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content text-left">
                                                                                <div class="modal-header">
                                                                                    <div class="d-inline-block position-relative">
                                                                                        <img alt="Avatar" class="table-avatar" style="border: 1px solid #d5d5d5; height: 60px; width: 60px"
                                                                                             src="{{ $brands[$index]->avatar->file_url ?? config('core.image.default.logo_preview') }}"
                                                                                        >
                                                                                    </div>
                                                                                    <div class="ml-2">
                                                                                        <h4 class="modal-title">
                                                                                            <span class="font-weight-bold text-md">
                                                                                                {{ $brands[$index]->additionalInfo->first_name ?? '' }}
                                                                                            </span>
                                                                                        </h4>
                                                                                        <span class="text-sm font-weight-normal">
                                                                                            Here you‘ll find all relevant information about the brand {{ $brands[$index]->additionalInfo->first_name ?? '' }}. You will recieve further information when your package has been sent out.
                                                                                        </span>
                                                                                    </div>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">×</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        @if(isset($campaign_influencer->campaign->briefing_pdf))
                                                                                            <div class="col-md-12">
                                                                                                <a href="{{ $campaign_influencer->campaign->briefing_pdf->file_url }}" class="btn btn-primary mb-2">Click to open Briefing PDF</a>
                                                                                            </div>
                                                                                        @endif
<!--                                                                                    <div class="col-md-12">
                                                                                            <span class="d-block font-weight-bold">Additional Info</span>
                                                                                            <div class="form-group">
                                                                                                <textarea rows="3" class="form-control text-left bg-white" readonly>{{ $campaign_influencer->campaign->additional_info ?? 'No additional info here' }}</textarea>
                                                                                            </div>
                                                                                        </div>-->
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer justify-content-between">
                                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                    </div>

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
                                                            @if($campaign_influencer->campaign->is_active && !$campaign_influencer->campaign_accept_status_by_influencer == -1)
                                                                <a class="btn btn-outline-primary btn-sm pt-0 pb-0"
                                                                   href="{{ route('backend.cms.campaign.show', [$campaign_influencer->campaign->id]) }}">
                                                                    More
                                                                </a>
                                                            @endif
                                                        </li>
                                                        <li class="list-inline-item- mt-3 font-weight-bold">
                                                            {{ '' }}
                                                        </li>
                                                        <li class="list-inline-item- mt-3 font-weight-bold">
                                                            {{ '' }}
                                                        </li>
                                                    </ul>

                                                    <div class="mt-1">
                                                        @if(($campaign_influencer->campaign_accept_status_by_influencer == 0) && (\Carbon\Carbon::now()->lt($available_until)) && ($campaign_influencer->campaign->is_active))
                                                            {!! Form::open(['url' => route('backend.cms.campaign-influencer.update', [$campaign_influencer->id]), 'method' => 'put']) !!}
                                                            <button class="btn btn-primary btn-xs"
                                                                name="campaign_accept_status_by_influencer" value="{{ 1 }}"
                                                            >
                                                                <i class="fas fa-check">
                                                                </i>
                                                                Accept
                                                            </button>
                                                            {!! Form::close() !!}

                                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-lg-1-{{ $c_index }}">
                                                                <i class="fas fa-minus-circle">
                                                                </i>
                                                                Deny
                                                            </button>

                                                            <div class="modal fade" id="modal-lg-1-{{ $c_index }}" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title text-lg font-weight-bold">
                                                                                Deny this campaign?
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        {!! Form::open(['url' => route('backend.cms.campaign-influencer.update', [$campaign_influencer->id]), 'method' => 'put']) !!}
                                                                        <div class="modal-body">
                                                                            <div class="form-group text-left mt-2">
                                                                                <label for="denied_reason" class="@error('denied_reason') text-danger @enderror">Write us if you don‘t want to show a specific brand or if you have any other concerns.</label>
                                                                                <textarea id="denied_reason" rows="4" name="denied_reason" class="form-control" placeholder="Please give us feedback" required autofocus>
                                                                                    {{ old('denied_reason') }}
                                                                                </textarea>
                                                                                @error('denied_reason')
                                                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                                                Close
                                                                            </button>
                                                                            <div class="form-group">
                                                                                <button type="submit" class="btn btn-danger" name="campaign_accept_status_by_influencer" value="{{ -1 }}">
                                                                                    Deny Campaign
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        {!! Form::close() !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if($campaign_influencer->campaign_accept_status_by_influencer == 1)
                                                            <small class="font-weight-bold text-success">
                                                                Accepted
                                                            </small>
                                                        @endif
                                                        @if($campaign_influencer->campaign_accept_status_by_influencer == -1)
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

                    @if(\App\Helpers\AuthManager::isBrand())
                        <div class="card card-gray-dark card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Campaign List</h3>
                            </div>
                            <div class="p-4">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="input-group mb-0">
                                            {!! Form::open(['url' => route('backend.cms.campaign.index'), 'id' => 'search_form', 'method' => 'get']) !!}
                                            <input type="text" name="search" class="form-control" placeholder="Search..." onkeyup="Search()" value="{{ request()->has('search') ? request()->get('search') : '' }}" onfocus="var temp=this.value; this.value=''; this.value=temp" autofocus>
                                            {!! Form::close() !!}
                                            <button class="btn btn-light ml-1"
                                                    data-toggle="collapse"
                                                    data-target="#filters"
                                                    aria-expanded="false"
                                            >
                                                Filter <i class="fas fa-sliders-h ml-1"></i>
                                            </button>
                                        </div>
                                        <div class="card {{ request()->has('filters') ? '' : 'collapse' }} navbar-collapse" id="filters">
                                            {!! Form::open(['url' => route('backend.cms.campaign.index'), 'id' => 'filter_form', 'method' => 'get']) !!}
                                            <div class="input-group text-sm">
                                                <div class="custom-control custom-checkbox d-inline">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="filters[]" value="1" onclick="Filter()" {{ in_array(1, request()->get('filters') ?? []) ? 'checked' : '' }}>
                                                    <label for="customCheckbox1" class="custom-control-label ml-2 font-weight-normal">
                                                        Running
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox d-inline">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="filters[]" value="2" onclick="Filter()" {{ in_array(2, request()->get('filters') ?? []) ? 'checked' : '' }}>
                                                    <label for="customCheckbox2" class="custom-control-label ml-2 font-weight-normal">
                                                        Overdue
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox d-inline">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox3" name="filters[]" value="3" onclick="Filter()" {{ in_array(3, request()->get('filters') ?? []) ? 'checked' : '' }}>
                                                    <label for="customCheckbox3" class="custom-control-label ml-2 font-weight-normal">
                                                        Completed
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox d-inline">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox4" name="filters[]" value="4" onclick="Filter()" {{ in_array(4, request()->get('filters') ?? []) ? 'checked' : '' }}>
                                                    <label for="customCheckbox4" class="custom-control-label ml-2 font-weight-normal">
                                                        Not Active
                                                    </label>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="table-responsive shadow w-100">
                                            <table class="table mb-0 text-center">
                                                <tbody>
                                                <tr>
                                                    <td class="border-top-0 p-0 pl-1">
                                                        Statistics
                                                    </td>
                                                    <td class="border-top-0 p-0">
                                                        <small class="font-weight-bold">
                                                            Running
                                                        </small>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            {{ $dashboard->statistics->running_campaigns }}
                                                        </small>
                                                    </td>
                                                    <td class="border-top-0 p-0">
                                                        <small class="font-weight-bold">
                                                            Overdue
                                                        </small>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            {{ $dashboard->statistics->overdue_campaigns }}
                                                        </small>
                                                    </td>
                                                    <td class="border-top-0 p-0">
                                                        <small class="font-weight-bold">
                                                            Completed
                                                        </small>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            {{ $dashboard->statistics->completed_campaigns }}
                                                        </small>
                                                    </td>
                                                    <td class="border-top-0 p-0">
                                                        <small class="font-weight-bold">
                                                            Not Active
                                                        </small>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            {{ $dashboard->statistics->not_active_campaigns }}
                                                        </small>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(count($campaigns))
                                    <div class="row">
                                        @foreach($campaigns as $index => $campaign)
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-gradient-light">
                                                    <div class="inner text-justify {{ $campaign->is_active ? '' : 'bg-disabled' }}">
                                                        <h5 class="font-weight-bold text-center">{{ $campaign->title }}</h5>
                                                        <div class="row" style="font-size: 12px">
                                                            <div class="col-6">
                                                                <span>Start Date:</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span>{{ $campaign->is_active ? $campaign->start_date : '' }}</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span>Next Deadline:</span>
                                                            </div>
                                                            <div class="col-6">
                                                                @if($campaign->is_active)
                                                                    @php
                                                                        $start_date = \Carbon\Carbon::parse($campaign->start_date);
                                                                        if ($campaign->cycle_time_unit == 1)
                                                                            $next_deadline = $start_date->addMonths(1 + $start_date->diffInMonths(\Carbon\Carbon::now()));
                                                                        else if ($campaign->cycle_time_unit == 2)
                                                                            $next_deadline = $start_date->addWeeks(1 + $start_date->diffInWeeks(\Carbon\Carbon::now()));
                                                                    @endphp
                                                                    <span>{{ $next_deadline->format('d.m.Y') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="col-6 mt-1">
                                                                <i class="fa fa-user"></i>
                                                                <span class="ml-1">{{ \App\Helpers\NumberManager::shortFormat($campaign->campaign_influencers_count) }}/{{ \App\Helpers\NumberManager::shortFormat($campaign->amount_of_influencer_per_cycle) }}</span>
                                                                @if($campaign->is_active)
                                                                    @if($campaign->campaign_influencers_count >= $campaign->amount_of_influencer_per_cycle)
                                                                        <i class="fas fa-check text-primary"></i>
                                                                    @else
                                                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-6 mt-1">
                                                                <i class="fa fa-camera"></i>
                                                                <span class="ml-1">{{ \App\Helpers\NumberManager::shortFormat($campaign->uploaded_content_count) }}/{{ \App\Helpers\NumberManager::shortFormat($campaign->amount_of_influencer_per_cycle) }}</span>
                                                                @if($campaign->is_active)
                                                                    @if($campaign->uploaded_content_count >= $campaign->amount_of_influencer_per_cycle)
                                                                        <i class="fas fa-check text-primary"></i>
                                                                    @else
                                                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-12 mt-1">
                                                                <i class="fa fa-user"></i>
                                                                <span class="ml-1">{{ \App\Helpers\NumberManager::shortFormat($campaign->follower_count) }}/{{ \App\Helpers\NumberManager::shortFormat($campaign->amount_of_influencer_follower_per_cycle) }} Follower</span>
                                                                @if($campaign->is_active)
                                                                    @if($campaign->follower_count >= $campaign->amount_of_influencer_follower_per_cycle)
                                                                        <i class="fas fa-check text-primary"></i>
                                                                    @else
                                                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <ul class="box-footer {{ $campaign->is_active ? '' : 'bg-disabled' }}">
                                                        @if($campaign->is_active)
                                                            <li>
                                                                <a href="{{ route('backend.cms.campaign.show', [$campaign->id]) }}">
                                                                    <i class="fas fa-eye"></i> View
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('backend.cms.campaign.edit', [$campaign->id]) }}">
                                                                    <i class="fa fa-pen"></i> Edit
                                                                </a>
                                                            </li>
                                                        @else
                                                            &nbsp;
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center">
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
    </div>
@stop

@section('style')
    <style>
        form {
            display: unset;
        }

        ul.box-footer {
            list-style: none;
            display: flex;
            background-color: rgba(0, 0, 0, .1);
            color: rgba(255, 255, 255, .8);
            /padding: 3px 0;
            padding: 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
        }

        ul.box-footer li {
            width: 50%;
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

@section('script')
    <script>
        function Filter() {
            document.getElementById('filter_form').submit();
        }

        var timeout = null;

        function Search() {
            if (timeout) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(function() {
                document.getElementById('search_form').submit();
            }, 1000);
        }
    </script>
@stop
