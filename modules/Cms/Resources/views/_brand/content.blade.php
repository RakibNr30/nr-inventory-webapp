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
                        {!! Form::open(['url' => route('backend.cms.brand.content.upload', [$brand_id, $campaign_influencer->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            @php
                            $contentIndex = 0;
                            @endphp
                            @foreach($campaign_influencer->brands as $index => $brand)
                                <div class="row">
                                    <div class="col-md-12 {{ $index != 0 ? 'mt-3' : '' }}">
                                        <h4>
                                            Brand: {{ $brand->additionalInfo->first_name ?? '' }}
                                        </h4>
                                    </div>
                                    @php
                                        $available_until = \Carbon\Carbon::parse($campaign_influencer->available_until);
                                    @endphp
                                    @foreach($campaign_influencer->content_types as $index1 => $content_type)
                                        @php
                                            $contents[$contentIndex] = $contents[$contentIndex] < $campaign_influencer->current_cycle ? ($contents[$contentIndex] + 1) : $contents[$contentIndex];
                                            $media_collection_first = 'campaign_influencer_content_' . $campaign_influencer->id . '_' . $brand->id . '_' . \Str::snake($content_type) . '_1';
                                            $media_collection = 'campaign_influencer_content_' . $campaign_influencer->id . '_' . $brand->id . '_' . \Str::snake($content_type) . '_' . ($contents[$contentIndex]);
                                        @endphp
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>
                                                            {{ $content_type }} ({{ ($contents[$contentIndex]) . '/' . $campaign_influencer->cycle_count }})
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
                                                        @if(isset($campaign_influencer->getMedia($media_collection_first)[0]))
                                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm mt-2" data-toggle="modal" data-target="#modal-xl-1-{{ $index }}-{{ $index1 }}">
                                                                Content View
                                                            </a>

                                                            <div class="modal fade" id="modal-xl-1-{{ $index }}-{{ $index1 }}" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title text-lg font-weight-bold">
                                                                                {{ $content_type }} - {{ $brand->additionalInfo->first_name ?? '' }}
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                @foreach(range(1, $campaign_influencer->current_cycle) as $index2 => $cycle)
                                                                                    @php
                                                                                        $media_collection_single = 'campaign_influencer_content_' . $campaign_influencer->id . '_' . $brand->id . '_' . \Str::snake($content_type) . '_' . $cycle;
                                                                                    @endphp
                                                                                    <div class="col-md-4">
                                                                                        <div class="card">
                                                                                            <div class="card-body">
                                                                                                <div class="form-group text-center">
                                                                                                    @if(isset($campaign_influencer->getMedia($media_collection_single)[0]))
                                                                                                        <div class="image-output" style="border: 1px solid #bebebe">
                                                                                                            <a href="{{ $campaign_influencer->getMedia($media_collection_single)[0]->getUrl() }}" target="_blank">
                                                                                                                <img src="{{ $campaign_influencer->getMedia($media_collection_single)[0]->getUrl() }}" class="w-100" style="height: 100px" />
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    @else
                                                                                                        <div class="m-auto pt-3 text-center">
                                                                                                            <i class="fa fa-exclamation-circle text-danger"></i>
                                                                                                            <span class="d-block text-danger">Content Not Uploaded</span>
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
                                                            <div class="m-auto pt-3 text-center">
                                                                <i class="fa fa-exclamation-circle text-danger"></i>
                                                                <span class="d-block text-danger">Content Not Uploaded</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $contentIndex++;
                                        @endphp
                                    @endforeach
                                </div>
                            @endforeach
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
