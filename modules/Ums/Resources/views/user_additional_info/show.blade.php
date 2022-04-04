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
                            <h3 class="card-title mt-1">User Additional Info Details</h3>
                            <a href="{{ route('backend.ums.user-additional-info.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View User Additional Info List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="first_name" class="@error('first_name') text-danger @enderror">First Name</label>
                                        <input id="first_name" name="first_name" value="{{ $userAdditionalInfo->first_name ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="last_name" class="@error('last_name') text-danger @enderror">Last Name</label>
                                        <input id="last_name" name="last_name" value="{{ $userAdditionalInfo->last_name ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="designation" class="@error('designation') text-danger @enderror">Designation</label>
                                        <input id="designation" name="designation" value="{{ $userAdditionalInfo->designation ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('designation')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about" class="@error('about') text-danger @enderror">About</label>
                                        <input id="about" name="about" value="{{ $userAdditionalInfo->about ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('about')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone_no" class="@error('phone_no') text-danger @enderror">Phone No</label>
                                        <input id="phone_no" name="phone_no" value="{{ $userAdditionalInfo->phone_no ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('phone_no')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mobile_no" class="@error('mobile_no') text-danger @enderror">Mobile No</label>
                                        <input id="mobile_no" name="mobile_no" value="{{ $userAdditionalInfo->mobile_no ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fax_no" class="@error('fax_no') text-danger @enderror">Fax No</label>
                                        <input id="fax_no" name="fax_no" value="{{ $userAdditionalInfo->fax_no ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('fax_no')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="personal_email" class="@error('personal_email') text-danger @enderror">Personal Email</label>
                                        <input id="personal_email" name="personal_email" value="{{ $userAdditionalInfo->personal_email ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('personal_email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="professional_email" class="@error('professional_email') text-danger @enderror">Professional Email</label>
                                        <input id="professional_email" name="professional_email" value="{{ $userAdditionalInfo->professional_email ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('professional_email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="website_url" class="@error('website_url') text-danger @enderror">Website</label>
                                        <input id="website_url" name="website_url" value="{{ $userAdditionalInfo->website_url ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('website_url')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="dob" class="@error('dob') text-danger @enderror">Date of Birth</label>
                                        <input id="dob" name="dob" value="{{ $userAdditionalInfo->dob ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('dob')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="blood_group" class="@error('blood_group') text-danger @enderror">Blood Group</label>
                                        <input id="blood_group" name="blood_group" value="{{ $userAdditionalInfo->blood_group ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('blood_group')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="gender" class="@error('gender') text-danger @enderror">Gender</label>
                                        <input id="gender" name="gender" value="{{ $userAdditionalInfo->gender ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="user_id" class="@error('user_id') text-danger @enderror">User Id</label>
                                        <input id="user_id" name="user_id" value="{{ $userAdditionalInfo->user_id ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('user_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.ums.user-additional-info.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
