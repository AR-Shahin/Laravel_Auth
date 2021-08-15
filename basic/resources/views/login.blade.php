@extends('layout.app')

@section('app_content')
<div class="row justify-content-center">
    <div class="col-6">
        <h2 class="text-center">Login</h2>
        <form action="" method="post">
            @csrf
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="text" name="password"class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-block btn-sm">Login</button>
            </div>
            <a href="{{ route('register') }}">Register</a>
            <a href="{{ route('password.request') }}">Forgot</a>
        </form>
    </div>
</div>
@stop
