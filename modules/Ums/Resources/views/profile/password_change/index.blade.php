@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('admin.partials._profile_menu', ['active' => 5])
                </div>
                <div class="col-md-9">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Change your password</h3>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.profile-password-change.update', [$user->id]), 'method' => 'put']) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="old_password" class="@error('old_password') text-danger @enderror">Old Password</label>
                                        <input id="old_password" name="old_password"
                                               type="Password"
                                               class="form-control @error('old_password') is-invalid @enderror"
                                               placeholder="Enter old password" autofocus>
                                        @error('old_password')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password" class="@error('password') text-danger @enderror">Password</label>
                                        <input id="password" name="password"
                                               type="Password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Enter password" autofocus>
                                        @error('password')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="repeat_password" class="@error('repeat_password') text-danger @enderror">Re-type Password</label>
                                        <input id="repeat_password" name="repeat_password"
                                               type="Password" class="form-control @error('repeat_password') is-invalid @enderror"
                                               placeholder="Re-type password" autofocus>
                                        @error('repeat_password')
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
