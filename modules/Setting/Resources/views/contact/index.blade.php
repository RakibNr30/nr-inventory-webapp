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
                            <h3 class="card-title mt-1">Update Contact Info</h3>
                        </div>
                        {!! Form::open(['url' => route('backend.setting.contact.update', [$contact->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="@error('email') text-danger @enderror">Email</label>
                                        <input id="email" name="email" value="{{ old('email') ?: $contact->email }}" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone" class="@error('phone') text-danger @enderror">Phone</label>
                                        <input id="phone" name="phone" value="{{ old('phone') ?: $contact->phone }}" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone" autofocus>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mobile" class="@error('mobile') text-danger @enderror">Mobile</label>
                                        <input id="mobile" name="mobile" value="{{ old('mobile') ?: $contact->mobile }}" type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="Enter mobile" autofocus>
                                        @error('mobile')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fax" class="@error('fax') text-danger @enderror">Fax</label>
                                        <input id="fax" name="fax" value="{{ old('fax') ?: $contact->fax }}" type="text" class="form-control @error('fax') is-invalid @enderror" placeholder="Enter fax" autofocus>
                                        @error('fax')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="website" class="@error('website') text-danger @enderror">Website</label>
                                        <input id="website" name="website" value="{{ old('website') ?: $contact->website }}" type="text" class="form-control @error('website') is-invalid @enderror" placeholder="Enter website" autofocus>
                                        @error('website')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address" class="@error('address') text-danger @enderror">Address</label>
                                        <input id="address" name="address" value="{{ old('address') ?: $contact->address }}" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Enter address" autofocus>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="google_map" class="@error('google_map') text-danger @enderror">Google Map</label>
                                        <input id="google_map" name="google_map" value="{{ old('google_map') ?: $contact->google_map }}" type="text" class="form-control @error('google_map') is-invalid @enderror" placeholder="Enter google map url" autofocus>
                                        @error('google_map')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="longitude" class="@error('longitude') text-danger @enderror">Longitude</label>
                                        <input id="longitude" name="longitude" value="{{ old('longitude') ?: $contact->longitude }}" type="text" class="form-control @error('longitude') is-invalid @enderror" placeholder="Enter longitude" autofocus>
                                        @error('longitude')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="latitude" class="@error('latitude') text-danger @enderror">Latitude</label>
                                        <input id="latitude" name="latitude" value="{{ old('latitude') ?: $contact->latitude }}" type="text" class="form-control @error('latitude') is-invalid @enderror" placeholder="Enter latitude" autofocus>
                                        @error('latitude')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="facebook" class="@error('facebook') text-danger @enderror">Facebook</label>
                                        <input id="facebook" name="facebook" value="{{ old('facebook') ?: $contact->facebook }}" type="text" class="form-control @error('facebook') is-invalid @enderror" placeholder="Enter facebook" autofocus>
                                        @error('facebook')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="twitter" class="@error('twitter') text-danger @enderror">Twitter</label>
                                        <input id="twitter" name="twitter" value="{{ old('twitter') ?: $contact->twitter }}" type="text" class="form-control @error('twitter') is-invalid @enderror" placeholder="Enter twitter" autofocus>
                                        @error('twitter')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="linked_in" class="@error('linked_in') text-danger @enderror">Linked In</label>
                                        <input id="linked_in" name="linked_in" value="{{ old('linked_in') ?: $contact->linked_in }}" type="text" class="form-control @error('linked_in') is-invalid @enderror" placeholder="Enter linked in" autofocus>
                                        @error('linked_in')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="youtube" class="@error('youtube') text-danger @enderror">Youtube</label>
                                        <input id="youtube" name="youtube" value="{{ old('youtube') ?: $contact->youtube }}" type="text" class="form-control @error('youtube') is-invalid @enderror" placeholder="Enter youtube" autofocus>
                                        @error('youtube')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="instagram" class="@error('instagram') text-danger @enderror">Instagram</label>
                                        <input id="instagram" name="instagram" value="{{ old('instagram') ?: $contact->instagram }}" type="text" class="form-control @error('instagram') is-invalid @enderror" placeholder="Enter instagram" autofocus>
                                        @error('instagram')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="skype" class="@error('skype') text-danger @enderror">Skype</label>
                                        <input id="skype" name="skype" value="{{ old('skype') ?: $contact->skype }}" type="text" class="form-control @error('skype') is-invalid @enderror" placeholder="Enter skype" autofocus>
                                        @error('skype')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="whatsapp" class="@error('whatsapp') text-danger @enderror">Whatsapp</label>
                                        <input id="whatsapp" name="whatsapp" value="{{ old('whatsapp') ?: $contact->whatsapp }}" type="text" class="form-control @error('whatsapp') is-invalid @enderror" placeholder="Enter whatsapp" autofocus>
                                        @error('whatsapp')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="working_hours" class="@error('working_hours') text-danger @enderror">Working Hours</label>
                                        <input id="working_hours" name="working_hours" value="{{ old('working_hours') ?: $contact->working_hours }}" type="text" class="form-control @error('working_hours') is-invalid @enderror" placeholder="Enter working hours" autofocus>
                                        @error('working_hours')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="working_days" class="@error('working_days') text-danger @enderror">Working Days</label>
                                        <input id="working_days" name="working_days" value="{{ old('working_days') ?: $contact->working_days }}" type="text" class="form-control @error('working_days') is-invalid @enderror" placeholder="Enter working days" autofocus>
                                        @error('working_days')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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
