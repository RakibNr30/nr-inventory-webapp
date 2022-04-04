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
                            <h3 class="card-title mt-1">Slider Details</h3>
                            <a href="{{ route('backend.cms.slider.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Slider List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="@error('title') text-danger @enderror">Title</label>
                                        <input id="title" name="title" value="{{ $slider->title ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                        <input id="description" name="description" value="{{ $slider->description ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image" class="@error('image') text-danger @enderror">Image</label>
                                        <input id="image" name="image" value="{{ $slider->image->file_name ?? 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @if(isset($slider->image))
                                            <div class="image-output">
                                                <img src="{{ $slider->image->file_url }}">
                                            </div>
                                        @endif
                                        @error('image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="link" class="@error('link') text-danger @enderror">Link</label>
                                        <input id="link" name="link" value="{{ $slider->link ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('link')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.cms.slider.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
