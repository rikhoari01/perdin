@extends('layout')
@section('title', 'Login | Perdinku')

@section('body')
<div class="login-section">
    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('img/Logo.png') }}" alt="logo">
        </div>
        <form action="{{ route('authenticate') }}" method="post" class="form-login">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="username">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
                <i class="fa fa-eye show-password"></i>
            </div>

            <button type="submit" class="btn-login">LOGIN</button>
        </form>

        <div class="forgot-password">
            <a href="">Lupa Password?</a>
        </div>
    </div>
</div>

@include('toast')
@endsection