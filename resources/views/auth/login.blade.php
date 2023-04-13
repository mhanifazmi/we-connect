@extends('auth.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div>
                            <a class="logo" href="{{ route('index') }}">
                                <img class="img-fluid for-light" src="{{ asset('assets/images/logo/logo.png') }}"
                                    alt="looginpage">
                                <img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}"
                                    alt="looginpage">
                            </a>
                        </div>
                        <div class="login-main">
                            <form class="theme-form" action="{{ route('login') }}" method="POST">
                                @csrf
                                <h4>Sign in to account</h4>
                                <p>Enter your username & password to login</p>
                                <div class="form-group">
                                    <label class="col-form-label">Username</label>
                                    <input name="name" class="form-control" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required
                                        placeholder="*********">
                                    <div class="show-hide" style="top: 70%"><span class="show"> </span></div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox">
                                        <label class="text-muted" for="checkbox1">Remember password</label>
                                    </div>
                                    <a class="link" href="{{ route('password.request') }}">Forgot password?</a>
                                    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
