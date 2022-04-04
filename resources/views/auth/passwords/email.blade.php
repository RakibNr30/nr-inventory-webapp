@extends('auth.layouts.master')
@section('title', 'Reset Password')
@section('content')
    {{--
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Reset your forgotten password</p>
            {!! Form::open(['route' => 'password.email', 'method' => 'post']) !!}
            @if (session('status'))
                <div class="input-group mb-3">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
            <div class="input-group mb-3">
                <input id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" autofocus>
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
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>
            <p class="mb-1">
                <a href="{{ route('login') }}">Login to your account</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
            </p>
        </div>
    </div>
    --}}
@endsection
