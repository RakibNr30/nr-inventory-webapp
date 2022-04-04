@extends('admin.layouts.master')
@php
    $authUser = \Modules\Ums\Entities\User::find(auth()->user()->id);
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
                            <h3 class="card-title mt-1">Create User</h3>
                            <a href="{{ route('backend.ums.user.index') }}" type="button"
                               class="btn btn-success btn-sm text-white float-right">View User List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.user.store'), 'method' => 'user', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="first_name" class="@error('first_name') text-danger @enderror">First Name</label>
                                        <input id="first_name" name="first_name" value="{{ old('first_name') }}"
                                               type="text"
                                               class="form-control @error('first_name') is-invalid @enderror"
                                               placeholder="Enter first name" autofocus>
                                        @error('first_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="last_name" class="@error('last_name') text-danger @enderror">Last Name</label>
                                        <input id="last_name" name="last_name" value="{{ old('last_name') }}"
                                               type="text" class="form-control @error('last_name') is-invalid @enderror"
                                               placeholder="Enter last name" autofocus>
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
                                        <input id="username" name="username" value="{{ old('username') }}" type="text"
                                               class="form-control @error('username') is-invalid @enderror"
                                               placeholder="Enter username" autofocus>
                                        @error('username')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="gender" class="@error('gender') text-danger @enderror">Gender</label>
                                        <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                            <option value="">Select Gender</option>
                                            @foreach(config('core.genders') as $gender_key => $gender)
                                                <option
                                                        value="{{ $gender_key }}">{{ $gender }}</option>
                                            @endforeach
                                        </select>
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="@error('email') text-danger @enderror">Email</label>
                                        <input id="email" name="email" value="{{ old('email') }}" type="text"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Enter email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone" class="@error('phone') text-danger @enderror">Phone</label>
                                        <input id="phone" name="phone" value="{{ old('phone') }}" type="text"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               placeholder="Enter phone" autofocus>
                                        @error('phone')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password"
                                               class="@error('password') text-danger @enderror">Password</label>
                                        <input id="password" name="password" value="{{ old('password') }}"
                                               type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Enter password" autofocus>
                                        @error('password')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password_confirmation"
                                               class="@error('password_confirmation') text-danger @enderror">Confirm Password</label>
                                        <input id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"
                                               type="password"
                                               class="form-control @error('password_confirmation') is-invalid @enderror"
                                               placeholder="Re-enter password" autofocus>
                                        @error('password_confirmation')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="avatar" class="@error('avatar') text-danger @enderror">Avatar</label>
                                        <input id="avatar" name="avatar" value="{{ old('avatar') }}" type="file" class="form-control @error('avatar') is-invalid @enderror" placeholder="Select File" autofocus>
                                        @if(isset($user->avatar->name))
                                            <span class="invalid-feedback text-dark" role="alert"><strong>avatar: {{ $user->avatar->name }}</strong></span>
                                        @endif
                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="roles" class="@error('roles') text-danger @enderror">Roles</label>
                                        <select id="roles" name="roles[]"
                                                class="form-control select2 @error('roles') is-invalid @enderror" data-placeholder="Select Roles" multiple>
                                            @if($authUser->hasRole('Super Admin'))
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            @else
                                                @foreach($roles as $role)
                                                    @if($role->name != 'Super Admin')
                                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('roles')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12" id="teacher_type_container" style="display: none">
                                    <div class="form-group">
                                        <label for="teacher_type" class="@error('teacher_type') text-danger @enderror">Teacher Category</label>
                                        <select id="teacher_type" name="teacher_type"
                                                class="form-control @error('teacher_type') is-invalid @enderror">
                                            <option value="">Select Teacher Category</option>
                                            @foreach(config('core.teacher_types') as $teacher_type_key => $teacher_type)
                                                <option value="{{ $teacher_type_key }}">
                                                    {{ $teacher_type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('teacher_type')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                            <a href="{{ route('backend.ums.user.index') }}" type="button"
                               class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $('#roles').on('change', function () {
            var roles = $('#roles').val();
            if (roles.includes('Teacher')) {
                $('#teacher_type_container').css('display', 'block');
            } else {
                $('#teacher_type_container').css('display', 'none');
            }
        });
    </script>
@stop
