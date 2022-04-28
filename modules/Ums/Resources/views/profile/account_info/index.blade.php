@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('admin.partials._profile_menu', ['active' => 4])
                </div>
                <div class="col-md-9">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Update Your Account Info</h3>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.profile-account-info.update', [$user->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="avatar" class="@error('avatar') text-danger @enderror">Avatar</label>
                                        <input id="avatar" name="avatar" value="{{ old('avatar') }}" type="file" class="form-control @error('avatar') is-invalid @enderror" placeholder="Select File" autofocus>
                                        <div class="image-output">
                                            <img src="{{ $user->avatar->file_url ??
                                                        ($user->additionalInfo->gender == 2 ?
                                                        config('core.image.default.avatar_female') :
                                                        config('core.image.default.avatar_male')) }}">
                                        </div>
                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="@error('email') text-danger @enderror">Email</label>
                                        <input id="email" name="email"
                                               value="{{ old('email') ?: $user->email }}"
                                               type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Enter your email" autofocus readonly>
                                        @error('email')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone" class="@error('phone') text-danger @enderror">Phone</label>
                                        <input id="phone" name="phone"
                                               value="{{ old('phone') ?? $user->phone }}"
                                               type="text"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               placeholder="Enter phone number" autofocus>
                                        @error('phone')
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
