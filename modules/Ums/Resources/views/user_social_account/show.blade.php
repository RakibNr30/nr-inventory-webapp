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
                            <h3 class="card-title mt-1">User Social Account Details</h3>
                            <a href="{{ route('backend.ums.user-social-account.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View User Social Account List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="username" class="@error('username') text-danger @enderror">Social Site Username</label>
                                        <input id="username" name="username" value="{{ $userSocialAccount->username ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('username')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="social_site_id" class="@error('social_site_id') text-danger @enderror">Social Site Id</label>
                                        <input id="social_site_id" name="social_site_id" value="{{ $userSocialAccount->social_site_id ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('social_site_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="user_id" class="@error('user_id') text-danger @enderror">User Id</label>
                                        <input id="user_id" name="user_id" value="{{ $userSocialAccount->user_id ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('user_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.ums.user-social-account.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
