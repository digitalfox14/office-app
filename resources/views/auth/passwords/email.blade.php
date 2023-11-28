@extends('layouts.auth')

@section('content')
<div class="main-wrapper account-wrapper">
    <div class="account-page">
        <div class="account-center">
            <div class="account-box">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="account-logo">
                        <a href="#"><img src="/img/digi.png" alt=""></a>
                    </div>
                    <div class="form-group">
                        <label>Enter Your Email</label>
                        <input type="email" id="email" name="email" class="form-control" autofocus="">
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="form-group text-center">
                        <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
                    </div>
                    <div class="text-center register-link">
                        <a href="{{ route('login') }}">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
