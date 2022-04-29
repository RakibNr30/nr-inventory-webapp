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
                                <a href="{{ route('backend.cms.campaign.create') }}" type="button"
                                   class="btn btn-success btn-sm text-white float-right">Add new campaign</a>
                            </div>
                            <div class="card-body">
                                @if(count($campaigns))
                                    <div class="row">
                                        @foreach($campaigns as $index => $campaign)
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-info">
                                                    <div class="inner text-justify">
                                                        <h5 class="font-weight-bold text-center">{{ $campaign->title }}</h5>
                                                        <div class="row" style="font-size: 12px">
                                                            <div class="col-6">
                                                                <span>Start Date:</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span>{{ $campaign->start_date }}</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span>Next Deadline:</span>
                                                            </div>
                                                            <div class="col-6">
                                                                @php
                                                                    $start_date = \Carbon\Carbon::parse($campaign->start_date);
                                                                    if ($campaign->cycle_time_unit == 1)
                                                                        $next_deadline = $start_date->addMonths($campaign->cycle_count);
                                                                    else if ($campaign->cycle_time_unit == 2)
                                                                        $next_deadline = $start_date->addWeeks($campaign->cycle_count);
                                                                @endphp
                                                                <span>{{ $next_deadline->format('M d, Y') }}</span>
                                                            </div>
                                                            <div class="col-6 mt-1">
                                                                <i class="fa fa-user"></i>
                                                                <span class="ml-1">{{ \App\Helpers\NumberManager::shortFormat($campaign->amount_of_influencer_per_cycle) }}</span>
                                                            </div>
                                                            <div class="col-6 mt-1">
                                                                <i class="fa fa-camera"></i>
                                                                <span class="ml-1">{{ \App\Helpers\NumberManager::shortFormat($campaign->amount_of_influencer_per_cycle) }}</span>
                                                            </div>
                                                            <div class="col-12 mt-1">
                                                                <i class="fa fa-user"></i>
                                                                <span class="ml-1">{{ \App\Helpers\NumberManager::shortFormat($campaign->amount_of_influencer_follower_per_cycle) }} Follower</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <ul class="box-footer">
                                                        <li>
                                                            <a href="{{ route('backend.cms.campaign.show', [$campaign->id]) }}"
                                                               class="small-box-footer">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('backend.cms.campaign.edit', [$campaign->id]) }}"
                                                               class="small-box-footer">
                                                                <i class="fa fa-pen"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a tabindex="0" data-html="true"
                                                               data-popover-content="#confirm_delete{{ $campaign->id }}"
                                                               class="small-box-footer">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            <div style="display: none;"
                                                                 id="confirm_delete{{ $campaign->id }}">
                                                                <div class="popover-body">
                                                                    <a type="button"
                                                                       class="btn btn-danger text-white delete_submit{{ $campaign->id }}">Delete</a>
                                                                    <a role="button" class="btn btn-dark text-white">Cancel</a>
                                                                </div>
                                                            </div>
                                                            {!! Form::open(['url' => route('backend.cms.campaign.destroy', [$campaign->id]), 'method' => 'delete', 'id' => 'delete_form' . $campaign->id]) !!}{!! Form::close() !!}
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
                                <p class="text-sm text-primary">Choose a campaign you want to take part in.</p>
                            </div>

                            @if(count($campaign_influencers))
                                <div class="table-responsive w-100 p-2">
                                    <table class="table table-striped projects mb-0">
                                        <tbody>
                                        @foreach($campaign_influencers as $index => $campaign_influencer)
                                            <tr>
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
                                                    $brands = Modules\Ums\Entities\User::query()->whereIn('id', $campaign_influencer->brand_ids)->get();
                                                @endphp

                                                @for($index = 0; $index < 5; $index++)
                                                    <td>
                                                        @if(isset($brands[$index]))
                                                            <ul class="list-inline text-center">
                                                                <li class="list-inline-item m-auto">
                                                                    <img alt="Avatar" class="table-avatar"
                                                                         src="{{ $brands[$index]->avatar->file_url ?? config('core.image.default.logo_preview') }}">
                                                                </li>
                                                                <li class="list-inline-item- mt-3 font-weight-bold">
                                                                    {{ $brands[$index]->title ?? '' }}
                                                                </li>
                                                                <li class="list-inline-item- mt-3 font-weight-bold">
                                                                    <a class="btn btn-secondary btn-sm text-white {{ ($campaign_influencer->campaign_accept_status_by_influencer == -1) || (\Carbon\Carbon::now()->gte($available_until)) ? 'disabled' : '' }}"
                                                                       data-toggle="modal" href="#modal-lg-{{ $index }}"
                                                                    >
                                                                        Read
                                                                    </a>

                                                                    <div class="modal fade" id="modal-lg-{{ $index }}" style="display: none;" aria-hidden="true">
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
                                                                                        <div class="col-md-12">
                                                                                            <span class="d-block font-weight-bold">Additional Info</span>
                                                                                            <div class="form-group">
                                                                                                <textarea rows="3" class="form-control" readonly>
                                                                                                    {{ $brands[$index]->additionalInfo->about ?? 'N/A' }}
                                                                                                </textarea>
                                                                                            </div>
                                                                                        </div>
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
                                                            <a class="btn btn-outline-primary btn-sm pt-0 pb-0"
                                                               href="{{ route('backend.cms.campaign.show', [$campaign_influencer->campaign->id]) }}">
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
                                                        @if(($campaign_influencer->campaign_accept_status_by_influencer == 0) && (\Carbon\Carbon::now()->lt($available_until)))
                                                            {!! Form::open(['url' => route('backend.cms.campaign-influencer.update', [$campaign_influencer->id]), 'method' => 'put']) !!}
                                                            <button class="btn btn-primary btn-xs"
                                                                name="campaign_accept_status_by_influencer" value="{{ 1 }}"
                                                            >
                                                                <i class="fas fa-check">
                                                                </i>
                                                                Accept
                                                            </button>
                                                            {!! Form::close() !!}

                                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-lg-1-{{ $index }}">
                                                                <i class="fas fa-minus-circle">
                                                                </i>
                                                                Deny
                                                            </button>

                                                            <div class="modal fade" id="modal-lg-1-{{ $index }}" style="display: none;" aria-hidden="true">
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
                            <div class="card-body">
                                @if(count($campaigns))
                                    <div class="row">
                                        @foreach($campaigns as $index => $campaign)
                                            <div class="col-lg-3 col-6">
                                                <div class="small-box bg-info">
                                                    <div class="inner text-justify">
                                                        <h5 class="font-weight-bold text-center">{{ $campaign->title }}</h5>
                                                        <div class="row" style="font-size: 12px">
                                                            <div class="col-6">
                                                                <span>Start Date:</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span>{{ $campaign->start_date }}</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span>Next Deadline:</span>
                                                            </div>
                                                            <div class="col-6">
                                                                @php
                                                                    $start_date = \Carbon\Carbon::parse($campaign->start_date);
                                                                    if ($campaign->cycle_time_unit == 1)
                                                                        $next_deadline = $start_date->addMonths($campaign->cycle_count);
                                                                    else if ($campaign->cycle_time_unit == 2)
                                                                        $next_deadline = $start_date->addWeeks($campaign->cycle_count);
                                                                @endphp
                                                                <span>{{ $next_deadline->format('M d, Y') }}</span>
                                                            </div>
                                                            <div class="col-6 mt-1">
                                                                <i class="fa fa-user"></i>
                                                                <span class="ml-1">{{ \App\Helpers\NumberManager::shortFormat($campaign->amount_of_influencer_per_cycle) }}</span>
                                                            </div>
                                                            <div class="col-6 mt-1">
                                                                <i class="fa fa-camera"></i>
                                                                <span class="ml-1">{{ \App\Helpers\NumberManager::shortFormat($campaign->amount_of_influencer_per_cycle) }}</span>
                                                            </div>
                                                            <div class="col-12 mt-1">
                                                                <i class="fa fa-user"></i>
                                                                <span class="ml-1">{{ \App\Helpers\NumberManager::shortFormat($campaign->amount_of_influencer_follower_per_cycle) }} Follower</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a href="{{ route('backend.cms.campaign.show', [$campaign->id]) }}"
                                                       class="small-box-footer">
                                                        <i class="fas fa-arrow-right"></i> View More
                                                    </a>

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
