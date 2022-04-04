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
                            <h3 class="card-title mt-1">Teacher's Priority Order</h3>
                            <a href="{{ route('backend.ums.user.index') }}" type="button"
                               class="btn btn-success btn-sm text-white float-right">View User List</a>
                        </div>
                        <div class="card-body">
                            <ul class="sort_items list-group">
                                @if($teachers->count())
                                    @foreach ($teachers as $index => $teacher)
                                        <li class="list-group-item" data-id="{{$teacher->id}}">
                                            <div class="row handle">
                                                <div class="col-6 text-center text-bold">
                                                    {{ $teacher->additionalInfo->first_name }}
                                                    {{ $teacher->additionalInfo->last_name }}
                                                </div>
                                                <div class="col-6 text-center">
                                                    {{ $teacher->email }}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.ums.user.index') }}" type="button"
                               class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('style')
    <style>
        .list-group-item {
            align-items: center;
            cursor: move;
        }
        .highlight {
            background: #f7e7d3;
            min-height: 30px;
            list-style-type: none;
        }
    </style>
@stop
@section('script')
    <script>
        $(document).ready(function(){
            function updateToDatabase(idString){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token()}}'
                    }
                });
                $.ajax({
                    url:'{{ route('backend.ums.user-priority.update') }}',
                    method:'POST',
                    data:{
                        ids:idString
                    },
                    success:function(){}
                })
            }
            var target = $('.sort_items');
            target.sortable({
                handle: '.handle',
                placeholder: 'highlight',
                axis: "y",
                update: function (e, ui){
                    var sortData = target.sortable('toArray',{ attribute: 'data-id'})
                    updateToDatabase(sortData.join(','))
                }
            })

        })
    </script>

@stop
