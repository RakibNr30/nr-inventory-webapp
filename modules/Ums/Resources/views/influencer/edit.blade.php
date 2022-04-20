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
                            <h3 class="card-title mt-1">Edit Influencer</h3>
                            <a href="{{ route('backend.ums.influencer.index') }}" type="button"
                               class="btn btn-success btn-sm text-white float-right">View Influencer List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.influencer.update', [$user->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="">Profile Info</h5>
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="instagram_username" class="@error('instagram_username') text-danger @enderror">Username (Instagram)</label>
                                        <input id="instagram_username" name="instagram_username" value="{{ old('instagram_username') ?? $user->socialAccountInfo->instagram_username ?? '' }}"
                                               type="text"
                                               class="form-control @error('instagram_username') is-invalid @enderror"
                                               placeholder="Enter instagram username" autofocus>
                                        @error('instagram_username')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="instagram_followers" class="@error('instagram_followers') text-danger @enderror">Followers (Instagram)</label>
                                        <input id="instagram_followers" name="instagram_followers" value="{{ old('instagram_followers') ?? $user->socialAccountInfo->instagram_followers ?? '' }}"
                                               type="number" min="0"
                                               class="form-control @error('instagram_followers') is-invalid @enderror"
                                               placeholder="Enter instagram followers" autofocus>
                                        @error('instagram_followers')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tiktok_username" class="@error('tiktok_username') text-danger @enderror">Username (Tiktok)</label>
                                        <input id="tiktok_username" name="tiktok_username" value="{{ old('tiktok_username') ?? $user->socialAccountInfo->tiktok_username ?? '' }}"
                                               type="text"
                                               class="form-control @error('tiktok_username') is-invalid @enderror"
                                               placeholder="Enter tiktok username" autofocus>
                                        @error('tiktok_username')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tiktok_followers" class="@error('tiktok_followers') text-danger @enderror">Followers (Tiktok)</label>
                                        <input id="tiktok_followers" name="tiktok_followers" value="{{ old('tiktok_followers') ?? $user->socialAccountInfo->tiktok_followers ?? '' }}"
                                               type="number" min="0"
                                               class="form-control @error('tiktok_followers') is-invalid @enderror"
                                               placeholder="Enter tiktok followers" autofocus>
                                        @error('tiktok_followers')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" class="@error('first_name') text-danger @enderror">First Name</label>
                                        <input id="first_name" name="first_name" value="{{ old('first_name') ?? $user->additionalInfo->first_name ?? '' }}"
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
                                        <label for="last_name" class="@error('last_name') text-danger @enderror">Last Name</label>
                                        <input id="last_name" name="last_name" value="{{ old('last_name') ?? $user->additionalInfo->last_name ?? '' }}"
                                               type="text" class="form-control @error('last_name') is-invalid @enderror"
                                               placeholder="Enter last name" autofocus>
                                        @error('last_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="@error('phone') text-danger @enderror">Phone Number</label>
                                        <input id="phone" name="phone" value="{{ old('phone') ?? $user->phone ?? '' }}" type="text"
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
                                        <label for="gender" class="@error('gender') text-danger @enderror">Gender</label>
                                        <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                            <option value="">Select Gender</option>
                                            @foreach(config('core.genders') as $gender_key => $gender)
                                                <option
                                                    value="{{ $gender_key }}" {{ $gender_key == $user->additionalInfo->gender ? 'selected' : '' }}>{{ $gender }}</option>
                                            @endforeach
                                        </select>
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="categories" class="@error('categories') text-danger @enderror">Categories</label>
                                        <select id="categories" name="categories[]"
                                                class="form-control select2 @error('categories') is-invalid @enderror" data-placeholder="Select Categories" multiple>
                                            @foreach($influencerCategories as $category)
                                                <option value="{{ $category->id }}" {{ in_array($category->id, $user->categories) ? 'selected' : '' }}>{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('categories')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profile_grade" class="@error('profile_grade') text-danger @enderror">Profile Grade</label>
                                        <select id="profile_grade" name="profile_grade" class="form-control @error('profile_grade') is-invalid @enderror">
                                            <option value="">Select Grade</option>
                                            @foreach(config('core.profile_grades') as $profile_grade_key => $profile_grade)
                                                <option
                                                    value="{{ $profile_grade_key }}" {{ $profile_grade_key == $user->profile_grade ? 'selected' : '' }}>{{ $profile_grade }}</option>
                                            @endforeach
                                        </select>
                                        @error('profile_grade')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="avatar" class="@error('avatar') text-danger @enderror">Profile Image</label>
                                        <div class="custom-file">
                                            <input type="file" name="avatar" value="{{ old('avatar') }}" class="custom-file-input @error('avatar') is-invalid @enderror" id="customFile">
                                            <label class="custom-file-label font-weight-normal" for="customFile">Choose file</label>
                                        </div>
                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                        @if(isset($user->avatar))
                                            <div class="image-output">
                                                <img src="{{ $user->avatar->file_url }}">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{--<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="shipping_phone" class="@error('shipping_phone') text-danger @enderror">Shipping Phone Number</label>
                                        <input id="shipping_phone" name="shipping_phone" value="{{ old('shipping_phone') }}"
                                               type="text"
                                               class="form-control @error('shipping_phone') is-invalid @enderror"
                                               placeholder="Enter first name" autofocus>
                                        @error('shipping_phone')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>--}}

                                <div class="col-12">
                                    <hr>
                                    <h5>Shipping Info</h5>
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shipping_first_name" class="@error('shipping_first_name') text-danger @enderror">Shipping First Name</label>
                                        <input id="shipping_first_name" name="shipping_first_name" value="{{ old('shipping_first_name') ?? $user->shippingInfo->first_name ?? '' }}"
                                               type="text"
                                               class="form-control @error('shipping_first_name') is-invalid @enderror"
                                               placeholder="Enter shipping first name" autofocus>
                                        @error('shipping_first_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shipping_last_name" class="@error('shipping_last_name') text-danger @enderror">Shipping Last Name</label>
                                        <input id="shipping_last_name" name="shipping_last_name" value="{{ old('shipping_last_name') ?? $user->shippingInfo->last_name ?? '' }}"
                                               type="text"
                                               class="form-control @error('shipping_last_name') is-invalid @enderror"
                                               placeholder="Enter shipping first name" autofocus>
                                        @error('shipping_last_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address" class="@error('address') text-danger @enderror">Address</label>
                                        <input id="address" name="address" value="{{ old('address') ?? $user->shippingInfo->address ?? '' }}"
                                               type="text"
                                               class="form-control @error('address') is-invalid @enderror"
                                               placeholder="Enter address" autofocus>
                                        @error('address')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="extra_info" class="@error('extra_info') text-danger @enderror">Extra Info</label>
                                        <input id="extra_info" name="extra_info" value="{{ old('extra_info') ?? $user->shippingInfo->extra_info ?? '' }}"
                                               type="text"
                                               class="form-control @error('extra_info') is-invalid @enderror"
                                               placeholder="Enter extra info" autofocus>
                                        @error('extra_info')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="zip_code" class="@error('zip_code') text-danger @enderror">ZIP Code</label>
                                        <input id="zip_code" name="zip_code" value="{{ old('zip_code') ?? $user->shippingInfo->zip_code ?? '' }}"
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
                                        <label for="city" class="@error('city') text-danger @enderror">City</label>
                                        <input id="city" name="city" value="{{ old('city') ?? $user->shippingInfo->city ?? '' }}"
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
                                        <input id="country_code" name="country_code" value="{{ old('country_code') ?? $user->shippingInfo->country_code ?? '' }}"
                                               type="text"
                                               class="form-control @error('country_code') is-invalid @enderror"
                                               placeholder="Enter country code" autofocus>
                                        @error('country_code')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr>
                                    <h5>Login Info</h5>
                                    <hr>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="@error('email') text-danger @enderror">Email</label>
                                        <input id="email" name="email" value="{{ old('email') ?? $user->email ?? '' }}" type="text"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Enter email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{--<div class="col-md-6">
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
                                <div class="col-md-6">
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
                                </div>--}}

                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                            <a href="{{ route('backend.ums.influencer.index') }}" type="button"
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
@stop
