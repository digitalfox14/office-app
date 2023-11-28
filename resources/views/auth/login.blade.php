@extends('layouts.auth')

@section('content')
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="account-logo">
                            <a href="index.html"><img src="/img/digi.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Username or Email</label>
                            <input type="text" id="email" name="email" autofocus="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary account-btn">Login</button>
                        </div>
                        <div class="text-center register-link">
                            Don`t have an account? <a href="{{ route('register') }}">Register Now</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
