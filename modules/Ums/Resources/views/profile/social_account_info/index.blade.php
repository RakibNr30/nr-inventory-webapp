@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('admin.partials._profile_menu', ['active' => 0])
                </div>
                <div class="col-md-9">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Update your social account information</h3>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.profile-social-account-info.update', [$userSocialAccountInfo->id]), 'method' => 'put']) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="instagram_username" class="@error('instagram_username') text-danger @enderror">
                                           Instagram Username
                                        </label>
                                        <input id="instagram_username" name="instagram_username"
                                               value="{{ old('instagram_username') ?: $userSocialAccountInfo->instagram_username }}"
                                               type="text"
                                               class="form-control @error('instagram_username') is-invalid @enderror"
                                               placeholder="Enter instagram username" autofocus>
                                        @error('instagram_username')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="instagram_followers" class="@error('instagram_followers') text-danger @enderror">
                                           Instagram Followers
                                        </label>
                                        <input id="instagram_followers" name="instagram_followers"
                                               value="{{ old('instagram_followers') ?: $userSocialAccountInfo->instagram_followers }}"
                                               type="text"
                                               class="form-control @error('instagram_followers') is-invalid @enderror"
                                               placeholder="Enter instagram followers" autofocus>
                                        @error('instagram_followers')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tiktok_username" class="@error('tiktok_username') text-danger @enderror">
                                            Tiktok Username
                                        </label>
                                        <input id="tiktok_username" name="tiktok_username"
                                               value="{{ old('tiktok_username') ?: $userSocialAccountInfo->tiktok_username }}"
                                               type="text" class="form-control @error('tiktok_username') is-invalid @enderror"
                                               placeholder="Enter tiktok username" autofocus>
                                        @error('tiktok_username')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tiktok_followers" class="@error('tiktok_followers') text-danger @enderror">
                                            Tiktok Followers
                                        </label>
                                        <input id="tiktok_followers" name="tiktok_followers"
                                               value="{{ old('tiktok_followers') ?: $userSocialAccountInfo->tiktok_followers }}"
                                               type="text" class="form-control @error('tiktok_followers') is-invalid @enderror"
                                               placeholder="Enter tiktok followers" autofocus>
                                        @error('tiktok_followers')
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
