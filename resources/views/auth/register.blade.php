@extends('layouts.auth')

@section('content')
<div class="main-wrapper  account-wrapper">
    <div class="account-page">
        <div class="account-center">
            <div class="account-box">
                <form method="POST" action="{{ route('register') }}" class="form-signin">
                    @csrf
                    <div class="account-logo">
                        <a href="#"><img src="/img/digi.png" alt=""></a>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control">
                    </div>
                    <div class="form-group checkbox">
                        <label>
                            <input type="checkbox"> I have read and agree the Terms &amp; Conditions
                        </label>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary account-btn" type="submit">Signup</button>
                    </div>
                    <div class="text-center login-link">
                        Already have an account? <a href="{{ route('login') }}">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
