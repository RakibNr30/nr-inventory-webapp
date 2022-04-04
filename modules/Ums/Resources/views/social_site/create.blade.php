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
                            <h3 class="card-title mt-1">Create Social Site</h3>
                            <a href="{{ route('backend.ums.social-site.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Social Site List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.social-site.store'), 'method' => 'social-site', 'files' => true]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title" class="@error('title') text-danger @enderror">Title</label>
                                            <select id="title" name="title" class="form-control @error('title') is-invalid @enderror">
                                                <option value="">Select title</option>
                                                @foreach(config('core.social_sites') as $key => $socialSite)
                                                    <option value="{{ $key }}">{{ $socialSite }}</option>
                                                @endforeach
                                            </select>
                                            @error('title')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="icon" class="@error('icon') text-danger @enderror">Icon</label>
                                            <input id="icon" name="icon" value="{{ old('icon') }}" type="text" class="form-control @error('icon') is-invalid @enderror" placeholder="Enter icon" autofocus>
                                            @error('icon')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="link" class="@error('link') text-danger @enderror">Link</label>
                                            <input id="link" name="link" value="{{ old('link') }}" type="text" class="form-control @error('link') is-invalid @enderror" placeholder="Enter link" autofocus>
                                            @error('link')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                                <a href="{{ route('backend.ums.social-site.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
