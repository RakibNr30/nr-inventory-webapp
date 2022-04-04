@extends('auth.layouts.master')
@section('title', 'Confirmation')
@section('content')
    {{--
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Enter your password before continue.</p>
            {!! Form::open(['route' => 'password.confirm', 'method' => 'post']) !!}
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
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Confirm Password</button>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="social-auth-links text-center mb-3">
                <p class="mb-1">- OR -</p>
                <p class="mb-0">
                    <a href="{{ route('password.request') }}">I forgot my password</a>
                </p>
            </div>
        </div>
    </div>
    --}}
@endsection
