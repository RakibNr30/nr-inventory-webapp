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
                            <h3 class="card-title">Influencer List</h3>
                            <a href="{{ route('backend.ums.influencer.create') }}" type="button" class="btn btn-success btn-sm text-white float-right">
                                Add new influencer
                            </a>
                        </div>

                        <div class="card-body table-responsive p-0 influencer-list">
                            @if(count($influencers))
                                    <div class="table-responsive w-100">
                                        <table class="table table-striped projects">
                                            <thead>
                                            <tr>
                                                <th>Influencer Name</th>
                                                <th>Instagram Profile</th>
                                                <th>Instagram Follower</th>
                                                <th>Tiktok Profile</th>
                                                <th>Tiktok Follower</th>
                                                <th>Registration Status</th>
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
                                                                <a class="font-weight-bold text-dark ml-2" data-toggle="modal">
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
                                                        {{ $influencer->is_process_completed ? 'Complete' : 'Incomplete' }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('backend.ums.influencer.edit', [$influencer->id]) }}" class="btn btn-default">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            @else
                                <div class="text-center mb-3">
                                    <i class="fa fa-user"></i>
                                    <span class="d-block">No Influencer Here</span>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('style')
    <style>
        form {
            display: unset;
        }
        ul.action-button {
            list-style: none;
        }
        ul.action-button li {
           margin-top: 8px;
        }
        .influencer-list {
            max-height: 500px;
            overflow-y: scroll;
        }
        .influencer-list::-webkit-scrollbar {
            display: none;
        }

        td.brand-input {
            min-width: 300px;
        }
        td.brand-input .form-control {
            height: calc(2rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 0.7rem;
        }

        td.brand-input .brand-input-label {
            font-size: 0.7rem;
        }
        td.brand-input .form-group {
            margin-bottom: 0.3rem;
        }
        th, td {
            white-space:nowrap;
            text-align: left
        }
    </style>
@stop
