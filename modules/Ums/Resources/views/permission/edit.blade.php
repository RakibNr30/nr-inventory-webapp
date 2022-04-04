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
                            <h3 class="card-title mt-1">Edit Permission</h3>
                            <a href="{{ route('backend.ums.permission.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Permission List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.permission.update', [$permission->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="@error('name') text-danger @enderror">Name</label>
                                            <input id="name" name="name" value="{{ old('name') ?: $permission->name }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                            <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter description">{{ old('description') ?: $permission->description }}</textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="guard_name" class="@error('guard_name') text-danger @enderror">GuardName</label>
                                            <select id="guard_name" name="guard_name" class="form-control @error('guard_name') is-invalid @enderror">
                                                <option value="">Select guard_name</option>
                                                <option value="1">option 1</option>
                                                <option value="2">option 2</option>
                                            </select>
                                            @error('guard_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="module_id" class="@error('module_id') text-danger @enderror">ModuleId</label>
                                            <select id="module_id" name="module_id" class="form-control @error('module_id') is-invalid @enderror">
                                                <option value="">Select module_id</option>
                                                <option value="1">option 1</option>
                                                <option value="2">option 2</option>
                                            </select>
                                            @error('module_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                            <a href="{{ route('backend.ums.permission.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
