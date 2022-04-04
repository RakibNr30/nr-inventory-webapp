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
                            <h3 class="card-title mt-1">Update Site Info</h3>
                        </div>
                        {!! Form::open(['url' => route('backend.setting.site.update', [$site->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="@error('title') text-danger @enderror">Title</label>
                                        <input id="title" name="title" value="{{ old('title') ?: $site->title }}"
                                               type="text" class="form-control @error('title') is-invalid @enderror"
                                               placeholder="Enter title" autofocus>
                                        @error('title')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                        <textarea id="description" name="description" class="form-control" rows="3"
                                                  placeholder="Enter description">{{ old('description') ?: $site->description }}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logo" class="@error('logo') text-danger @enderror">Logo</label>
                                        <input id="logo" name="logo" value="{{ old('logo') }}" type="file"
                                               class="form-control @error('logo') is-invalid @enderror"
                                               placeholder="Select File" autofocus>
                                        {{--@if(isset($site->logo->file_name))
                                            <span class="invalid-feedback text-dark"
                                                  role="alert"><strong>Logo: {{ $site->logo->file_name }}</strong></span>
                                        @endif--}}
                                        @if(isset($site->logo))
                                            <div class="image-output">
                                                <img src="{{ $site->logo->file_url }}">
                                            </div>
                                        @endif
                                        @error('logo')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="logo_secondary" class="@error('logo_secondary') text-danger @enderror">Logo Secandary</label>
                                        <input id="logo_secondary" name="logo_secondary" value="{{ old('logo_secondary') }}" type="file"
                                               class="form-control @error('logo_secondary') is-invalid @enderror"
                                               placeholder="Select File" autofocus>
                                        {{--@if(isset($site->logo_secondary->file_name))
                                            <span class="invalid-feedback text-dark"
                                                  role="alert"><strong>Logo: {{ $site->logo_secondary->file_name }}</strong></span>
                                        @endif--}}
                                        @if(isset($site->logo_secondary))
                                            <div class="image-output">
                                                <img src="{{ $site->logo_secondary->file_url }}">
                                            </div>
                                        @endif
                                        @error('logo_secondary')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="favicon"
                                               class="@error('favicon') text-danger @enderror">Favicon</label>
                                        <input id="favicon" name="favicon" value="{{ old('favicon') }}" type="file"
                                               class="form-control @error('favicon') is-invalid @enderror"
                                               placeholder="Select File" autofocus>
                                        {{--@if(isset($site->favicon->file_name))
                                            <span class="invalid-feedback text-dark"
                                                  role="alert"><strong>Favicon: {{ $site->favicon->file_name }}</strong></span>
                                        @endif--}}
                                        @if(isset($site->favicon))
                                            <div class="image-output">
                                                <img src="{{ $site->favicon->file_url }}">
                                            </div>
                                        @endif
                                        @error('favicon')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="banner_image" class="@error('banner_image') text-danger @enderror">Banner
                                            Image</label>
                                        <input id="banner_image" name="banner_image" value="{{ old('banner_image') }}"
                                               type="file"
                                               class="form-control @error('banner_image') is-invalid @enderror"
                                               placeholder="Select File" autofocus>
                                        {{--@if(isset($site->banner_image->file_name))
                                            <span class="invalid-feedback text-dark"
                                                  role="alert"><strong>Banner Image: {{ $site->banner_image->file_name }}</strong></span>
                                        @endif--}}
                                        @if(isset($site->banner_image))
                                            <div class="image-output">
                                                <img src="{{ $site->banner_image->file_url }}">
                                            </div>
                                        @endif
                                        @error('banner_image')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="breadcrumb_image" class="@error('breadcrumb_image') text-danger @enderror">Breadcrumb Image
                                        </label>
                                        <input id="breadcrumb_image" name="breadcrumb_image" value="{{ old('breadcrumb_image') }}"
                                               type="file"
                                               class="form-control @error('breadcrumb_image') is-invalid @enderror"
                                               placeholder="Select File" autofocus>
                                        {{--@if(isset($site->breadcrumb_image->file_name))
                                            <span class="invalid-feedback text-dark"
                                                  role="alert"><strong>Breadcrumb Image: {{ $site->breadcrumb_image->file_name }}</strong></span>
                                        @endif--}}
                                        @if(isset($site->breadcrumb_image))
                                            <div class="image-output">
                                                <img src="{{ $site->breadcrumb_image->file_url }}">
                                            </div>
                                        @endif
                                        @error('breadcrumb_image')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="footer_image" class="@error('footer_image') text-danger @enderror">Footer
                                            Image</label>
                                        <input id="footer_image" name="footer_image" value="{{ old('footer_image') }}"
                                               type="file"
                                               class="form-control @error('footer_image') is-invalid @enderror"
                                               placeholder="Select File" autofocus>
                                        {{--@if(isset($site->footer_image->file_name))
                                            <span class="invalid-feedback text-dark"
                                                  role="alert"><strong>Footer Image: {{ $site->footer_image->file_name }}</strong></span>
                                        @endif--}}
                                        @if(isset($site->footer_image))
                                            <div class="image-output">
                                                <img src="{{ $site->footer_image->file_url }}">
                                            </div>
                                        @endif
                                        @error('footer_image')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parallax_image_1"
                                               class="@error('parallax_image_1') text-danger @enderror">Parallax Image 1</label>
                                        <input id="parallax_image_1" name="parallax_image_1"
                                               value="{{ old('parallax_image_1') }}" type="file"
                                               class="form-control @error('parallax_image_1') is-invalid @enderror"
                                               placeholder="Select File" autofocus>
                                        {{--@if(isset($site->parallax_image_1->file_name))
                                            <span class="invalid-feedback text-dark" role="alert"><strong>Parallax Image 1: {{ $site->parallax_image_1->file_name }}</strong></span>
                                        @endif--}}
                                        @if(isset($site->parallax_image_1))
                                            <div class="image-output">
                                                <img src="{{ $site->parallax_image_1->file_url }}">
                                            </div>
                                        @endif
                                        @error('parallax_image_1')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="parallax_image_2"
                                               class="@error('parallax_image_2') text-danger @enderror">Parallax Image 2</label>
                                        <input id="parallax_image_2" name="parallax_image_2"
                                               value="{{ old('parallax_image_2') }}" type="file"
                                               class="form-control @error('parallax_image_2') is-invalid @enderror"
                                               placeholder="Select File" autofocus>
                                        {{--@if(isset($site->parallax_image_2->file_name))
                                            <span class="invalid-feedback text-dark" role="alert"><strong>Parallax Image 2: {{ $site->parallax_image_2->file_name }}</strong></span>
                                        @endif--}}
                                        @if(isset($site->parallax_image_2))
                                            <div class="image-output">
                                                <img src="{{ $site->parallax_image_2->file_url }}">
                                            </div>
                                        @endif
                                        @error('parallax_image_2')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="parallax_image_3"
                                               class="@error('parallax_image_3') text-danger @enderror">Parallax Image 3</label>
                                        <input id="parallax_image_3" name="parallax_image_3"
                                               value="{{ old('parallax_image_3') }}" type="file"
                                               class="form-control @error('parallax_image_3') is-invalid @enderror"
                                               placeholder="Select File" autofocus>
                                        {{--@if(isset($site->parallax_image_3->file_name))
                                            <span class="invalid-feedback text-dark" role="alert"><strong>Parallax Image 3: {{ $site->parallax_image_3->file_name }}</strong></span>
                                        @endif--}}
                                        @if(isset($site->parallax_image_3))
                                            <div class="image-output">
                                                <img src="{{ $site->parallax_image_3->file_url }}">
                                            </div>
                                        @endif
                                        @error('parallax_image_3')
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
