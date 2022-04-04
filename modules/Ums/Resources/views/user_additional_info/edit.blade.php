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
                            <h3 class="card-title mt-1">Edit User Additional Info</h3>
                            <a href="{{ route('backend.ums.user-additional-info.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View User Additional Info List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.user-additional-info.update', [$userAdditionalInfo->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="first_name" class="@error('first_name') text-danger @enderror">First Name</label>
                                            <input id="first_name" name="first_name" value="{{ old('first_name') ?: $userAdditionalInfo->first_name }}" type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter first name" autofocus>
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="last_name" class="@error('last_name') text-danger @enderror">Last Name</label>
                                            <input id="last_name" name="last_name" value="{{ old('last_name') ?: $userAdditionalInfo->last_name }}" type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="Enter last name" autofocus>
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="designation" class="@error('designation') text-danger @enderror">Designation</label>
                                        <input id="designation" name="designation"
                                               value="{{ old('designation') ?: $userAdditionalInfo->designation }}"
                                               type="text" class="form-control @error('designation') is-invalid @enderror"
                                               placeholder="Enter designation" autofocus>
                                        @error('designation')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about" class="@error('about') text-danger @enderror">About</label>
                                        <textarea id="about" name="about" rows="3"
                                                  class="form-control @error('about') is-invalid @enderror"
                                                  placeholder="Enter about yourself">{{ old('about') ?: $userAdditionalInfo->about }}</textarea>
                                        @error('about')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="phone_no" class="@error('phone_no') text-danger @enderror">Phone No</label>
                                            <input id="phone_no" name="phone_no" value="{{ old('phone_no') ?: $userAdditionalInfo->phone_no }}" type="text" class="form-control @error('phone_no') is-invalid @enderror" placeholder="Enter phone no" autofocus>
                                            @error('phone_no')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="mobile_no" class="@error('mobile_no') text-danger @enderror">Mobile No</label>
                                            <input id="mobile_no" name="mobile_no" value="{{ old('mobile_no') ?: $userAdditionalInfo->mobile_no }}" type="text" class="form-control @error('mobile_no') is-invalid @enderror" placeholder="Enter mobile no" autofocus>
                                            @error('mobile_no')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fax_no" class="@error('fax_no') text-danger @enderror">Fax No</label>
                                            <input id="fax_no" name="fax_no" value="{{ old('fax_no') ?: $userAdditionalInfo->fax_no }}" type="text" class="form-control @error('fax_no') is-invalid @enderror" placeholder="Enter fax no" autofocus>
                                            @error('fax_no')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="personal_email" class="@error('personal_email') text-danger @enderror">Personal Email</label>
                                            <input id="personal_email" name="personal_email" value="{{ old('personal_email') ?: $userAdditionalInfo->personal_email }}" type="text" class="form-control @error('personal_email') is-invalid @enderror" placeholder="Enter personal email" autofocus>
                                            @error('personal_email')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="professional_email" class="@error('professional_email') text-danger @enderror">Professional Email</label>
                                            <input id="professional_email" name="professional_email" value="{{ old('professional_email') ?: $userAdditionalInfo->professional_email }}" type="text" class="form-control @error('professional_email') is-invalid @enderror" placeholder="Enter professional email" autofocus>
                                            @error('professional_email')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="website_url" class="@error('website_url') text-danger @enderror">Website Url</label>
                                        <input id="website_url" name="website_url"
                                               value="{{ old('website_url') ?: $userAdditionalInfo->website_url }}"
                                               type="text" class="form-control @error('website_url') is-invalid @enderror"
                                               placeholder="Enter website url" autofocus>
                                        @error('website_url')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="dob" class="@error('dob') text-danger @enderror">Date of Birth</label>
                                            <input id="dob" name="dob" value="{{ old('dob') ?: $userAdditionalInfo->dob }}" type="text" class="form-control datepicker @error('dob') is-invalid @enderror" placeholder="Enter dob" autofocus>
                                            @error('dob')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="blood_group" class="@error('blood_group') text-danger @enderror">Blood Group</label>
                                            <select id="blood_group" name="blood_group" class="form-control @error('blood_group') is-invalid @enderror">
                                                <option value="">Select Blood Group</option>
                                                @foreach(config('core.blood_groups') as $blood_group_key => $blood_group)
                                                    <option
                                                            value="{{ $blood_group_key }}" {{ $blood_group_key == $userAdditionalInfo->blood_group ? 'selected' : '' }}>{{ $blood_group }}</option>
                                                @endforeach
                                            </select>
                                            @error('blood_group')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="gender" class="@error('gender') text-danger @enderror">Gender</label>
                                            <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Select Gender</option>
                                                @foreach(config('core.genders') as $gender_key => $gender)
                                                    <option
                                                            value="{{ $gender_key }}" {{ $gender_key == $userAdditionalInfo->gender ? 'selected' : '' }}>{{ $gender }}</option>
                                                @endforeach
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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
                            <a href="{{ route('backend.ums.user-additional-info.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
