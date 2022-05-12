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
                            <h3 class="card-title">Influencer List</h3>
                            @if(\App\Helpers\AuthManager::isAdmin() ||
                                \App\Helpers\AuthManager::isSuperAdmin() ||
                                \App\Helpers\AuthManager::isInfluencerManager())
                                <a href="{{ route('backend.ums.influencer.create') }}" type="button" class="btn btn-success btn-sm text-white float-right">
                                    Add new influencer
                                </a>
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="row">
<!--                                <div class="col-md-5">
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
                        <div class="card-body table-responsive p-0 influencer-list">
                            @if(count($influencers))
                                <table class="table table-striped projects">
                                    <tbody>
                                    @foreach($influencers as $index => $influencer)
                                        <tr>
                                            <td>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <img alt="Avatar" class="table-avatar" src="{{ $influencer->user->avatar->file_url ?? config('core.image.default.avatar_male') }}">
                                                    </li>
                                                </ul>
                                            </td>
                                            {!! Form::open(['url' => route('backend.cms.campaign-influencer.update', [$influencer->id]), 'method' => 'put']) !!}
                                            <td>
                                                <a class="font-weight-bold">
                                                    {{ $influencer->user->additionalInfo->first_name ?? '' }}
                                                    {{ $influencer->user->additionalInfo->last_name ?? '' }}
                                                </a>
                                                <br>
                                                @if(count($influencer->content_types))
                                                    <small class="text-primary font-weight-bold">
                                                        @foreach($influencer->content_types as $index => $content_type)
                                                            {{ $content_type }}
                                                            @if($index + 1 < count($influencer->content_types))
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </small>
                                                    <br>
                                                @endif
                                                <div class="mt-1">
                                                    <!--<a class="btn btn-info btn-xs" href="#">
                                                        <i class="fas fa-clone">
                                                        </i>
                                                    </a>-->
                                                    @if(\App\Helpers\AuthManager::isBrand())
                                                        @if($influencer->accept_status == 0)
                                                            <button name="accept_status" value="1" class="btn btn-primary btn-xs">
                                                                <i class="fas fa-check">
                                                                </i>
                                                                Accept
                                                            </button>
                                                            <button name="accept_status" value="-1" class="btn btn-danger btn-xs" href="#">
                                                                <i class="fas fa-minus-circle">
                                                                </i>
                                                                Deny
                                                            </button>
                                                        @endif
                                                        @if($influencer->accept_status == 1)
                                                            <span class="text-success">
                                                            <i class="fas fa-check">
                                                            </i>
                                                            <strong>Accepted</strong>
                                                        </span>
                                                        @endif
                                                        @if($influencer->accept_status == -1)
                                                            <span class="text-danger">
                                                            <i class="fas fa-minus-circle">
                                                            </i>
                                                            <strong>Denied</strong>
                                                        </span>
                                                        @endif
                                                    @endif

                                                    @if(!\App\Helpers\AuthManager::isBrand() && !\App\Helpers\AuthManager::isInfluencer())
                                                        @if($influencer->accept_status == 1)
                                                            <button name="internal_accept_status" value="1" class="btn btn-primary btn-xs">
                                                                Modify
                                                            </button>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <a class="font-weight-bold">
                                                    Username
                                                </a>
                                                <br>
                                                <div class="mt-1">
                                                    <i class="fab fa-instagram mr-1">
                                                    </i>
                                                    <a class="" href="javascript:void(0)">
                                                        {{ $influencer->user->socialAccountInfo->instagram_username ?? '' }}
                                                    </a>
                                                </div>
                                                <div class="mt-1">
                                                    <i class="fab fa-tiktok mr-1">
                                                    </i>
                                                    <a class="" href="javascript:void(0)">
                                                        {{ $influencer->user->socialAccountInfo->tiktok_username ?? '' }}
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
                                                        {{ \App\Helpers\NumberManager::shortFormat($influencer->user->socialAccountInfo->instagram_followers ?? 0) }}
                                                    </a>
                                                </div>
                                                <div class="mt-1">
                                                    <a>
                                                        {{ \App\Helpers\NumberManager::shortFormat($influencer->user->socialAccountInfo->tiktok_followers ?? 0) }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="brand-input">
                                               <div class="row">
                                                   @if(\App\Helpers\AuthManager::isBrand())
                                                       @if($influencer->campaign->individual_coupon_code_brand)
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label class="brand-input-label">Individual Coupon Code</label>
                                                                   <input id="individual_coupon_code" name="individual_coupon_code" value="{{ old('individual_coupon_code') ?? $influencer->individual_coupon_code ?? '' }}"
                                                                          type="text"
                                                                          class="form-control @error('individual_coupon_code') is-invalid @enderror"
                                                                          placeholder="Individual Coupon Code" autofocus
                                                                          {{ $influencer->accept_status != 0 ? 'readonly' : '' }}
                                                                   >
                                                               </div>
                                                           </div>
                                                       @endif
                                                       @if($influencer->campaign->individual_swipe_up_link_brand)
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label class="brand-input-label">Individual Swipe-up Link</label>
                                                                   <input id="individual_swipe_up_link" name="individual_swipe_up_link" value="{{ old('individual_swipe_up_link') ?? $influencer->individual_swipe_up_link ?? '' }}"
                                                                          type="text"
                                                                          class="form-control @error('individual_swipe_up_link') is-invalid @enderror"
                                                                          placeholder="Individual Swipe-up Link Code" autofocus
                                                                       {{ $influencer->accept_status != 0 ? 'readonly' : '' }}
                                                                   >
                                                               </div>
                                                           </div>
                                                       @endif
                                                       @if($influencer->campaign->influencer_shipping_address_brand)
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label class="brand-input-label">Shipping Address</label>
                                                                   <input id="shipping_address" name="shipping_address" value="{{ old('shipping_address') ?? $influencer->shipping_address ?? '' }}"
                                                                          type="text"
                                                                          class="form-control @error('shipping_address') is-invalid @enderror"
                                                                          placeholder="Shipping Address" autofocus
                                                                       {{ $influencer->accept_status != 0 ? 'readonly' : '' }}
                                                                   >
                                                               </div>
                                                           </div>
                                                       @endif
                                                   @endif

                                                   @if(!\App\Helpers\AuthManager::isBrand() && !\App\Helpers\AuthManager::isInfluencer())
                                                       @if($influencer->campaign->individual_coupon_code_internal)
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label class="brand-input-label">Individual Coupon Code</label>
                                                                   <input id="internal_individual_coupon_code" name="internal_individual_coupon_code" value="{{ old('internal_individual_coupon_code') ?? ($influencer->internal_individual_coupon_code ?? $influencer->individual_coupon_code) }}"
                                                                          type="text"
                                                                          class="form-control @error('internal_individual_coupon_code') is-invalid @enderror"
                                                                          placeholder="Individual Coupon Code" autofocus
                                                                       {{ $influencer->accept_status != 0 ? '' : '' }}
                                                                   >
                                                               </div>
                                                           </div>
                                                       @endif
                                                       @if($influencer->campaign->individual_swipe_up_link_internal)
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label class="brand-input-label">Individual Swipe-up Link</label>
                                                                   <input id="internal_individual_swipe_up_link" name="internal_individual_swipe_up_link" value="{{ old('internal_individual_swipe_up_link') ?? ($influencer->internal_individual_swipe_up_link ?? $influencer->individual_swipe_up_link) }}"
                                                                          type="text"
                                                                          class="form-control @error('internal_individual_swipe_up_link') is-invalid @enderror"
                                                                          placeholder="Individual Swipe-Up Link Code" autofocus
                                                                       {{ $influencer->accept_status != 0 ? '' : '' }}
                                                                   >
                                                               </div>
                                                           </div>
                                                       @endif
                                                   @endif
                                               </div>
                                            </td>
                                            {!! Form::close() !!}

                                            <td>
                                                <div class="text-center" style="width: 200px;">
                                                    @if(!$influencer->is_add_to_favourite)
                                                        {!! Form::open(['url' => route('backend.cms.campaign-influencer.update', [$influencer->id]), 'method' => 'put']) !!}
                                                        <input type="hidden" name="is_add_to_favourite" value="1">
                                                        <button class="btn btn-secondary btn-sm">
                                                            Add to favourites
                                                        </button>
                                                        {!! Form::close() !!}
                                                    @endif
                                                    @if($influencer->is_add_to_favourite)
                                                        {!! Form::open(['url' => route('backend.cms.campaign-influencer.update', [$influencer->id]), 'method' => 'put']) !!}
                                                        <input type="hidden" name="is_add_to_favourite" value="0">
                                                        <button class="btn btn-success btn-sm">
                                                            Remove from favourites
                                                        </button>
                                                        {!! Form::close() !!}
                                                    @endif
                                                    <a class="btn btn-info btn-sm" href="#">
                                                        <i class="fas fa-ellipsis-v">
                                                        </i>
                                                    </a>
                                                </div>
                                            </td>
{{--                                            <td>--}}
{{--                                                <ul class="action-button">--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('backend.ums.influencer.show', [$influencer->id]) }}" class="btn btn-outline-success">--}}
{{--                                                            <i class="fa fa-eye"></i>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a href="{{ route('backend.ums.influencer.edit', [$influencer->id]) }}" class="btn btn-outline-primary">--}}
{{--                                                            <i class="fa fa-pen"></i>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                    <li>--}}
{{--                                                        <a type="button" tabindex="0" data-html="true" data-popover-content="#confirm_delete{{ $influencer->id }}" class="btn btn-outline-danger">--}}
{{--                                                            <i class="fa fa-trash"></i>--}}
{{--                                                        </a>--}}
{{--                                                        <div style="display: none;" id="confirm_delete{{ $influencer->id }}">--}}
{{--                                                            <div class="popover-body">--}}
{{--                                                                <a type="button" class="btn btn-danger text-white delete_submit {{ $influencer->id }}">Delete</a>--}}
{{--                                                                <a role="button" class="btn btn-dark text-white">Cancel</a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        {!! Form::open(['url' => route('backend.ums.influencer.destroy', [$influencer->id]), 'method' => 'delete', 'id' => 'delete_form' . $influencer->id]) !!}{!! Form::close() !!}--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center mb-3">
                                    <i class="fa fa-user"></i>
                                    <span class="d-block">No Influencer Here</span>
                                </div>
                            @endif
                        </div>
                    </div>
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
        ul.action-button {
            list-style: none;
        }
        ul.action-button li {
           margin-top: 8px;
        }
        .influencer-list {
            max-height: 500px;
            overflow-y: scroll;
        }
        .influencer-list::-webkit-scrollbar {
            display: none;
        }

        td.brand-input {
            min-width: 300px;
        }
        td.brand-input .form-control {
            height: calc(2rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 0.7rem;
        }

        td.brand-input .brand-input-label {
            font-size: 0.7rem;
        }
        td.brand-input .form-group {
            margin-bottom: 0.3rem;
        }
        th, td {
            white-space:nowrap;
            text-align: left
        }
    </style>
@stop
