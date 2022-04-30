@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.partials._alert')
                    @if(\App\Helpers\AuthManager::isAdmin() || \App\Helpers\AuthManager::isSuperAdmin())
                        <div class="card card-gray-dark card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Brand List</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                {!! $dataTable->table(['class' => 'table table-hover', 'style' => 'width: 100%;']) !!}
                            </div>
                        </div>
                    @endif

                    @if(\App\Helpers\AuthManager::isInfluencer())
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Brand Info</h3>
                            <br>
                            <p class="text-sm text-primary">Here you find brand specific info and can directly upload your content.</p>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped projects mb-0">
                                <thead>
                                <tr>
                                    <td>Status</td>
                                    <td>Requirements</td>
                                    <td>Brand</td>
                                    <td>Deadline, Time left</td>
                                    <td>Briefing Info</td>
                                    <td>Content Upload</td>
                                    <td>Content Review</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($campaign_influencers as $index => $campaign_influencer)
                                    <tr>
                                        @php
                                            $available_until = \Carbon\Carbon::parse($campaign_influencer->available_until);
                                            \Carbon\Carbon::setLocale('en');
                                            $uploaded_content = 0;
                                            foreach($campaign_influencer->content_types as $index => $content_type) {
                                                $media_collection = 'campaign_influencer_content_' . $campaign_influencer->id . '_' . \Str::snake($content_type);
                                                $uploaded_content += isset($campaign_influencer->getMedia($media_collection)[0]);
                                            }
                                        @endphp
                                        @php
                                            $brands = Modules\Ums\Entities\User::query()->whereIn('id', $campaign_influencer->brand_ids)->get();
                                        @endphp

                                        <td>
                                            @if($uploaded_content == count($campaign_influencer->content_types))
                                                <span class="badge badge-success">
                                                    COMPLETED
                                                </span>
                                            @else
                                                @if(\Carbon\Carbon::now()->lt($available_until))
                                                    <span class="badge badge-primary">
                                                    RUNNING
                                                </span>
                                                @else
                                                    <span class="badge badge-danger">
                                                    OVERDUE
                                                </span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                foreach($campaign_influencer->content_types as $index => $content_type) {
                                                    print($content_type);
                                                    if($index + 1 < count($campaign_influencer->content_types))
                                                        print(', ');
                                                }
                                            @endphp
                                        </td>
                                        <td>
                                            {{ $campaign_influencer->campaign->brand->additionalInfo->first_name ?? '' }}
                                        </td>
                                        <td>
                                            @if($uploaded_content == count($campaign_influencer->content_types))
                                                <i class="fa fa-check"></i>
                                            @else
                                                {{ $available_until->format('d.m.Y') }}, {{ $available_until->diffInDays() }} days
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn text-primary font-weight-bold" data-toggle="modal" data-target="#modal-xl-{{ $index }}">
                                                View
                                            </button>

                                            <div class="modal fade" id="modal-xl-{{ $index }}" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class="d-inline-block position-relative">
                                                                <img alt="Avatar" class="table-avatar" style="border: 1px solid #d5d5d5; height: 40px; width: 40px"
                                                                     src="{{ $campaign_influencer->campaign->brand->avatar->file_url ?? config('core.image.default.logo_preview') }}"
                                                                >
                                                            </div>
                                                            <div class="ml-2">
                                                                <h4 class="modal-title">
                                                                    <span class="font-weight-bold text-md">
                                                                        {{ $campaign_influencer->campaign->brand->additionalInfo->first_name ?? '' }}
                                                                    </span>
                                                                </h4>
                                                            </div>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <span class="d-block font-weight-bold">Additional Info</span>
                                                                    <hr>
                                                                    {!! $campaign_influencer->campaign->brand->additionalInfo->about ?? 'N/A' !!}
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="row">
                                                                        @if($campaign_influencer->campaign->individual_coupon_code_brand)
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label class="brand-input-label">Individual Coupon Code</label>
                                                                                    <input value="{{ $campaign_influencer->individual_coupon_code ?? '' }}"
                                                                                           type="text"
                                                                                           class="form-control"
                                                                                           placeholder="Individual Coupon Code" autofocus
                                                                                           readonly
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        @if($campaign_influencer->campaign->individual_swipe_up_link_brand)
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label class="brand-input-label">Individual Swipe-up Link</label>
                                                                                    <input value="{{ $campaign_influencer->individual_swipe_up_link ?? '' }}"
                                                                                           type="text"
                                                                                           class="form-control"
                                                                                           placeholder="Individual Swipe-up Link" autofocus
                                                                                           readonly
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        @if($campaign_influencer->campaign->influencer_shipping_address_brand)
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label class="brand-input-label">Shipping Address</label>
                                                                                    <input value="{{ $campaign_influencer->shipping_address ?? '' }}"
                                                                                           type="text"
                                                                                           class="form-control"
                                                                                           placeholder="Shipping Address" autofocus
                                                                                           readonly
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </td>
                                        <td style="width: 140px !important;">
                                            @if(!$uploaded_content)
                                                <a href="{{ route('backend.cms.brand.edit', [$campaign_influencer->id]) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-upload"></i> Upload Files
                                                </a>
                                            @else
                                                <a href="{{ route('backend.cms.brand.edit', [$campaign_influencer->id]) }}" class="btn text-primary font-weight-bold">
                                                    View Content <span class="badge badge-danger">{{ $uploaded_content }}</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($uploaded_content)
                                                <button type="button" class="btn text-primary font-weight-bold" data-toggle="modal" data-target="#modal-xl-1-{{ $index }}">
                                                    View
                                                </button>
                                            @else
                                                Not Available
                                            @endif

                                            <div class="modal fade" id="modal-xl-1-{{ $index }}" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title text-lg font-weight-bold">
                                                                Content Review
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                @foreach($campaign_influencer->content_types as $index => $content_type)
                                                                    @php
                                                                        $media_collection = 'campaign_influencer_content_' . $campaign_influencer->id . '_' . \Str::snake($content_type);
                                                                    @endphp
                                                                    <div class="col-md-4">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <div class="card-title">
                                                                                    {{ $content_type }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div class="form-group text-center">
                                                                                    @error($media_collection)
                                                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                                                    @enderror
                                                                                    @if(isset($campaign_influencer->getMedia($media_collection)[0]))
                                                                                        <div class="form-group text-left mt-2">
                                                                                            <label>Grade</label>
                                                                                            <input value="{{ $campaign_influencer->feedback['grade_' . \Str::snake($content_type)] ?? '' }}" type="number" min="0" placeholder="Grade" class="form-control" readonly />
                                                                                        </div>
                                                                                        <div class="form-group text-left mt-2">
                                                                                            <label>Feedback</label>
                                                                                            <textarea rows="3" class="form-control" readonly>
                                                                                                                    {{ $campaign_influencer->feedback['feedback_' . \Str::snake($content_type)] ?? '' }}
                                                                                                                </textarea>
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
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@if(\App\Helpers\AuthManager::isAdmin() || \App\Helpers\AuthManager::isSuperAdmin())
    @section('style')
        <link rel="stylesheet" href="{{ asset('common/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('common/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @stop

    @section('script')
        <script src="{{ asset('common/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('common/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('common/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('common/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('common/plugins/datatables-ssr/buttons.server-side.js') }}"></script>
        {!! $dataTable->scripts() !!}
        <script src="{{ asset('admin/js/datatable.init.js') }}"></script>
    @stop
@endif
