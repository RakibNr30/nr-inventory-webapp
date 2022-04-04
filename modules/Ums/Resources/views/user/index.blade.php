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
                            {{--<a href="{{ route('backend.ums.user-priority.index') }}" type="button"
                               class="btn btn-success btn-sm text-white float-right">Edit Teacher's Priority</a>--}}
                        </div>
                        <div class="card-body table-responsive p-0">

                            <table class="table table-striped projects">
                                <tbody>
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
                                            Md Abdur Rakib
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
                                            <a class="" href="#">
                                                @marcell_r1234
                                            </a>
                                        </div>
                                        <div class="mt-1">
                                            <i class="fas fa-check">
                                            </i>
                                            <a class="" href="#">
                                                @marcell_rtok
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="font-weight-bold">
                                            Follower
                                        </a>
                                        <br>
                                        <div class="mt-1">
                                            <a class="">
                                                123.9k
                                            </a>
                                        </div>
                                        <div class="mt-1">
                                            <a class="">
                                                34.2k
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
                                            Md Abdur Rakib
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
                                            <a class="" href="#">
                                                @marcell_r1234
                                            </a>
                                        </div>
                                        <div class="mt-1">
                                            <i class="fas fa-check">
                                            </i>
                                            <a class="" href="#">
                                                @marcell_rtok
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="font-weight-bold">
                                            Follower
                                        </a>
                                        <br>
                                        <div class="mt-1">
                                            <a class="">
                                                123.9k
                                            </a>
                                        </div>
                                        <div class="mt-1">
                                            <a class="">
                                                34.2k
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
                                            Md Abdur Rakib
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
                                            <a class="" href="#">
                                                @marcell_r1234
                                            </a>
                                        </div>
                                        <div class="mt-1">
                                            <i class="fas fa-check">
                                            </i>
                                            <a class="" href="#">
                                                @marcell_rtok
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="font-weight-bold">
                                            Follower
                                        </a>
                                        <br>
                                        <div class="mt-1">
                                            <a class="">
                                                123.9k
                                            </a>
                                        </div>
                                        <div class="mt-1">
                                            <a class="">
                                                34.2k
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
                                            Md Abdur Rakib
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
                                            <a class="" href="#">
                                                @marcell_r1234
                                            </a>
                                        </div>
                                        <div class="mt-1">
                                            <i class="fas fa-check">
                                            </i>
                                            <a class="" href="#">
                                                @marcell_rtok
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="font-weight-bold">
                                            Follower
                                        </a>
                                        <br>
                                        <div class="mt-1">
                                            <a class="">
                                                123.9k
                                            </a>
                                        </div>
                                        <div class="mt-1">
                                            <a class="">
                                                34.2k
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
                                            Md Abdur Rakib
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
                                            <a class="" href="#">
                                                @marcell_r1234
                                            </a>
                                        </div>
                                        <div class="mt-1">
                                            <i class="fas fa-check">
                                            </i>
                                            <a class="" href="#">
                                                @marcell_rtok
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="font-weight-bold">
                                            Follower
                                        </a>
                                        <br>
                                        <div class="mt-1">
                                            <a class="">
                                                123.9k
                                            </a>
                                        </div>
                                        <div class="mt-1">
                                            <a class="">
                                                34.2k
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
                                </tbody>
                            </table>
                            {{--{!! $dataTable->table(['class' => 'table table-hover', 'style' => 'width: 100%;']) !!}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

{{--@section('style')
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
@stop--}}
