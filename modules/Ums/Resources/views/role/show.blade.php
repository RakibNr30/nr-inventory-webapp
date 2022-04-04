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
                            <h3 class="card-title mt-1">Role Details</h3>
                            <a href="{{ route('backend.ums.role.index') }}" type="button"
                               class="btn btn-success btn-sm text-white float-right">View Role List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="@error('name') text-danger @enderror">Name</label>
                                        <input id="name" name="name" value="{{ $role->name ?: 'N/A'}}" type="text"
                                               class="form-control-plaintext" readonly>
                                        @error('name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                        <input id="description" name="description"
                                               value="{{ $role->description ?: 'N/A'}}" type="text"
                                               class="form-control-plaintext" readonly>
                                        @error('description')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="guard_name" class="@error('guard_name') text-danger @enderror">Guard Name</label>
                                        <input id="guard_name" name="guard_name" value="{{ $role->guard_name ?: 'N/A'}}"
                                               type="text" class="form-control-plaintext" readonly>
                                        @error('guard_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="permissions" class="@error('permissions') text-danger @enderror">Permissions</label>
                                        <p id="permissions">
                                            {{ implode(", ", $givenPermissions) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.ums.role.index') }}" type="button"
                               class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
