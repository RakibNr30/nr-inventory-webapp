@extends('auth.layouts.master')

@section('title')
    Login
@stop

@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary mb-2 mt-2">
            <div class="card-header text-center">
                <a class="h1" href="{{ url('/') }}">
                    <b>
                        {{ $global_site->title ?? '' }}
                    </b>
                </a>
            </div>
            <div class="card-body login-card-body">
                @include('admin.partials._alert')
                <p class="login-box-msg">
                    Welcome back! Log in to your account to view your dashboard
                </p>
                {!! Form::open(['route' => 'login', 'method' => 'post']) !!}
                <div class="input-group mb-3">
                    <input id="email" name="email" placeholder="E-mail" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" autofocus>
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
                    <input id="password" name="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
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
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="checkbox-label">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="{{ route('register') }}" class="btn btn-block btn-danger">
                        Register a new account
                    </a>
                </div>

                <p class="mt-2">
                    <a href="{{ route('password.request') }}">I forgot my password</a>
                </p>
            </div>
        </div>
    </div>
@stop
