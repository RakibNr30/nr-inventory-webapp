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
                            <h3 class="card-title mt-1">Brand Details</h3>
                            <a href="{{ route('backend.cms.brand.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Brand List</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <div class="profile-user-img img-fluid img-circle"
                                     style="background-image: url({{ $brand->avatar->file_url ?? config('core.image.default.logo_preview') }})">
                                </div>
                            </div>
                            <h3 class="profile-username text-center">{{ $brand->additionalInfo->first_name ?? '' }}</h3>
                        </div>
                    </div>

                    {{--<div class="card card-primary">
                        <div class="card-body">
                            <strong>
                                Campaign
                            </strong>
                            <p class="text-muted mb-0">
                                {{ $brand->campaign_id ?? '' }}
                            </p>
                            --}}{{--<hr>--}}{{--
                        </div>
                    </div>--}}
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Details
                        </div>
                        <div class="card-body">
                            <div class="text-justify">
                                {!! $brand->additionalInfo->about ?: 'Details not available' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
