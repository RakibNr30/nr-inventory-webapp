@extends('admin.layouts.master')

@section('content')
    @php
        use \Carbon\Carbon;
    @endphp
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Campaigns - {{ \App\Helpers\AuthManager::getRole()[0] ?? '' }}</h3>
                        </div>
                        @if(\App\Helpers\AuthManager::isAdmin() ||
                            \App\Helpers\AuthManager::isSuperAdmin() ||
                            \App\Helpers\AuthManager::isInfluencerManager())
                            <div class="card-body">
                                @if(count($campaignInfluencers))
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
                                                    <th>Campaign</th>
                                                    <th>Briefing Reminder</th>
                                                    <th>Content Reminder</th>
                                                    <th>Missing Content Reminder</th>
                                                    <th>Deadline Overdue</th>
                                                    <th>Accepted Internally</th>
                                                    <th>Posted Content</th>
                                                    <th>Manage Influencer</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($campaignInfluencers as $index => $campaignInfluencer)
                                                    <tr>
                                                        @php
                                                            $influencer = $campaignInfluencer->user ?? null;
                                                            $campaign = $campaignInfluencer->campaign ?? null;
                                                        @endphp

                                                        @php
                                                            $total_content = count($campaignInfluencer->content_types ?? []);
                                                            $uploaded_content = 0;
                                                            foreach($campaignInfluencer->content_types as $index => $content_type) {
                                                                $media_collection = 'campaign_influencer_content_' . $campaignInfluencer->id . '_' . \Str::snake($content_type);
                                                                $uploaded_content += isset($campaignInfluencer->getMedia($media_collection)[0]);
                                                            }
                                                        @endphp

                                                        <td>
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
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
                                                            {{ $campaign->title ?? '-' }}
                                                        </td>
                                                        <td>
                                                            {{ $campaignInfluencer->briefing_reminder ? 'Yes' : 'None' }}
                                                        </td>
                                                        <td>
                                                            {{ $campaignInfluencer->content_reminder ? 'Yes' : 'None' }}
                                                        </td>
                                                        <td>
                                                            {{ $campaignInfluencer->missing_content_reminder ? 'Yes' : 'None' }}
                                                        </td>
                                                        <td>
                                                            {{ Carbon::now()->lt(Carbon::parse($campaignInfluencer->available_until)) ? 'Yes' : 'None' }}
                                                        </td>
                                                        <td>
                                                            {{ $campaignInfluencer->accept_status == 1 ? 'Yes' : 'None' }}
                                                        </td>
                                                        <td>
                                                            {{ $uploaded_content }}/{{ $total_content }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('backend.ums.influencer.edit', [$campaignInfluencer->influencer_id]) }}" class="btn btn-primary btn-xs pl-3 pr-3">
                                                                View
                                                            </a>
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
                        @endif
                    </div>
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
