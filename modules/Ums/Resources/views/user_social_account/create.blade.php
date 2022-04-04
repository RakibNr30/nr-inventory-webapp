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
                            <h3 class="card-title mt-1">Create User Social Account</h3>
                            <a href="{{ route('backend.ums.user-social-account.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View UserSocialAccount List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.user-social-account.store'), 'method' => 'user-social-account', 'files' => true]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="username" class="@error('username') text-danger @enderror">Social Site Username</label>
                                            <input id="username" name="username" value="{{ old('username') }}" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Enter social site username" autofocus>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="social_site_id" class="@error('social_site_id') text-danger @enderror">Social Site Id</label>
                                            <input id="social_site_id" name="social_site_id" value="{{ old('social_site_id') }}" type="text" class="form-control @error('social_site_id') is-invalid @enderror" placeholder="Enter social site id" autofocus>
                                            @error('social_site_id')
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
                                <a href="{{ route('backend.ums.user-social-account.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
