@extends('auth.layouts.master')

@section('title')
    Register
@stop

@section('content')
    <div class="register-box">
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
                    Welcome! Create your free New Fluence Account to get started.
                </p>
                {!! Form::open(['route' => 'register', 'method' => 'post']) !!}
                <div class="input-group mb-3">
                    <input id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" type="text" class="form-control @error('first_name') is-invalid @enderror" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" type="text" class="form-control @error('last_name') is-invalid @enderror" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{--<div class="input-group mb-3">
                    <input id="username" name="username" placeholder="Enter username" value="{{ old('username') }}" type="text" class="form-control @error('username') is-invalid @enderror" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-key"></span>
                        </div>
                    </div>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="phone" name="phone" placeholder="Enter phone" value="{{ old('phone') }}" type="text" class="form-control @error('phone') is-invalid @enderror" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>--}}
                <div class="input-group mb-3">
                    <input id="email" name="email" placeholder="E-mail" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="email_confirmation" name="email_confirmation" placeholder="E-mail (re-enter)" value="{{ old('email_confirmation') }}" type="email" class="form-control @error('email_confirmation') is-invalid @enderror" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="password" name="password" placeholder="Enter password" type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="password_confirmation" name="password_confirmation" placeholder="Password (re-enter)" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" required autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="icheck-primary">
                            <input class="custom-control-input" type="checkbox" name="terms_conditions" id="terms_conditions" {{ old('terms_conditions') ? 'checked' : '' }}>
                            <label for="terms_conditions" class="checkbox-label">
                                I agree to the <a href="#">terms</a> & <a href="#">condition</a> and <a href="#">privacy policy</a>.
                            </label>
                        </div>
                        <div class="icheck-primary">
                            <input class="custom-control-input" type="checkbox" name="subscribe" id="subscribe" {{ old('subscribe') ? 'checked' : '' }}>
                            <label for="subscribe" class="checkbox-label">
                                Subscribe to the <a href="#">newsletter</a>.
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
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
