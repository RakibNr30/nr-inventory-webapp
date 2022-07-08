@extends('admin.layouts.master')

@section('content')
    @php
        use \Carbon\Carbon;
    @endphp
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Campaign Details ({{ $campaign->title ?? '' }})</h3>
                            <a href="{{ route('backend.cms.campaign.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Campaign List</a>
                            @if(\App\Helpers\AuthManager::isSuperAdmin() || \App\Helpers\AuthManager::isAdmin() || \App\Helpers\AuthManager::isInfluencerManager())
                                <a href="{{ route('backend.cms.campaign.influencer.create', [$campaign->id]) }}" type="button" class="btn btn-primary btn-sm text-white float-right mr-2">
                                    Add Influencer to Campaign
                                </a>
                            @endif
                            @if(!\App\Helpers\AuthManager::isInfluencer() && !\App\Helpers\AuthManager::isBrand())
                                <div class="float-right mr-2">
                                    <input type="checkbox" name="is_active" id="is_active"
                                           {{ $campaign->is_active ? 'checked' : '' }}
                                           data-bootstrap-switch
                                           data-on-text="Active"
                                           data-off-text="De-active"
                                    >
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    @if(!\App\Helpers\AuthManager::isInfluencer())
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                <h6 class="float-left">Influencers</h6>
                                @if(!\App\Helpers\AuthManager::isBrand())
                                    <a href="{{ route('backend.cms.campaign.pre-selection', [$campaign->id]) }}" type="button" class="btn btn-dark btn-sm text-white float-right">
                                        Add Influencer From Pre-selection
                                    </a>
                                @endif
                            </div>
                            <div class="card-body">
                                @if(count($campaign->campaignInfluencers))
                                    <div class="influencer-list">
                                        <div class="table-responsive w-100">
                                            <table class="table table-striped projects">
                                                <thead>
                                                <tr>
                                                    <th>Influencer Name</th>
                                                    <th>Instagram Profile</th>
                                                    <th>Instagram Follower</th>
                                                    <th>Tiktok Profile</th>
                                                    <th>Tiktok Follower</th>
                                                    <th>Start Date</th>
                                                    <th>Cooperation duration</th>
                                                    <th>Fee</th>
                                                    <th>Content Type</th>
                                                    <th>Personal Notes</th>
                                                    <th>Coupon</th>
                                                    <th>Briefing Reminder</th>
                                                    <th>Content Reminder</th>
                                                    <th>Missing Content Reminder</th>
                                                    <th>Accepted by influencer</th>
                                                    <th>Accepted by Partner</th>
                                                    <th>Deadline</th>
                                                    <th>Contact person</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($campaign->campaignInfluencers as $index => $campaignInfluencer)
                                                    <tr>
                                                        @php
                                                            $influencer = $campaignInfluencer->user ?? null;
                                                            $contents = \Modules\Cms\Http\Controllers\BrandController::getContents($campaignInfluencer);
                                                        @endphp

                                                        @php
                                                            $uploaded_content = 0;
                                                            $contentIndex = 0;
                                                            foreach ($campaignInfluencer->brands as $index1 => $brand) {
                                                                foreach($campaignInfluencer->content_types as $index2 => $content_type) {
                                                                    $contents[$contentIndex] = $contents[$contentIndex] < $campaignInfluencer->current_cycle ? ($contents[$contentIndex] + 1) : $contents[$contentIndex];
                                                                    $media_collection_first = 'campaign_influencer_content_' . $campaignInfluencer->id . '_' . $brand->id . '_' . \Str::snake($content_type) . '_1';
                                                                    $media_collection = 'campaign_influencer_content_' . $campaignInfluencer->id . '_' . $brand->id . '_' . \Str::snake($content_type) . '_' . ($contents[$contentIndex]);

                                                                    $uploaded_content += isset($campaignInfluencer->getMedia($media_collection_first)[0]);
                                                                    $contentIndex++;
                                                                }
                                                            }
                                                            $total_contents = count($campaignInfluencer->content_types ?? []) * count($campaignInfluencer->brands ?? []);
                                                            $missing_contents = $total_contents - $uploaded_content;
                                                        @endphp

                                                        <td>
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <a data-toggle="modal" href="#modal-xl-{{ $index }}">
                                                                        <i class="far fa-clone mr-3"></i>
                                                                    </a>
                                                                    <a class="font-weight-bold text-dark" data-toggle="modal" href="#modal-xl-{{ $index }}">
                                                                        <img alt="Avatar" class="table-avatar" src="{{ $influencer->avatar->file_url ??
                                                                            ($influencer->additionalInfo->gender == 2 ?
                                                                            config('core.image.default.avatar_female') :
                                                                            config('core.image.default.avatar_male')) }}"
                                                                        >
                                                                    </a>
                                                                    <a class="font-weight-bold text-dark ml-2" data-toggle="modal" href="#modal-xl-{{ $index }}">
                                                                        {{ $influencer->additionalInfo->first_name ?? '' }}
                                                                        {{ $influencer->additionalInfo->last_name ?? '' }}
                                                                    </a>
                                                                    @php
                                                                        $notifications = count($campaignInfluencer->content_reminders_at ?? []) + (!$missing_contents && (Carbon::now()->gt(Carbon::parse($campaignInfluencer->available_until)))) ? $missing_contents : 0;
                                                                    @endphp
                                                                    <span class="badge badge-danger">{{ $notifications == 0 ? '' : $notifications }}</span>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            @if(isset($influencer->socialAccountInfo->instagram_username))
                                                                <a target="_blank" href="https://instagram.com/{{ $influencer->socialAccountInfo->instagram_username }}">
                                                                    {{ '@' . $influencer->socialAccountInfo->instagram_username }}
                                                                </a>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ \App\Helpers\NumberManager::shortFormat($influencer->socialAccountInfo->instagram_followers ?? 0) }}
                                                        </td>
                                                        <td>
                                                            @if(isset($influencer->socialAccountInfo->tiktok_username))
                                                                <a target="_blank" href="https://tiktok.com/{{ '@' . $influencer->socialAccountInfo->tiktok_username }}">
                                                                    {{ '@' . $influencer->socialAccountInfo->tiktok_username }}
                                                                </a>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ \App\Helpers\NumberManager::shortFormat($influencer->socialAccountInfo->tiktok_followers ?? 0) }}
                                                        </td>
                                                        <td>
                                                            {{ $campaignInfluencer->start_date ?? '-' }}
                                                        </td>
                                                        <td>
                                                            {{ $campaignInfluencer->cycle_count }}
                                                            @if ($campaign->cycle_time_unit == 1)
                                                                Months
                                                            @elseif ($campaign->cycle_time_unit == 2)
                                                                Weeks
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $campaignInfluencer->fee }}&euro;
                                                        </td>
                                                        <td>
                                                            <small class="text-primary font-weight-bold">
                                                                @foreach($campaignInfluencer->content_types as $c_index => $content_type)
                                                                    {{ $content_type }}
                                                                    @if($c_index + 1 < count($campaignInfluencer->content_types))
                                                                        {{ ',' }}
                                                                    @endif
                                                                @endforeach
                                                            </small>
                                                            {{-- modal --}}
                                                            <div class="modal fade" id="modal-xl-{{ $index }}" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <div class="row w-100">
                                                                                <div class="col-md-6">
                                                                                    <div class="d-inline-block position-relative" style="top: -30px">
                                                                                        <img alt="Avatar" class="table-avatar" style="border: 1px solid #d5d5d5; height: 80px; width: 80px" src="{{ $influencer->avatar->file_url ??
                                                                                            ($influencer->additionalInfo->gender == 2 ?
                                                                                            config('core.image.default.avatar_female') :
                                                                                            config('core.image.default.avatar_male')) }}"
                                                                                        >
                                                                                    </div>

                                                                                    <div class="ml-1 d-inline-block">
                                                                                        <h4 class="modal-title">
                                                                                            <span class="d-block font-weight-bold text-md">
                                                                                                {{ $influencer->additionalInfo->first_name ?? '' }}
                                                                                                {{ $influencer->additionalInfo->last_name ?? '' }}
                                                                                                <span class="badge badge-danger">{{ count($campaignInfluencer->content_reminders_at ?? []) == 0 ? '' : count($campaignInfluencer->content_reminders_at ?? []) }}</span>
                                                                                            </span>
                                                                                        </h4>
                                                                                        <span class="d-block text-sm text-gray">
                                                                                            {{ $influencer->email ?? '' }}
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            @if($influencer->socialAccountInfo->instagram_username)
                                                                                                <i class="fab fa-instagram mr-2"></i>
                                                                                                <a href="https://www.instagram.com/{{ $influencer->socialAccountInfo->instagram_username }}" >
                                                                                                    {{ '@' . $influencer->socialAccountInfo->instagram_username }}
                                                                                                </a>
                                                                                            @endif
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            @if($influencer->socialAccountInfo->tiktok_username)
                                                                                                <i class="fab fa-tiktok mr-2"></i>
                                                                                                <a href="https://www.tiktok.com/{{ '@' . $influencer->socialAccountInfo->tiktok_username }}">
                                                                                                    {{ '@' . $influencer->socialAccountInfo->tiktok_username }}
                                                                                                </a>
                                                                                            @endif
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="ml-4 d-inline-block">
                                                                                        <span class="d-block font-weight-bold text-md">

                                                                                        </span>
                                                                                        <span class="d-block text-sm font-weight-bold">
                                                                                            Follower
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            {{ $influencer->socialAccountInfo->instagram_followers }}
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            {{ $influencer->socialAccountInfo->tiktok_followers }}
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    {!! Form::open(['url' => route('backend.cms.campaign-influencer.reminder', [$campaignInfluencer->id]), 'method' => 'put']) !!}
                                                                                    <div class="d-inline-block text-center">
                                                                                        <span class="d-block font-weight-bold text-md">
                                                                                            &nbsp;
                                                                                        </span>
                                                                                        <span class="d-block text-sm font-weight-bold">
                                                                                            Briefing Reminder
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            {{ count($campaignInfluencer->briefing_reminders_at ?? []) }}
                                                                                        </span>
                                                                                        <span class="d-block text-sm mt-1">
                                                                                            <button name="briefing_reminder" value="{{ 1 }}" class="btn btn-primary btn-sm"
                                                                                                {{ Carbon::now()->gt(Carbon::parse($campaignInfluencer->created_at)->addDays(2)) ? '' : 'disabled' }}
                                                                                            >
                                                                                                Send out
                                                                                            </button>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="d-inline-block ml-4 text-center">
                                                                                        <span class="d-block font-weight-bold text-md">
                                                                                            &nbsp;
                                                                                        </span>
                                                                                        <span class="d-block text-sm font-weight-bold">
                                                                                            Content Reminder
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            {{ count($campaignInfluencer->content_reminders_at ?? []) }}
                                                                                        </span>
                                                                                        <span class="d-block text-sm mt-1">
                                                                                            <button name="content_reminder" value="{{ 1 }}" class="btn btn-primary btn-sm"
                                                                                                {{ !$uploaded_content && (Carbon::now()->gt(Carbon::parse($campaignInfluencer->available_until))) ? '' : 'disabled' }}
                                                                                            >
                                                                                                Send out
                                                                                            </button>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="d-inline-block ml-4 text-center">
                                                                                        <span class="d-block font-weight-bold text-md">
                                                                                            &nbsp;
                                                                                        </span>
                                                                                        <span class="d-block text-sm font-weight-bold">
                                                                                            Missing Content Reminder
                                                                                            @if(!$missing_contents && (Carbon::now()->gt(Carbon::parse($campaignInfluencer->available_until))))
                                                                                                <span class="badge badge-danger">
                                                                                                    {{ $missing_contents }}
                                                                                                </span>
                                                                                            @endif
                                                                                        </span>
                                                                                        <span class="d-block text-sm">
                                                                                            {{ count($campaignInfluencer->missing_content_reminders_at ?? []) }}
                                                                                        </span>
                                                                                        <span class="d-block text-sm mt-1">
                                                                                            <button name="missing_content_reminder" value="{{ 1 }}" class="btn btn-primary btn-sm"
                                                                                                {{ ($total_contents > $uploaded_content) && (Carbon::now()->gt(Carbon::parse($campaignInfluencer->available_until))) ? '' : 'disabled' }}
                                                                                            >
                                                                                                Send out
                                                                                            </button>
                                                                                        </span>
                                                                                    </div>
                                                                                    {!! Form::close() !!}
                                                                                </div>
                                                                            </div>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12 table-responsive">
                                                                                    <table class="table w-100" style="height: 180px">
                                                                                        <tr>
                                                                                            <th class="align-middle">Campaign</th>
                                                                                            <th class="align-middle">Start Date</th>
                                                                                            <th class="align-middle">Deadline, Time Left</th>
                                                                                            <th class="align-middle">Briefing Reminder</th>
                                                                                            <th class="align-middle">Content Reminder</th>
                                                                                            <th class="align-middle">Missing Content Reminder</th>
                                                                                            <th class="align-middle">Duration</th>
                                                                                            <th class="align-middle">Content</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>{{ $campaign->title ?? '' }}</td>
                                                                                            <td>{{ $campaignInfluencer->campaign->start_date ?? '' }}</td>
                                                                                            <td>{{ $campaignInfluencer->next_deadline->format('d.m.Y') ?? '' }}, {{ $campaignInfluencer->next_deadline->diffInDays() }} days</td>
                                                                                            <td>
                                                                                                <div class="tooltip2">
                                                                                                    {{ count($campaignInfluencer->briefing_reminders_at ?? []) }}. Reminder
                                                                                                    <span class="tooltiptext">
                                                                                                        @if(count($campaignInfluencer->briefing_reminders_at ?? []))
                                                                                                            @foreach($campaignInfluencer->briefing_reminders_at ?? [] as $c_index => $briefing_reminder_at)
                                                                                                                <span class="d-block">
                                                                                                                {{ $c_index + 1 }}. Reminder ({{ \Carbon\Carbon::parse($briefing_reminder_at)->format('d.m.Y') }})
                                                                                                            </span>
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    </span>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="tooltip2">
                                                                                                    {{ count($campaignInfluencer->content_reminders_at ?? []) }}. Reminder
                                                                                                    <span class="tooltiptext">
                                                                                                        @if(count($campaignInfluencer->content_reminders_at ?? []))
                                                                                                            @foreach($campaignInfluencer->content_reminders_at ?? [] as $c_index => $content_reminder_at)
                                                                                                                <span class="d-block">
                                                                                                                {{ $c_index + 1 }}. Reminder ({{ \Carbon\Carbon::parse($content_reminder_at)->format('d.m.Y') }})
                                                                                                            </span>
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    </span>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="tooltip2">
                                                                                                    {{ count($campaignInfluencer->missing_content_reminders_at ?? []) }}. Reminder
                                                                                                    <span class="tooltiptext">
                                                                                                        @if(count($campaignInfluencer->missing_content_reminders_at ?? []))
                                                                                                            @foreach($campaignInfluencer->missing_content_reminders_at ?? [] as $c_index => $missing_content_reminder_at)
                                                                                                                <span class="d-block">
                                                                                                                {{ $c_index + 1 }}. Reminder ({{ \Carbon\Carbon::parse($missing_content_reminder_at)->format('d.m.Y') }})
                                                                                                            </span>
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    </span>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                {{ $campaignInfluencer->cycle_count }}
                                                                                                @if ($campaign->cycle_time_unit == 1)
                                                                                                    Months
                                                                                                @elseif ($campaign->cycle_time_unit == 2)
                                                                                                    Weeks
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>
                                                                                                {{ $uploaded_content }} / {{ $total_contents }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="row">
                                                                                        @php
                                                                                            $available_until = \Carbon\Carbon::parse($campaignInfluencer->available_until);
                                                                                            $contents = \Modules\Cms\Http\Controllers\BrandController::getContents($campaignInfluencer);
                                                                                            $contentIndex = 0;
                                                                                        @endphp

                                                                                        @foreach($campaignInfluencer->brands as $index1 => $brand)
                                                                                                <div class="col-md-12 {{ $index1 != 0 ? 'mt-3' : '' }}">
                                                                                                    <h4>
                                                                                                        Brand: {{ $brand->additionalInfo->first_name ?? '' }}
                                                                                                    </h4>
                                                                                                </div>
                                                                                                @php
                                                                                                    $available_until = \Carbon\Carbon::parse($campaignInfluencer->available_until);
                                                                                                @endphp
                                                                                                @foreach($campaignInfluencer->content_types as $index2 => $content_type)
                                                                                                    @php
                                                                                                        $contents[$contentIndex] = $contents[$contentIndex] < $campaignInfluencer->current_cycle ? ($contents[$contentIndex] + 1) : $contents[$contentIndex];
                                                                                                        $media_collection_first = 'campaign_influencer_content_' . $campaignInfluencer->id . '_' . $brand->id . '_' . \Str::snake($content_type) . '_1';
                                                                                                        $media_collection = 'campaign_influencer_content_' . $campaignInfluencer->id . '_' . $brand->id . '_' . \Str::snake($content_type) . '_' . ($contents[$contentIndex]);
                                                                                                    @endphp
                                                                                                    <div class="col-md-4">
                                                                                                        <div class="card">
                                                                                                            <div class="card-body">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="logo" class="@error('logo') text-danger @enderror">
                                                                                                                        {{ $content_type }} ({{ ($contents[$contentIndex]) . '/' . $campaignInfluencer->cycle_count }})
                                                                                                                    </label>
                                                                                                                    @if(isset($campaignInfluencer->getMedia($media_collection_first)[0]))
                                                                                                                        <br>
                                                                                                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm mt-2" data-toggle="modal" data-target="#modal-xl-1-{{ $index1 }}-{{ $index2 }}">
                                                                                                                            Content View
                                                                                                                        </a>

                                                                                                                        <div class="modal fade" id="modal-xl-1-{{ $index1 }}-{{ $index2 }}" style="display: none;" aria-hidden="true">
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
                                                                                                                                            @foreach(range(1, $campaignInfluencer->current_cycle) as $index3 => $cycle)
                                                                                                                                                @php
                                                                                                                                                    $media_collection_single = 'campaign_influencer_content_' . $campaignInfluencer->id . '_' . $brand->id . '_' . \Str::snake($content_type) . '_' . $cycle;
                                                                                                                                                @endphp
                                                                                                                                                <div class="col-md-4">
                                                                                                                                                    <div class="card">
                                                                                                                                                        <div class="card-body">
                                                                                                                                                            <div class="form-group text-center">
                                                                                                                                                                @if(isset($campaignInfluencer->getMedia($media_collection_single)[0]))
                                                                                                                                                                    <div class="image-output" style="border: 1px solid #bebebe">
                                                                                                                                                                        <a href="{{ $campaignInfluencer->getMedia($media_collection_single)[0]->getUrl() }}" target="_blank">
                                                                                                                                                                            <img src="{{ $campaignInfluencer->getMedia($media_collection_single)[0]->getUrl() }}" class="w-100" style="height: 100px" />
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
                                                                                        @endforeach

                                                                                        @foreach($campaignInfluencer->content_types as $index => $content_type)
                                                                                            @php
                                                                                                $media_collection = 'campaign_influencer_content_' . $campaignInfluencer->id . '_' . \Str::snake($content_type);
                                                                                                $admin_media_collection = 'admin_campaign_influencer_content_' . $campaignInfluencer->id . '_' . \Str::snake($content_type);
                                                                                            @endphp
                                                                                            <div class="col-md-4">
                                                                                                <div class="card">
                                                                                                    <div class="card-header">
                                                                                                        <div class="card-title">
                                                                                                            <strong>{{ $content_type }}</strong> - Review
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="card-body">
                                                                                                        <div class="form-group text-center">
                                                                                                            {!! Form::open(['url' => route('backend.cms.campaign-influencer.feedbackContent', [$campaignInfluencer->id]), 'method' => 'put', 'files' => true]) !!}
                                                                                                            @if(\Carbon\Carbon::now()->lt($available_until))
                                                                                                                <div class="custom-file">
                                                                                                                    <input type="file" name="{{ $admin_media_collection }}" value="{{ old($admin_media_collection) }}" class="custom-file-input @error($admin_media_collection) is-invalid @enderror" id="customFile">
                                                                                                                    <label class="custom-file-label font-weight-normal" for="customFile">Choose file</label>
                                                                                                                </div>
                                                                                                                @error($admin_media_collection)
                                                                                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                                                                                @enderror
                                                                                                                <div class="mt-2">
                                                                                                                    <button class="btn btn-success">Upload</button>
                                                                                                                </div>
                                                                                                            @endif
                                                                                                            @if(isset($campaignInfluencer->getMedia($admin_media_collection)[0]))
                                                                                                                <div class="image-output" style="width: 100%">
                                                                                                                    <img src="{{ $campaignInfluencer->getMedia($admin_media_collection)[0]->getUrl() }}" class="w-100" style="height: 200px" />
                                                                                                                </div>
                                                                                                                <a href="{{ $campaignInfluencer->getMedia($admin_media_collection)[0]->getUrl() }}" class="btn btn-primary btn-sm mt-2" download>
                                                                                                                    Download
                                                                                                                </a>
                                                                                                            @else
                                                                                                                <div class="m-auto pt-3 text-center">
                                                                                                                    <i class="fa fa-exclamation-circle text-danger"></i>
                                                                                                                    <span class="d-block text-danger">Content Not Uploaded By Internal</span>
                                                                                                                </div>
                                                                                                            @endif
                                                                                                            {!! Form::close() !!}
                                                                                                        </div>
                                                                                                        <div class="col-md-12"><hr></div>
                                                                                                        <div class="form-group text-center">
                                                                                                            {!! Form::open(['url' => route('backend.cms.campaign-influencer.feedback', [$campaignInfluencer->id]), 'method' => 'put']) !!}
                                                                                                            <div class="form-group text-left mt-2">
                                                                                                                <label>Grade</label>
                                                                                                                <input name="grade_{{ \Str::snake($content_type) }}" value="{{ old('grade_' . \Str::snake($content_type)) ?? $campaignInfluencer->feedback['grade_' . \Str::snake($content_type)] ?? '' }}" type="number" min="0" placeholder="Grade" class="form-control" required />
                                                                                                            </div>
                                                                                                            <div class="form-group text-left mt-2">
                                                                                                                <label>Feedback</label>
                                                                                                                <textarea name="feedback_{{ \Str::snake($content_type) }}" rows="3" class="form-control" required>{{ old('feedback_' . \Str::snake($content_type)) ?? $campaignInfluencer->feedback['feedback_' . \Str::snake($content_type)] ?? '' }}</textarea>
                                                                                                            </div>
                                                                                                            <div class="form-group text-left mt-2">
                                                                                                                <button class="btn btn-primary btn-sm">Send</button>
                                                                                                            </div>
                                                                                                            {!! Form::close() !!}
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>{{ $campaignInfluencer->personal_notes ?? '-' }}</td>
                                                        <td>{{ $campaignInfluencer->internal_individual_coupon_code ?? $campaignInfluencer->individual_coupon_code ?? '-' }}</td>
                                                        <td>{{ count($campaignInfluencer->briefing_reminders_at ?? []) }}. Reminder</td>
                                                        <td>{{ count($campaignInfluencer->content_reminders_at ?? []) }}. Reminder</td>
                                                        <td>{{ count($campaignInfluencer->missing_content_reminders_at ?? []) }}. Reminder</td>
                                                        <td>
                                                            @if($campaignInfluencer->campaign_accept_status_by_influencer == 0)
                                                                <span class="badge badge-dark">Pending</span>
                                                            @endif
                                                            @if($campaignInfluencer->campaign_accept_status_by_influencer == -1)
                                                                <span class="badge badge-danger">Denied</span>
                                                            @endif
                                                            @if($campaignInfluencer->campaign_accept_status_by_influencer == 1)
                                                                <span class="badge badge-success">Accept</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($campaignInfluencer->accept_status == 0)
                                                                <span class="badge badge-dark">Pending</span>
                                                            @endif
                                                            @if($campaignInfluencer->accept_status == -1)
                                                                <span class="badge badge-danger">Denied</span>
                                                            @endif
                                                            @if($campaignInfluencer->accept_status == 1)
                                                                <span class="badge badge-success">Accept</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ Carbon::parse($campaignInfluencer->available_until)->format('m.d.Y') }}</td>
                                                        <td>
                                                            @php
                                                                $user = \Modules\Ums\Entities\User::query()->find($campaignInfluencer->campaign_manager_id)
                                                            @endphp

                                                            {{ $user->additionalInfo->first_name ?? '' }} {{ $user->additionalInfo->last_name ?? '' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <i class="fa fa-user"></i>
                                        <span class="d-block">No Influencer Here</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if(\App\Helpers\AuthManager::isInfluencer())
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                <h6>Brands</h6>
                            </div>
                            <div class="card-body">
                                @if(count($brands))
                                    <div class="brand-list">
                                        <div class="row">
                                            @foreach($brands as $index1 => $brand)
                                                <div class="col-lg-4 col-6">
                                                    <div class="small-box bg-gradient-secondary">
                                                        <div class="inner text-justify">
                                                            <img alt="Avatar" class="table-avatar" style="border: 1px solid #d5d5d5; height: 80px; width: 80px; margin-left: calc(50% - 40px);"
                                                                 src="{{ $brand->avatar->file_url ?? config('core.image.default.logo_preview') }}"
                                                            >
                                                        </div>

                                                        <a class="small-box-footer"
                                                           data-toggle="modal" href="#modal-lg-{{ $index1 }}"
                                                        >
                                                            More Info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>

                                                        <div class="modal fade" id="modal-lg-{{ $index1 }}" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg text-dark">
                                                                <div class="modal-content text-left">
                                                                    <div class="modal-header">
                                                                        <div class="d-inline-block position-relative" style="top: 14px">
                                                                            <img alt="Avatar" class="table-avatar" style="border: 1px solid #d5d5d5; height: 60px; width: 60px"
                                                                                 src="{{ $brand->avatar->file_url ?? config('core.image.default.logo_preview') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="ml-2">
                                                                            <h4 class="modal-title">
                                                                                <span class="font-weight-bold text-md">
                                                                                    {{ $brand->additionalInfo->first_name ?? '' }}
                                                                                </span>
                                                                            </h4>
                                                                            <span class="text-sm font-weight-normal">
                                                                                Here you‘ll find all relevant information about the brand {{ $brand->additionalInfo->first_name ?? '' }}. You will recieve further information when your package has been sent out.
                                                                            </span>
                                                                        </div>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            @if(isset($brand->briefing_pdf))
                                                                                <div class="col-md-12">
                                                                                    <a href="{{ $brand->briefing_pdf->file_url }}" class="btn btn-primary mb-2">Click to open Briefing PDF</a>
                                                                                </div>
                                                                            @endif
                                                                            <div class="col-md-12">
                                                                                <span class="d-block font-weight-bold">Additional Info</span>
                                                                                <div class="form-group">
                                                                                    <textarea rows="3" class="form-control bg-white" readonly>{{ $brand->additionalInfo->about ?? 'N/A' }}</textarea>
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
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <i class="fa fa-product-hunt"></i>
                                        <span class="d-block">No Brand Here</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('style')
    <style>
        .influencer-list {
            max-height: 600px;
            overflow-y: scroll;
        }
        .influencer-list::-webkit-scrollbar {
            display: none;
        }

        .brand-list {
            max-height: 400px;
            overflow-y: scroll;
        }
        .brand-list::-webkit-scrollbar {
            display: none;
        }

        ul.box-footer {
            list-style: none;
            display: flex;
            background-color: rgba(0,0,0,.1);
            color: rgba(255,255,255,.8);
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
        }
        ul.box-footer li {
            width: 33.33%;
        }
        ul.box-footer li a {
            color: #fff;
        }
        ul.box-footer li a:hover {
            color: #fff3cd;
        }

        ul.box-body {

        }
        ul.box-body li {
            width: 42%;
        }
        th, td {white-space:nowrap; text-align: left}
    </style>
    <style>
        .tooltip2 {
            position: relative;
            display: inline-block;
        }

        .tooltip2 .tooltiptext {
            visibility: hidden;
            width: 180px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 2;
            bottom: 125%;
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip2 .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        .tooltip2:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
@stop

@section('script')
    <script src="{{ asset('common/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $("input[name=is_active]").on('switchChange.bootstrapSwitch',function (e, data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token()}}'
                }
            });
            $.ajax({
                url: '{{ route('backend.cms.campaign.active-status.update', [$campaign->id]) }}',
                method: 'POST',
                data: {
                    is_active: data ? 1 : 0
                },
                success: function(){}
            })
        });
    </script>
@stop
