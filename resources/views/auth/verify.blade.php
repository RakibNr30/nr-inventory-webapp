@extends('auth.layouts.master')
@section('title', 'Email Verification')
@section('content')
    {{--
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Email verification.</p>
            {!! Form::open(['route' => 'verification.resend', 'method' => 'post']) !!}
            @if (session('resent'))
                <div class="input-group mb-3">
                    <div class="alert alert-success" role="alert">
                        A fresh verification link has been sent to your email address.
                    </div>
                </div>
            @endif
            <div class="input-group mb-3">
                <p>Before proceeding, please check your email for a verification link.</p>
                <p>If you did not receive the email</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Click here to request another</button>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="social-auth-links text-center mb-3">
                <p class="mb-1">- OR -</p>
                <p class="mb-0">
                    <a href="{{ route('register') }}">Register for a new account.</a>
                </p>
            </div>
        </div>
    </div>
    --}}
@endsection
