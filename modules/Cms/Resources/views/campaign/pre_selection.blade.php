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
                            <h3 class="card-title mt-1">Influencer Pre-selection ({{ $campaign->title ?? '' }})</h3>
                            <a href="{{ route('backend.cms.campaign.show', [$campaign->id]) }}" type="button" class="btn btn-dark btn-sm text-white float-right">Back to Campaign</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    @if(!\App\Helpers\AuthManager::isInfluencer())
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                Influencers
                            </div>
                            <div class="card-body">
                                @if(count($influencers))
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
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($influencers as $index => $influencer)
                                                    <tr>
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
                                                                <a target="_blank" href="https://tiktok.com/{{ $influencer->socialAccountInfo->tiktok_username }}">
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
                                                            <a class="btn btn-info btn-xs" href="{{ route('backend.cms.campaign.influencer.pre-selection.create', [$campaign->id, $influencer->id]) }}">
                                                                Add to campaign
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
                                        <span class="d-block">No Pre-selected Influencer Here</span>
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
@stop
