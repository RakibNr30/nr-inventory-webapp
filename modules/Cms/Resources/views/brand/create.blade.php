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
                            <h3 class="card-title mt-1">Create Brand</h3>
                            <a href="{{ route('backend.cms.brand.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Brand List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.cms.brand.store'), 'method' => 'brand', 'files' => true]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Basic Information</h5>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title" class="@error('title') text-danger @enderror">Title</label>
                                            <input id="title" name="title" value="{{ old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title" autofocus>
                                            @error('title')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="logo" class="@error('logo') text-danger @enderror">Upload Logo</label>
                                            <div class="custom-file">
                                                <input type="file" name="logo" value="{{ old('logo') }}" class="custom-file-input @error('logo') is-invalid @enderror" id="customFile">
                                                <label class="custom-file-label font-weight-normal" for="customFile">Choose file</label>
                                            </div>
                                            @error('logo')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="details" class="@error('details') text-danger @enderror">Description</label>
                                            <textarea id="description" name="details" class="form-control" rows="3" placeholder="Enter details">{{ old('details') }}</textarea>
                                            @error('details')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                        <h5>Login Information</h5>
                                        <hr>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name" class="@error('first_name') text-danger @enderror">First Name</label>
                                            <input id="first_name" name="first_name" value="{{ old('first_name') }}"
                                                   type="text"
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   placeholder="Enter first name" autofocus>
                                            @error('first_name')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name" class="@error('last_name') text-danger @enderror">Last Name</label>
                                            <input id="last_name" name="last_name" value="{{ old('last_name') }}"
                                                   type="text" class="form-control @error('last_name') is-invalid @enderror"
                                                   placeholder="Enter last name" autofocus>
                                            @error('last_name')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="@error('email') text-danger @enderror">Email</label>
                                            <input id="email" name="email" value="{{ old('email') }}" type="text"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="Enter email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone" class="@error('phone') text-danger @enderror">Phone</label>
                                            <input id="phone" name="phone" value="{{ old('phone') }}" type="text"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   placeholder="Enter phone" autofocus>
                                            @error('phone')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password"
                                                   class="@error('password') text-danger @enderror">Password</label>
                                            <input id="password" name="password" value="{{ old('password') }}"
                                                   type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   placeholder="Enter password" autofocus>
                                            @error('password')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirmation"
                                                   class="@error('password_confirmation') text-danger @enderror">Confirm Password</label>
                                            <input id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"
                                                   type="password"
                                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                                   placeholder="Re-enter password" autofocus>
                                            @error('password_confirmation')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                                <a href="{{ route('backend.cms.brand.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
