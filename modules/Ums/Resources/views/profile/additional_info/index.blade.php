@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('admin.partials._profile_menu', ['active' => 0])
                </div>
                <div class="col-md-9">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Update your additional information</h3>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.profile-additional-info.update', [$userAdditionalInfo->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" class="@error('first_name') text-danger @enderror">First
                                            Name</label>
                                        <input id="first_name" name="first_name"
                                               value="{{ old('first_name') ?: $userAdditionalInfo->first_name }}"
                                               type="text"
                                               class="form-control @error('first_name') is-invalid @enderror"
                                               placeholder="Enter first name" autofocus>
                                        @error('first_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name" class="@error('last_name') text-danger @enderror">Last
                                            Name</label>
                                        <input id="last_name" name="last_name"
                                               value="{{ old('last_name') ?: $userAdditionalInfo->last_name }}"
                                               type="text" class="form-control @error('last_name') is-invalid @enderror"
                                               placeholder="Enter last name" autofocus>
                                        @error('last_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                @if(!\App\Helpers\AuthManager::isBrand())
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="designation" class="@error('designation') text-danger @enderror">Designation</label>
                                            <input id="designation" name="designation"
                                                   value="{{ old('designation') ?: $userAdditionalInfo->designation }}"
                                                   type="text" class="form-control @error('designation') is-invalid @enderror"
                                                   placeholder="Enter designation" autofocus>
                                            @error('designation')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about" class="@error('about') text-danger @enderror">About</label>
                                        <textarea id="about" name="about" rows="3"
                                                  class="form-control @error('about') is-invalid @enderror"
                                                  placeholder="Enter about yourself">{{ old('about') ?: $userAdditionalInfo->about }}</textarea>
                                        @error('about')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                @if(!\App\Helpers\AuthManager::isBrand())
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gender"
                                                   class="@error('gender') text-danger @enderror">Gender</label>
                                            <select id="gender" name="gender"
                                                    class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Select Gender</option>
                                                @foreach(config('core.genders') as $gender_key => $gender)
                                                    <option
                                                        value="{{ $gender_key }}" {{ $gender_key == $userAdditionalInfo->gender ? 'selected' : '' }}>{{ $gender }}</option>
                                                @endforeach
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dob" class="@error('dob') text-danger @enderror">Date of
                                                Birth</label>
                                            <input id="dob" name="dob" value="{{ old('dob') ?: $userAdditionalInfo->dob }}"
                                                   type="text" class="form-control datepicker @error('dob') is-invalid @enderror"
                                                   placeholder="Enter dob" autofocus>
                                            @error('dob')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="blood_group" class="@error('blood_group') text-danger @enderror">Blood
                                                Group</label>
                                            <select id="blood_group" name="blood_group"
                                                    class="form-control @error('blood_group') is-invalid @enderror">
                                                <option value="">Select Blood Group</option>
                                                @foreach(config('core.blood_groups') as $blood_group_key => $blood_group)
                                                    <option
                                                        value="{{ $blood_group_key }}" {{ $blood_group_key == $userAdditionalInfo->blood_group ? 'selected' : '' }}>{{ $blood_group }}</option>
                                                @endforeach
                                            </select>
                                            @error('blood_group')
                                            <span class="invalid-feedback"
                                                  role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
