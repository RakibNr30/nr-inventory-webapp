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
                            <h3 class="card-title mt-1">Create Testimonial</h3>
                            <a href="{{ route('backend.cms.testimonial.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Testimonial List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.cms.testimonial.store'), 'method' => 'testimonial', 'files' => true]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="@error('name') text-danger @enderror">Name</label>
                                            <input id="name" name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="designation" class="@error('designation') text-danger @enderror">Designation</label>
                                            <input id="designation" name="designation" value="{{ old('designation') }}" type="text" class="form-control @error('designation') is-invalid @enderror" placeholder="Enter designation" autofocus>
                                            @error('designation')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="avatar" class="@error('avatar') text-danger @enderror">Avatar</label>
                                            <input id="avatar" name="avatar" value="{{ old('avatar') }}" type="file" class="form-control @error('avatar') is-invalid @enderror" placeholder="Select Avatar" autofocus>
                                            @error('avatar')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="message" class="@error('message') text-danger @enderror">Message</label>
                                            <textarea id="message" name="message" class="form-control" rows="3" placeholder="Enter message">{{ old('message') }}</textarea>
                                            @error('message')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                                <a href="{{ route('backend.cms.testimonial.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
