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
                            <h3 class="card-title mt-1">User Shipping Info Details</h3>
                            <a href="{{ route('backend.ums.user-shipping-info.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View User Shipping Info List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="present_country" class="@error('present_country') text-danger @enderror">Present Country</label>
                                        <input id="present_country" name="present_country" value="{{ $userShippingInfo->present_country ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('present_country')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="present_city" class="@error('present_city') text-danger @enderror">Present City</label>
                                        <input id="present_city" name="present_city" value="{{ $userShippingInfo->present_city ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('present_city')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="present_state" class="@error('present_state') text-danger @enderror">Present State</label>
                                        <input id="present_state" name="present_state" value="{{ $userShippingInfo->present_state ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('present_state')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="present_address_line_1" class="@error('present_address_line_1') text-danger @enderror">Present Address Line - 1</label>
                                        <input id="present_address_line_1" name="present_address_line_1" value="{{ $userShippingInfo->present_address_line_1 ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('present_address_line_1')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="present_address_line_2" class="@error('present_address_line_2') text-danger @enderror">Present Address Line - 2</label>
                                        <input id="present_address_line_2" name="present_address_line_2" value="{{ $userShippingInfo->present_address_line_2 ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('present_address_line_2')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="permanent_country" class="@error('permanent_country') text-danger @enderror">Permanent Country</label>
                                        <input id="permanent_country" name="permanent_country" value="{{ $userShippingInfo->permanent_country ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('permanent_country')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="permanent_city" class="@error('permanent_city') text-danger @enderror">Permanent City</label>
                                        <input id="permanent_city" name="permanent_city" value="{{ $userShippingInfo->permanent_city ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('permanent_city')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="permanent_state" class="@error('permanent_state') text-danger @enderror">Permanent State</label>
                                        <input id="permanent_state" name="permanent_state" value="{{ $userShippingInfo->permanent_state ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('permanent_state')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="permanent_address_line_1" class="@error('permanent_address_line_1') text-danger @enderror">Permanent Address Line - 1</label>
                                        <input id="permanent_address_line_1" name="permanent_address_line_1" value="{{ $userShippingInfo->permanent_address_line_1 ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('permanent_address_line_1')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="permanent_address_line_2" class="@error('permanent_address_line_2') text-danger @enderror">Permanent Address Line - 2</label>
                                        <input id="permanent_address_line_2" name="permanent_address_line_2" value="{{ $userShippingInfo->permanent_address_line_2 ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('permanent_address_line_2')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="google_map_url" class="@error('google_map_url') text-danger @enderror">Google Map Url</label>
                                        <input id="google_map_url" name="google_map_url" value="{{ $userShippingInfo->google_map_url ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('google_map_url')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="longitude" class="@error('longitude') text-danger @enderror">Longitude</label>
                                        <input id="longitude" name="longitude" value="{{ $userShippingInfo->longitude ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('longitude')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="latitude" class="@error('latitude') text-danger @enderror">Latitude</label>
                                        <input id="latitude" name="latitude" value="{{ $userShippingInfo->latitude ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('latitude')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="user_id" class="@error('user_id') text-danger @enderror">User Id</label>
                                        <input id="user_id" name="user_id" value="{{ $userShippingInfo->user_id ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('user_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.ums.user-shipping-info.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
