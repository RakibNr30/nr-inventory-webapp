@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('admin.partials._profile_menu', ['active' => 2])
                </div>
                <div class="col-md-9">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Update your shipping information</h3>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.profile-shipping-info.update', [$userShippingInfo->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone"
                                               class="@error('phone') text-danger @enderror">
                                            Phone Number
                                        </label>
                                        <input id="phone" name="phone"
                                               value="{{ old('phone') ?: $userShippingInfo->phone }}"
                                               type="text"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               placeholder="Enter email" autofocus>
                                        @error('phone')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" class="@error('first_name') text-danger @enderror">First
                                            Name</label>
                                        <input id="first_name" name="first_name"
                                               value="{{ old('first_name') ?: $userShippingInfo->first_name }}"
                                               type="text"
                                               class="form-control @error('first_name') is-invalid @enderror"
                                               placeholder="Enter first name" autofocus>
                                        @error('first_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name" class="@error('last_name') text-danger @enderror">Last
                                            Name</label>
                                        <input id="last_name" name="last_name"
                                               value="{{ old('last_name') ?: $userShippingInfo->last_name }}"
                                               type="text" class="form-control @error('last_name') is-invalid @enderror"
                                               placeholder="Enter last name" autofocus>
                                        @error('last_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address"
                                               class="@error('address') text-danger @enderror">
                                            Address
                                        </label>
                                        <input id="address" name="address"
                                               value="{{ old('address') ?: $userShippingInfo->address }}"
                                               type="text"
                                               class="form-control @error('address') is-invalid @enderror"
                                               placeholder="Enter address" autofocus>
                                        @error('address')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="extra_info"
                                               class="@error('extra_info') text-danger @enderror">
                                            Extra Info
                                        </label>
                                        <input id="extra_info" name="extra_info"
                                               value="{{ old('extra_info') ?: $userShippingInfo->extra_info }}"
                                               type="text"
                                               class="form-control @error('extra_info') is-invalid @enderror"
                                               placeholder="Enter extra info" autofocus>
                                        @error('extra_info')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="zip_code"
                                               class="@error('zip_code') text-danger @enderror">
                                            Zip Code
                                        </label>
                                        <input id="zip_code" name="zip_code"
                                               value="{{ old('zip_code') ?: $userShippingInfo->zip_code }}"
                                               type="text"
                                               class="form-control @error('zip_code') is-invalid @enderror"
                                               placeholder="Enter zip code" autofocus>
                                        @error('zip_code')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city" class="@error('city') text-danger @enderror">
                                            City
                                        </label>
                                        <input id="city" name="city"
                                               value="{{ old('city') ?: $userShippingInfo->city }}"
                                               type="text"
                                               class="form-control @error('city') is-invalid @enderror"
                                               placeholder="Enter city" autofocus>
                                        @error('city')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country_code"
                                               class="@error('country_code') text-danger @enderror">
                                            Country Code
                                        </label>
                                        <input id="country_code" name="country_code"
                                               value="{{ old('country_code') ?: $userShippingInfo->country_code }}"
                                               type="text"
                                               class="form-control @error('country_code') is-invalid @enderror"
                                               placeholder="Enter country code" autofocus>
                                        @error('country_code')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
