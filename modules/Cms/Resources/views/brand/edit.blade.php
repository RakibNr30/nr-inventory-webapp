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
                            <h3 class="card-title mt-1">Edit Brand</h3>
                            <a href="{{ route('backend.cms.brand.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Brand List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.cms.brand.update', [$brand->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Company Details</h5>
                                    <hr>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="brand_name" class="@error('brand_name') text-danger @enderror">Brand Name</label>
                                        <input id="brand_name" name="brand_name" value="{{ old('brand_name') ?? $brand->additionalInfo->first_name ?? '' }}" type="text" class="form-control @error('brand_name') is-invalid @enderror" placeholder="Enter brand name" autofocus>
                                        @error('brand_name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="avatar" class="@error('avatar') text-danger @enderror">Upload Logo</label>
                                        <div class="custom-file">
                                            <input type="file" name="avatar" value="{{ old('avatar') }}" class="custom-file-input @error('avatar') is-invalid @enderror" id="customFile">
                                            <label class="custom-file-label font-weight-normal" for="customFile">Choose file</label>
                                        </div>
                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                        @if(isset($brand->avatar))
                                            <div class="image-output">
                                                <img src="{{ $brand->avatar->file_url }}">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="reporting_tool_link" class="@error('reporting_tool_link') text-danger @enderror">Reporting Tool Link</label>
                                        <input id="reporting_tool_link" name="reporting_tool_link" value="{{ old('reporting_tool_link') ?? $brand->reporting_tool_link }}" type="text" class="form-control @error('reporting_tool_link') is-invalid @enderror" placeholder="Enter reporting tool link" autofocus>
                                        @error('reporting_tool_link')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h5>Business Info</h5>
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="@error('name') text-danger @enderror">Name</label>
                                        <input id="name" name="name" value="{{ old('name') ?? $brand->businessInfo->name ?? '' }}"
                                               type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="Enter name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address" class="@error('address') text-danger @enderror">Address</label>
                                        <input id="address" name="address" value="{{ old('address') ?? $brand->businessInfo->address ?? '' }}"
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
                                        <label for="zip_code" class="@error('zip_code') text-danger @enderror">ZIP Code</label>
                                        <input id="zip_code" name="zip_code" value="{{ old('zip_code') ?? $brand->businessInfo->zip_code ?? '' }}"
                                               type="text"
                                               class="form-control @error('zip_code') is-invalid @enderror"
                                               placeholder="Enter ZIP code" autofocus>
                                        @error('zip_code')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city" class="@error('city') text-danger @enderror">City</label>
                                        <input id="city" name="city" value="{{ old('city') ?? $brand->businessInfo->city ?? '' }}"
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
                                        <label for="country_code" class="@error('country_code') text-danger @enderror">Country Code</label>
                                        <input id="country_code" name="country_code" value="{{ old('country_code') ?? $brand->businessInfo->country_code ?? '' }}"
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
                                        <label for="business_email" class="@error('business_email') text-danger @enderror">E-mail address</label>
                                        <input id="business_email" name="business_email" value="{{ old('business_email') ?? $brand->businessInfo->email ?? '' }}"
                                               type="text"
                                               class="form-control @error('business_email') is-invalid @enderror"
                                               placeholder="Enter email address" autofocus>
                                        @error('business_email')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile" class="@error('mobile') text-danger @enderror">Mobile</label>
                                        <input id="mobile" name="mobile" value="{{ old('mobile') ?? $brand->businessInfo->phone ?? '' }}"
                                               type="text"
                                               class="form-control @error('mobile') is-invalid @enderror"
                                               placeholder="Enter mobile" autofocus>
                                        @error('mobile')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vat_number" class="@error('vat_number') text-danger @enderror">VAT Number</label>
                                        <input id="vat_number" name="vat_number" value="{{ old('vat_number') ?? $brand->businessInfo->vat_number ?? '' }}"
                                               type="text"
                                               class="form-control @error('vat_number') is-invalid @enderror"
                                               placeholder="Enter VAT number" autofocus>
                                        @error('vat_number')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="registration_number" class="@error('registration_number') text-danger @enderror">Registration Number</label>
                                        <input id="registration_number" name="registration_number" value="{{ old('registration_number') ?? $brand->businessInfo->registration_number ?? '' }}"
                                               type="text"
                                               class="form-control @error('registration_number') is-invalid @enderror"
                                               placeholder="Enter registration number" autofocus>
                                        @error('registration_number')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <h5>Login Information</h5>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="@error('email') text-danger @enderror">Email</label>
                                        <input id="email" name="email" value="{{ old('email') ?? $brand->email ?? '' }}" type="text"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Enter email" autofocus readonly>
                                        @error('email')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                            <a href="{{ route('backend.cms.brand.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
