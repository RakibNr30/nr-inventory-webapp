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
                            <h3 class="card-title mt-1">User Details</h3>
                            <a href="{{ route('backend.ums.user.index') }}" type="button"
                               class="btn btn-success btn-sm text-white float-right">View User List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="first_name"
                                               class="@error('first_name') text-danger @enderror">First Name</label>
                                        <input id="first_name" name="first_name"
                                               value="{{ $user->additionalInfo->first_name ?: 'N/A'}}"
                                               type="text" class="form-control-plaintext" readonly>
                                        @error('first_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="last_name"
                                               class="@error('last_name') text-danger @enderror">Last Name</label>
                                        <input id="last_name" name="last_name"
                                               value="{{ $user->additionalInfo->last_name ?: 'N/A'}}"
                                               type="text" class="form-control-plaintext" readonly>
                                        @error('last_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="username"
                                               class="@error('username') text-danger @enderror">Username</label>
                                        <input id="username" name="username" value="{{ $user->username ?: 'N/A'}}"
                                               type="text" class="form-control-plaintext" readonly>
                                        @error('username')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="username"
                                               class="@error('username') text-danger @enderror">Username</label>
                                        <input id="username" name="username" value="{{ $user->username ?: 'N/A'}}"
                                               type="text" class="form-control-plaintext" readonly>
                                        @error('username')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="avatar"
                                               class="@error('avatar') text-danger @enderror">Avatar</label>
                                        <input id="avatar" name="avatar" value="{{ $user->avatar ?: 'N/A'}}" type="text"
                                               class="form-control-plaintext" readonly>
                                        @error('avatar')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone" class="@error('phone') text-danger @enderror">Phone</label>
                                        <input id="phone" name="phone" value="{{ $user->phone ?: 'N/A'}}" type="text"
                                               class="form-control-plaintext" readonly>
                                        @error('phone')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="@error('email') text-danger @enderror">Email</label>
                                        <input id="email" name="email" value="{{ $user->email ?: 'N/A'}}" type="text"
                                               class="form-control-plaintext" readonly>
                                        @error('email')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="roles" class="@error('roles') text-danger @enderror">Roles</label>
                                        <p id="roles">
                                            {{ implode(', ', $givenRoles) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
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
