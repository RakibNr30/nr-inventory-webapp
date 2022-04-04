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
                            <h3 class="card-title mt-1">Update Socialite Info</h3>
                        </div>
                        {!! Form::open(['url' => route('backend.setting.socialite.update', [$socialite->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="google_key" class="@error('google_key') text-danger @enderror">Google Key</label>
                                        <input id="google_key" name="google_key" value="{{ old('google_key') ?: $socialite->google_key }}" type="text" class="form-control @error('google_key') is-invalid @enderror" placeholder="Enter google key" autofocus>
                                        @error('google_key')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="google_secret" class="@error('google_secret') text-danger @enderror">Google Secret</label>
                                        <input id="google_secret" name="google_secret" value="{{ old('google_secret') ?: $socialite->google_secret }}" type="text" class="form-control @error('google_secret') is-invalid @enderror" placeholder="Enter google secret" autofocus>
                                        @error('google_secret')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="facebook_key" class="@error('facebook_key') text-danger @enderror">Facebook Key</label>
                                        <input id="facebook_key" name="facebook_key" value="{{ old('facebook_key') ?: $socialite->facebook_key }}" type="text" class="form-control @error('facebook_key') is-invalid @enderror" placeholder="Enter facebook key" autofocus>
                                        @error('facebook_key')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="facebook_secret" class="@error('facebook_secret') text-danger @enderror">Facebook Secret</label>
                                        <input id="facebook_secret" name="facebook_secret" value="{{ old('facebook_secret') ?: $socialite->facebook_secret }}" type="text" class="form-control @error('facebook_secret') is-invalid @enderror" placeholder="Enter facebook secret" autofocus>
                                        @error('facebook_secret')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="twitter_key" class="@error('twitter_key') text-danger @enderror">Twitter Key</label>
                                        <input id="twitter_key" name="twitter_key" value="{{ old('twitter_key') ?: $socialite->twitter_key }}" type="text" class="form-control @error('twitter_key') is-invalid @enderror" placeholder="Enter twitter key" autofocus>
                                        @error('twitter_key')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="twitter_secret" class="@error('twitter_secret') text-danger @enderror">Twitter Secret</label>
                                        <input id="twitter_secret" name="twitter_secret" value="{{ old('twitter_secret') ?: $socialite->twitter_secret }}" type="text" class="form-control @error('twitter_secret') is-invalid @enderror" placeholder="Enter twitter secret" autofocus>
                                        @error('twitter_secret')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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
