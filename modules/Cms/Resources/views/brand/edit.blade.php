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
                            <h3 class="card-title mt-1">Upload Content</h3>
                            <a href="{{ route('backend.cms.brand.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Brand List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.cms.brand.update', [$campaign_influencer->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                @php
                                    $available_until = \Carbon\Carbon::parse($campaign_influencer->available_until);
                                @endphp
                                @foreach($campaign_influencer->content_types as $index => $content_type)
                                    @php
                                        $media_collection = 'campaign_influencer_content_' . $campaign_influencer->id . '_' . \Str::snake($content_type);
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="logo" class="@error('logo') text-danger @enderror">
                                                {{ $content_type }}
                                            </label>
                                            @if(\Carbon\Carbon::now()->lt($available_until))
                                                <div class="custom-file">
                                                    <input type="file" name="{{ $media_collection }}" value="{{ old($media_collection) }}" class="custom-file-input @error($media_collection) is-invalid @enderror" id="customFile">
                                                    <label class="custom-file-label font-weight-normal" for="customFile">Choose file</label>
                                                </div>
                                                @error($media_collection)
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            @endif
                                            @if(isset($campaign_influencer->getMedia($media_collection)[0]))
                                                <div class="image-output" style="width: 100%">
                                                    <img src="{{ $campaign_influencer->getMedia($media_collection)[0]->getUrl() }}" class="w-100" style="height: 200px" />
                                                </div>
                                                <a href="{{ $campaign_influencer->getMedia($media_collection)[0]->getUrl() }}" class="btn btn-primary btn-sm mt-2" download>
                                                    Download
                                                </a>
                                            @else
                                                <div class="m-auto pt-3 text-center">
                                                    <i class="fa fa-exclamation-circle text-danger"></i>
                                                    <span class="d-block text-danger">Content Not Uploaded</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1" {{ \Carbon\Carbon::now()->lt($available_until) ? '' : 'disabled' }}>Submit</button>
                            <a href="{{ route('backend.cms.brand.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
