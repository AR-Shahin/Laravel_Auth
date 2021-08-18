@extends('layout.app')

@section('app_content')
<div class="row justify-content-center">
    <div class="col-6">
        @if(session('status'))
        <span class="text-success">{{ session('status') }}</span>
        @endisset
        <h2 class="text-center">Admin Login</h2>
        <form action="{{ route('admin.authenticate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email"  class="form-control" placeholder="Email" value="admin@mail.com">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="text" name="password"class="form-control" placeholder="Password" value="password">
            </div>
            <div class="form-group">
                <label for="">Remember Me</label>
                <input type="checkbox" name="remember">
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-block btn-sm">Login</button>
            </div>
            <a href="{{ route('admin.register') }}">Register</a>
            <a href="{{ route('admin.password.request') }}">Forgot</a>
            <a href="{{ route('admin.dashboard') }}">Home</a>
        </form>
    </div>
</div>
@stop
