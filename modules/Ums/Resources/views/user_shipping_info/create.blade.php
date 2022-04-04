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
                            <h3 class="card-title mt-1">Create User Shipping Info</h3>
                            <a href="{{ route('backend.ums.user-shipping-info.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View User Shipping Info List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.user-shipping-info.store'), 'method' => 'user-shipping-info', 'files' => true]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="present_country" class="@error('present_country') text-danger @enderror">Present Country</label>
                                            <input id="present_country" name="present_country" value="{{ old('present_country') }}" type="text" class="form-control @error('present_country') is-invalid @enderror" placeholder="Enter present country" autofocus>
                                            @error('present_country')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="present_city" class="@error('present_city') text-danger @enderror">Present City</label>
                                            <input id="present_city" name="present_city" value="{{ old('present_city') }}" type="text" class="form-control @error('present_city') is-invalid @enderror" placeholder="Enter present city" autofocus>
                                            @error('present_city')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="present_state" class="@error('present_state') text-danger @enderror">Present State</label>
                                            <input id="present_state" name="present_state" value="{{ old('present_state') }}" type="text" class="form-control @error('present_state') is-invalid @enderror" placeholder="Enter present state" autofocus>
                                            @error('present_state')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="present_address_line_1" class="@error('present_address_line_1') text-danger @enderror">Present Address Line - 1</label>
                                            <input id="present_address_line_1" name="present_address_line_1" value="{{ old('present_address_line_1') }}" type="text" class="form-control @error('present_address_line_1') is-invalid @enderror" placeholder="Enter present address line - 1" autofocus>
                                            @error('present_address_line_1')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="present_address_line_2" class="@error('present_address_line_2') text-danger @enderror">Present Address Line - 2</label>
                                            <input id="present_address_line_2" name="present_address_line_2" value="{{ old('present_address_line_2') }}" type="text" class="form-control @error('present_address_line_2') is-invalid @enderror" placeholder="Enter present address line - 2" autofocus>
                                            @error('present_address_line_2')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="permanent_country" class="@error('permanent_country') text-danger @enderror">Permanent Country</label>
                                            <input id="permanent_country" name="permanent_country" value="{{ old('permanent_country') }}" type="text" class="form-control @error('permanent_country') is-invalid @enderror" placeholder="Enter permanent country" autofocus>
                                            @error('permanent_country')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="permanent_city" class="@error('permanent_city') text-danger @enderror">Permanent City</label>
                                            <input id="permanent_city" name="permanent_city" value="{{ old('permanent_city') }}" type="text" class="form-control @error('permanent_city') is-invalid @enderror" placeholder="Enter permanent_city" autofocus>
                                            @error('permanent_city')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="permanent_state" class="@error('permanent_state') text-danger @enderror">Permanent State</label>
                                            <input id="permanent_state" name="permanent_state" value="{{ old('permanent_state') }}" type="text" class="form-control @error('permanent_state') is-invalid @enderror" placeholder="Enter permanent_state" autofocus>
                                            @error('permanent_state')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="permanent_address_line_1" class="@error('permanent_address_line_1') text-danger @enderror">Permanent Address Line - 1</label>
                                            <input id="permanent_address_line_1" name="permanent_address_line_1" value="{{ old('permanent_address_line_1') }}" type="text" class="form-control @error('permanent_address_line_1') is-invalid @enderror" placeholder="Enter permanent address line - 1" autofocus>
                                            @error('permanent_address_line_1')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="permanent_address_line_2" class="@error('permanent_address_line_2') text-danger @enderror">Permanent Address Line - 2</label>
                                            <input id="permanent_address_line_2" name="permanent_address_line_2" value="{{ old('permanent_address_line_2') }}" type="text" class="form-control @error('permanent_address_line_2') is-invalid @enderror" placeholder="Enter permanent address line - 2" autofocus>
                                            @error('permanent_address_line_2')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="google_map_url"
                                                   class="@error('google_map_url') text-danger @enderror">Google Map Url</label>
                                            <input id="google_map_url" name="google_map_url"
                                                   value="{{ old('google_map_url') }}"
                                                   type="text"
                                                   class="form-control @error('google_map_url') is-invalid @enderror"
                                                   placeholder="Enter google map url" autofocus>
                                            @error('google_map_url')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="longitude"
                                                   class="@error('longitude') text-danger @enderror">Longitude</label>
                                            <input id="longitude" name="longitude"
                                                   value="{{ old('longitude') }}"
                                                   type="text"
                                                   class="form-control @error('longitude') is-invalid @enderror"
                                                   placeholder="Enter longitude" autofocus>
                                            @error('longitude')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="longitude"
                                                   class="@error('latitude') text-danger @enderror">Latitude</label>
                                            <input id="latitude" name="latitude"
                                                   value="{{ old('latitude') }}"
                                                   type="text"
                                                   class="form-control @error('latitude') is-invalid @enderror"
                                                   placeholder="Enter latitude" autofocus>
                                            @error('longitude')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="user_id" class="@error('user_id') text-danger @enderror">Username</label>
                                            <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                                <option value="">Select Username</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                                <a href="{{ route('backend.ums.user-shipping-info.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
