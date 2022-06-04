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
            <div class="card-body login-card-body" id="vue_app">
                <p class="register-box-msg">
                    Welcome! Create your free New Fluence Account to get started.
                </p>
                {!! Form::open(['route' => 'register', 'method' => 'post']) !!}
                <label class="d-block font-weight-bold">Registered as</label>
                <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                    <label class="btn btn-outline-secondary {{ old('login_as') ? (old('login_as') == 1 ? 'active' : '') : 'active' }}" v-on:click="changeValue(1)" style="cursor: pointer">
                        <input type="radio" name="login_as" id="option_a1" autocomplete="off" value="{{ 1 }}"
                            {{ old('login_as') ? (old('login_as') == 1 ? 'checked' : '') : 'checked' }}> Influencer
                    </label>
                    <label class="btn btn-outline-secondary {{ old('login_as') ? (old('login_as') == 2 ? 'active' : '') : '' }}" v-on:click="changeValue(2)" style="cursor: pointer">
                        <input type="radio" name="login_as" id="option_a2" autocomplete="off" value="{{ 2 }}"
                            {{ old('login_as') ? (old('login_as') == 2 ? 'checked' : '') : '' }}> Brand
                    </label>
                </div>
                <template v-if="nameToggle == 1">
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
                </template>
                <template v-if="nameToggle == 2">
                    <div class="input-group mb-3">
                        <input id="name" name="name" placeholder="Brand Name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </template>
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
                            <input class="custom-control-input" type="checkbox" name="terms_conditions" id="terms_conditions" v-model="check_terms_conditions" value="1" {{ old('terms_conditions') ? 'checked' : '' }}>
                            <label for="terms_conditions" class="checkbox-label">
                                I agree to the <a href="#">terms</a> & <a href="#">condition</a> and <a href="#">privacy policy</a>.
                            </label>
                        </div>
                        <div class="icheck-primary">
                            <input class="custom-control-input" type="checkbox" name="subscribe" id="subscribe" v-model="check_subscribe" value="1" {{ old('subscribe') ? 'checked' : '' }}>
                            <label for="subscribe" class="checkbox-label">
                                Subscribe to the <a href="#">newsletter</a>.
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" :disabled="!check_terms_conditions || !check_subscribe">Sign Up</button>
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


@section('style')
    <style>
        .active {
            background: #007bff !important;
            border-color: #fff !important;
        }
    </style>
@stop

@section('script')
    <script>
        new Vue({
            el: '#vue_app',
            data: {
                nameToggle: '{{ old('login_as') ? old('login_as') : 1 }}',
                check_terms_conditions: false,
                check_subscribe: false
            },
            methods: {
                changeValue(value) {
                    this.nameToggle = value;
                }
            }
        });
    </script>
@stop
