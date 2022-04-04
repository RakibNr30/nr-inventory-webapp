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
                            <h3 class="card-title">Influencer List</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="p-4">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group mb-0">
                                            <label>Sort by</label>
                                            <select class="form-control d-inline ml-2 w-auto">
                                                <option>Filters</option>
                                                <option>Name</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="table-responsive shadow w-100">
                                            <table class="table mb-0 text-center">
                                                <tbody>
                                                <tr>
                                                    <td class="border-top-0 p-0 pl-1">
                                                        Statistics
                                                    </td>
                                                    <td class="border-top-0 p-0">
                                                        <small class="font-weight-bold">
                                                            Overall
                                                        </small>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            6
                                                        </small>
                                                    </td>
                                                    <td class="border-top-0 p-0">
                                                        <small class="font-weight-bold">
                                                            Pending
                                                        </small>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            3
                                                        </small>
                                                    </td>
                                                    <td class="border-top-0 p-0">
                                                        <small class="font-weight-bold">
                                                            Approved
                                                        </small>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            7
                                                        </small>
                                                    </td>
                                                    <td class="border-top-0 p-0">
                                                        <small class="font-weight-bold">
                                                            Denied
                                                        </small>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            1
                                                        </small>
                                                    </td>
                                                    <td class="border-top-0 p-0 pr-1">
                                                        <small class="font-weight-bold">
                                                            Favourites
                                                        </small>
                                                        <br>
                                                        <small class="text-primary font-weight-bold">
                                                            4
                                                        </small>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive w-100">
                                <table class="table table-striped projects">
                                    <tbody>
                                    @foreach($dashboard->influencers as $index => $influencer)
                                        <tr>
                                            <td>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <img alt="Avatar" class="table-avatar" src="{{ config('core.image.default.avatar_male') }}">
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <a class="font-weight-bold">
                                                    {{ $influencer->additionalInfo->first_name ?? '' }}
                                                    {{ $influencer->additionalInfo->last_name ?? '' }}
                                                </a>
                                                <br>
                                                <small class="text-primary font-weight-bold">
                                                    Instagram Story, TikTok Video
                                                </small>
                                                <br>
                                                <div class="mt-1">
                                                    <a class="btn btn-info btn-xs" href="#">
                                                        <i class="fas fa-clone">
                                                        </i>
                                                    </a>
                                                    <a class="btn btn-primary btn-xs" href="#">
                                                        <i class="fas fa-check">
                                                        </i>
                                                        Accept
                                                    </a>
                                                    <a class="btn btn-danger btn-xs" href="#">
                                                        <i class="fas fa-minus-circle">
                                                        </i>
                                                        Deny
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="font-weight-bold">
                                                    Username
                                                </a>
                                                <br>
                                                <div class="mt-1">
                                                    <i class="fas fa-check">
                                                    </i>
                                                    <a class="" href="javascript:void(0)">
                                                        {{ $influencer->socialAccountInfo->instagram_username ?? '' }}
                                                    </a>
                                                </div>
                                                <div class="mt-1">
                                                    <i class="fas fa-check">
                                                    </i>
                                                    <a class="" href="javascript:void(0)">
                                                        {{ $influencer->socialAccountInfo->tiktok_username ?? '' }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="font-weight-bold">
                                                    Follower
                                                </a>
                                                <br>
                                                <div class="mt-1">
                                                    <a>
                                                        {{ \App\Helpers\NumberManager::shortFormat($influencer->socialAccountInfo->instagram_followers ?? 0) }}
                                                    </a>
                                                </div>
                                                <div class="mt-1">
                                                    <a>
                                                        {{ \App\Helpers\NumberManager::shortFormat($influencer->socialAccountInfo->tiktok_followers ?? 0) }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="btn btn-secondary btn-sm" href="#">
                                                    Add to favourites
                                                </a>
                                                <a class="btn btn-info btn-sm" href="#">
                                                    <i class="fas fa-ellipsis-v">
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    {{--<section class="content">
        <div class="container-fluid pt-4">
            @if($user->hasRole('Teacher') || $user->hasRole('Student'))
                <h5 class="mb-2">My Statistics</h5>
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-gradient-danger">
                            <div class="inner">
                                <h3>
                                    {{ $dashboard->statistics->totalPublication ?? 0 }}
                                </h3>
                                <p>Total Publications</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-area"></i>
                            </div>
                            <a href="{{ route('backend.cms.publication.index') }}" class="small-box-footer">
                                See All <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-gradient-success">
                            <div class="inner">
                                <h3>
                                    {{ $dashboard->statistics->totalProject ?? 0 }}
                                </h3>
                                <p>Total Projects</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-puzzle-piece"></i>
                            </div>
                            <a href="{{ route('backend.cms.project.index') }}" class="small-box-footer">
                                See All <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            @if($user->hasRole('Admin') || $user->hasRole('Super Admin'))
                <h5 class="mb-2 mt-4">Overall Statistics</h5>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Publications</span>
                                <span class="info-box-number">
                                {{ $dashboard->overallStatistics->totalPublication ?? 0 }}
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Projects</span>
                                <span class="info-box-number">
                                {{ $dashboard->overallStatistics->totalProject ?? 0 }}
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="far fa-copy"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Current Teachers</span>
                                <span class="info-box-number">
                                {{ $dashboard->overallStatistics->totalCurrentTeacher ?? 0 }}
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Current Students</span>
                                <span class="info-box-number">
                                {{ $dashboard->overallStatistics->totalCurrentStudent ?? 0 }}
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Alumni</span>
                                <span class="info-box-number">
                                {{ $dashboard->overallStatistics->totalAlumni ?? 0 }}
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Current Staffs</span>
                                <span class="info-box-number">
                                {{ $dashboard->overallStatistics->totalCurrenStaff ?? 0 }}
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>--}}
@stop
