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

                            @if(count($campaigns))
                                <div class="table-responsive w-100 p-2">
                                    <table class="table table-striped projects mb-0">
                                        <tbody>
                                        @foreach($campaigns as $index => $campaign)
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
