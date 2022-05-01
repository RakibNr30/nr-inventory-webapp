@extends('auth.layouts.master')

@section('title')
    Register
@stop

@section('content')
    <div class="register-box step-2">
        <div class="card card-outline card-primary mb-2 mt-2">
            <div class="card-header text-center">
                <a class="h1" href="{{ url('/') }}">
                    <b>
                        {{ $global_site->title ?? '' }}
                    </b>
                </a>
            </div>
            <div class="card-body login-card-body">
                <p class="register-box-msg">
                    Before getting started we need more important information from you.
                </p>
                {!! Form::open(['route' => 'register.almost-ready.store', 'method' => 'post', 'files' => true]) !!}
                @if($user->hasRole("Influencer"))
                    <div class="row">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="col-12">
                            <p class="font-weight-bold">Social Media Info</p>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="instagram_username" name="instagram_username" placeholder="Instagram Username" value="{{ old('instagram_username') }}" type="text" class="form-control @error('instagram_username') is-invalid @enderror" required>
                                @error('instagram_username')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="tiktok_username" name="tiktok_username" placeholder="Tiktok Username" value="{{ old('tiktok_username') }}" type="text" class="form-control @error('tiktok_username') is-invalid @enderror" required>
                                @error('tiktok_username')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="font-weight-bold">Shipping Info</p>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input id="phone" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" type="text" class="form-control @error('phone') is-invalid @enderror" required>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="first_name" name="first_name" placeholder="Shipping First Name" value="{{ old('first_name') }}" type="text" class="form-control @error('first_name') is-invalid @enderror" required>
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="last_name" name="last_name" placeholder="Shipping Last Name" value="{{ old('last_name') }}" type="text" class="form-control @error('last_name') is-invalid @enderror" required>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="address" name="address" placeholder="Shipping Address" value="{{ old('address') }}" type="text" class="form-control @error('address') is-invalid @enderror" required>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="extra_info" name="extra_info" placeholder="Shipping Extra Info" value="{{ old('extra_info') }}" type="text" class="form-control @error('extra_info') is-invalid @enderror" required>
                                @error('extra_info')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="zip_code" name="zip_code" placeholder="ZIP Code" value="{{ old('zip_code') }}" type="text" class="form-control @error('zip_code') is-invalid @enderror" required>
                                @error('zip_code')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="city" name="city" placeholder="City" value="{{ old('city') }}" type="text" class="form-control @error('city') is-invalid @enderror" required>
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input id="country_code" name="country_code" placeholder="Country Code" value="{{ old('country_code') }}" type="text" class="form-control @error('country_code') is-invalid @enderror" required>
                                @error('country_code')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="font-weight-bold">Additional Info</p>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <select id="categories" name="categories[]"
                                        class="form-control select2 @error('categories') is-invalid @enderror" data-placeholder="Select Categories" multiple>
                                    @foreach($influencerCategories as $influencerCategorie)
                                        <option value="{{ $influencerCategorie->id }}">{{ $influencerCategorie->title }}</option>
                                    @endforeach
                                </select>
                                @error('categories')
                                <span class="invalid-feedback d-block"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <select id="gender" name="gender"
                                        class="form-control @error('gender') is-invalid @enderror">
                                    <option>Select Gender</option>
                                    @foreach(config('core.genders') as $key => $gender)
                                        <option value="{{ $key }}">{{ $gender }}</option>
                                    @endforeach
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="dob" name="dob" placeholder="DOB" value="{{ old('dob') }}" type="text" class="form-control datepicker @error('dob') is-invalid @enderror" required>
                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="avatar" class="@error('avatar') text-danger @enderror">Upload Photo</label>
                                <div class="custom-file">
                                    <input type="file" name="avatar" value="{{ old('avatar') }}" class="custom-file-input @error('avatar') is-invalid @enderror" id="customFile">
                                    <label class="custom-file-label font-weight-normal" for="customFile">Choose file</label>
                                </div>
                                @error('avatar')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                    </div>
                @endif
                @if($user->hasRole("Brand"))
                    <div class="row">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="col-12">
                            <p class="font-weight-bold">Company Details</p>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input id="brand_name" name="brand_name" placeholder="Brand Name" value="{{ old('brand_name') ?? $user->additionalInfo->first_name ?? '' }}" type="text" class="form-control @error('brand_name') is-invalid @enderror" readonly>
                                @error('brand_name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="font-weight-bold">Business Info</p>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input id="name" name="name" placeholder="Business Name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="address" name="address" placeholder="Business Address" value="{{ old('address') }}" type="text" class="form-control @error('address') is-invalid @enderror" required>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="zip_code" name="zip_code" placeholder="ZIP Code" value="{{ old('zip_code') }}" type="text" class="form-control @error('zip_code') is-invalid @enderror" required>
                                @error('zip_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="city" name="city" placeholder="City" value="{{ old('city') }}" type="text" class="form-control @error('city') is-invalid @enderror" required>
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="country_code" name="country_code" placeholder="Country Code" value="{{ old('country_code') }}" type="text" class="form-control @error('country_code') is-invalid @enderror" required>
                                @error('country_code')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="email" name="email" placeholder="E-mail Address" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="phone" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" type="text" class="form-control @error('phone') is-invalid @enderror" required>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="vat_number" name="vat_number" placeholder="VAT Number" value="{{ old('vat_number') }}" type="text" class="form-control @error('vat_number') is-invalid @enderror" required>
                                @error('vat_number')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="registration_number" name="registration_number" placeholder="Company Registration Number" value="{{ old('registration_number') }}" type="text" class="form-control @error('registration_number') is-invalid @enderror" required>
                                @error('registration_number')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="font-weight-bold">Additional Info</p>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="avatar" class="@error('avatar') text-danger @enderror">Upload Logo</label>
                                <div class="custom-file">
                                    <input type="file" name="avatar" value="{{ old('avatar') }}" class="custom-file-input @error('avatar') is-invalid @enderror" id="customFile">
                                    <label class="custom-file-label font-weight-normal" for="customFile">Choose file</label>
                                </div>
                                @error('avatar')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="icheck-primary">
                            <input class="custom-control-input" type="checkbox" name="terms_conditions" id="terms_conditions" value="1" {{ old('terms_conditions') ? 'checked' : '' }}>
                            <label for="terms_conditions" class="checkbox-label">
                                I agree to the <a href="#">terms</a> & <a href="#">condition</a> and <a href="#">privacy policy</a>.
                            </label>
                        </div>
                        <div class="icheck-primary">
                            <input class="custom-control-input" type="checkbox" name="subscribe" id="subscribe" value="1" {{ old('subscribe') ? 'checked' : '' }}>
                            <label for="subscribe" class="checkbox-label">
                                Subscribe to the <a href="#">newsletter</a>.
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Submit & get started</button>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="social-auth-links text-center mb-3">
                    <p class="mb-1">- OR -</p>
                    <p class="mb-0">
                        Already registered? <a href="{{ route('login') }}" class="text-center">Login Here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
