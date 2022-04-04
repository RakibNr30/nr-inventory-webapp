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
                            <h3 class="card-title mt-1">Testimonial Details</h3>
                            <a href="{{ route('backend.cms.testimonial.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Testimonial List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="@error('name') text-danger @enderror">Name</label>
                                        <input id="name" name="name" value="{{ $testimonial->name ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="designation" class="@error('designation') text-danger @enderror">Designation</label>
                                        <input id="designation" name="designation" value="{{ $testimonial->designation ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('designation')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="avatar" class="@error('avatar') text-danger @enderror">Avatar</label>
                                        <input id="avatar" name="avatar" value="{{ $testimonial->avatar->file_name ?? 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @if(isset($testimonial->avatar))
                                            <div class="image-output">
                                                <img src="{{ $testimonial->avatar->file_url }}">
                                            </div>
                                        @endif
                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message" class="@error('message') text-danger @enderror">Message</label>
                                        <input id="message" name="message" value="{{ $testimonial->message ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('message')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.cms.testimonial.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
