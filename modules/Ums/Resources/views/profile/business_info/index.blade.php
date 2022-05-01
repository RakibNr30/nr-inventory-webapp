@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('admin.partials._profile_menu', ['active' => 2])
                </div>
                <div class="col-md-9">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Update your business information</h3>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.profile-business-info.update', [$userBusinessInfo->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="@error('name') text-danger @enderror">Business
                                            Name</label>
                                        <input id="name" name="name"
                                               value="{{ old('name') ?: $userBusinessInfo->name }}"
                                               type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="Enter business name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address"
                                               class="@error('address') text-danger @enderror">
                                            Address
                                        </label>
                                        <input id="address" name="address"
                                               value="{{ old('address') ?: $userBusinessInfo->address }}"
                                               type="text"
                                               class="form-control @error('address') is-invalid @enderror"
                                               placeholder="Enter address" autofocus>
                                        @error('address')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="zip_code"
                                               class="@error('zip_code') text-danger @enderror">
                                            Zip Code
                                        </label>
                                        <input id="zip_code" name="zip_code"
                                               value="{{ old('zip_code') ?: $userBusinessInfo->zip_code }}"
                                               type="text"
                                               class="form-control @error('zip_code') is-invalid @enderror"
                                               placeholder="Enter zip code" autofocus>
                                        @error('zip_code')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city" class="@error('city') text-danger @enderror">
                                            City
                                        </label>
                                        <input id="city" name="city"
                                               value="{{ old('city') ?: $userBusinessInfo->city }}"
                                               type="text"
                                               class="form-control @error('city') is-invalid @enderror"
                                               placeholder="Enter city" autofocus>
                                        @error('city')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country_code"
                                               class="@error('country_code') text-danger @enderror">
                                            Country Code
                                        </label>
                                        <input id="country_code" name="country_code"
                                               value="{{ old('country_code') ?: $userBusinessInfo->country_code }}"
                                               type="text"
                                               class="form-control @error('country_code') is-invalid @enderror"
                                               placeholder="Enter country code" autofocus>
                                        @error('country_code')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email"
                                               class="@error('email') text-danger @enderror">
                                            E-mail
                                        </label>
                                        <input id="email" name="email"
                                               value="{{ old('email') ?: $userBusinessInfo->email }}"
                                               type="text"
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
                                        <label for="phone"
                                               class="@error('phone') text-danger @enderror">
                                            Phone Number
                                        </label>
                                        <input id="phone" name="phone"
                                               value="{{ old('phone') ?: $userBusinessInfo->phone }}"
                                               type="text"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               placeholder="Enter phone" autofocus>
                                        @error('phone')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vat_number"
                                               class="@error('vat_number') text-danger @enderror">
                                            Vat Number
                                        </label>
                                        <input id="vat_number" name="vat_number"
                                               value="{{ old('vat_number') ?: $userBusinessInfo->vat_number }}"
                                               type="text"
                                               class="form-control @error('vat_number') is-invalid @enderror"
                                               placeholder="Enter vat number" autofocus>
                                        @error('vat_number')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="registration_number"
                                               class="@error('registration_number') text-danger @enderror">
                                            Registration Number
                                        </label>
                                        <input id="registration_number" name="registration_number"
                                               value="{{ old('registration_number') ?: $userBusinessInfo->registration_number }}"
                                               type="text"
                                               class="form-control @error('registration_number') is-invalid @enderror"
                                               placeholder="Enter registration number" autofocus>
                                        @error('registration_number')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
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
