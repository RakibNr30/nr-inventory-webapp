@extends('admin.layouts.master')
@php
    $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
@endphp
@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Edit Page</h3>
                            <a href="{{ route('backend.cms.page.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Page List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.cms.page.update', [$page->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="page_category_id" class="@error('page_category_id') text-danger @enderror">Page Category</label>
                                        <select id="page_category_id" name="page_category_id" class="form-control  @error('page_category_id') is-invalid @enderror" {{ $user->hasRole('Super Admin') ? '' : 'readonly' }}>
                                            <option value="">Select a category</option>
                                            @foreach($pageCategories as $pageCategory)
                                                <option value="{{ $pageCategory->id }}" {{ old('page_category_id')
                                                    ? (old('content_category_id') == $pageCategory->id ? 'selected' : '')
                                                    : ($page->page_category_id == $pageCategory->id ? 'selected' : '') }}>
                                                    {{ $pageCategory->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('page_category_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="@error('title') text-danger @enderror">Title</label>
                                        <input id="title" name="title" value="{{ old('title') ?: $page->title }}" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title" autofocus {{ $user->hasRole('Super Admin') ? '' : 'readonly' }}>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter description">{{ old('description') ?: $page->description }}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="feature_image" class="@error('feature_image') text-danger @enderror">Image</label>
                                        <input id="feature_image" name="feature_image" value="{{ old('feature_image') }}" type="file" class="form-control @error('feature_image') is-invalid @enderror" placeholder="Select Image" autofocus>
                                        {{--@if(isset($page->image->file_name))
                                            <span class="invalid-feedback text-dark" role="alert"><strong>Image: {{ $page->image->file_name }}</strong></span>
                                        @endif--}}
                                        @if(isset($page->image))
                                            <div class="image-output">
                                                <img src="{{ $page->image->file_url }}">
                                            </div>
                                        @endif
                                        @error('feature_image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                            <a href="{{ route('backend.cms.page.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
