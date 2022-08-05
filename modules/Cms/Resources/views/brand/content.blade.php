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
                        {!! Form::open(['url' => route('backend.cms.brand.content.upload', [$campaign_influencer->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    Brand: <h4 class="font-weight-bold">{{ $campaign_influencer->campaign->brand->additionalInfo->first_name ?? '' }}</h4>
                                </div>
                                @php
                                    $available_until = \Carbon\Carbon::parse($campaign_influencer->available_until);
                                    $contentTypes = '';
                                    foreach ($campaign_influencer->content_types ?? [] as $key => $contentType) {
                                        $contentTypes .= $contentType;
                                        if (count($campaign_influencer->content_types) > $key + 1)
                                            $contentTypes .= ', ';
                                    }
                                @endphp
                                @foreach(range(1, $campaign_influencer->cycle_count) as $cycle)
                                    @php
                                        $media_collection = 'campaign_influencer_content_' . $campaign_influencer->id . '_' . $cycle;
                                        $get_media_collections = $campaign_influencer->getMedia($media_collection);
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group mb-0">
                                                    <label class="d-block mb-0">
                                                        Cycle {{ $cycle . '/' . $campaign_influencer->cycle_count }}
                                                    </label>
                                                    <span class="badge p-0 mb-2">{{ $contentTypes }}</span>
                                                @if(\Carbon\Carbon::now()->lt($available_until))
                                                        <div class="custom-file">
                                                            <input type="file" name="{{ $media_collection }}[]" value="{{ old($media_collection) }}" class="custom-file-input @error($media_collection) is-invalid @enderror" id="customFile" multiple {{ $cycle == $campaign_influencer->current_cycle ? '' : 'disabled' }}>
                                                            <label class="custom-file-label font-weight-normal" for="customFile">Choose file</label>
                                                        </div>
                                                        @error($media_collection)
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    @endif
                                                    @if(count($get_media_collections))
                                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm mt-2" data-toggle="modal" data-target="#modal-xl-1-{{ $cycle }}">
                                                            View Content
                                                        </a>

                                                        <div class="modal fade" id="modal-xl-1-{{ $cycle }}" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title text-lg font-weight-bold d-block">
                                                                            Cycle {{ $cycle }}
                                                                        </h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <span class="badge badge-danger font-weight-normal mb-4">Uploaded contents of {{ $contentTypes }}</span>
                                                                        <div class="row">
                                                                            @foreach($get_media_collections as $index2 => $file)
                                                                                <div class="col-md-4">
                                                                                    <div class="card">
                                                                                        <div class="card-header">
                                                                                            File: {{ $index2 + 1 }}
                                                                                        </div>
                                                                                        <div class="card-body">
                                                                                            <div class="form-group text-center">
                                                                                                @if($file)
                                                                                                    <div class="image-output" style="border: 1px solid #bebebe">
                                                                                                        @if(\App\Helpers\FileHelper::getType($file->mime_type) == 'video')
                                                                                                            <video width="100%" height="200" controls>
                                                                                                                <source src="{{ $file->getUrl() }}" type="{{ $file->mime_type }}">
                                                                                                                Your browser does not support the video tag.
                                                                                                            </video>
                                                                                                        @elseif(\App\Helpers\FileHelper::getType($file->mime_type) == 'image')
                                                                                                            <a href="{{ $file->getUrl() }}" target="_blank">
                                                                                                                <img src="{{ $file->getUrl() }}" class="w-100" style="height: 100px"  alt="#"/>
                                                                                                            </a>
                                                                                                        @else
                                                                                                            <a class="btn btn-info" href="{{ $file->getUrl() }}" download="">
                                                                                                                Download File
                                                                                                            </a>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm mt-2 disabled" disabled>
                                                            View Content
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
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
