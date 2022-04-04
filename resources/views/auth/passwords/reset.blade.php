@extends('auth.layouts.master')
@section('title', 'Reset Password')
@section('content')
    {{--
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Reset your forgotten password.</p>
            {!! Form::open(['route' => 'password.update', 'method' => 'post']) !!}
            <input id="token" name="token" type="hidden" value="{{ $token }}">
            <div class="input-group mb-3">
                <input id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" required>
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
                <input id="password_confirmation" name="password_confirmation" placeholder="Re-enter password" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" required autocomplete="current-password">
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
                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
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
    --}}
@endsection
