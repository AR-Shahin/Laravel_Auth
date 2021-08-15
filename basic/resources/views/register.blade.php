@extends('layout.app')

@section('app_content')
<div class="row justify-content-center">
    <div class="col-6">
        <h2 class="text-center">Register</h2>
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="text" name="password"class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="text" name="password_confirmation" class="form-control" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-block btn-sm">Register</button>
            </div>
            <a href="{{ route('login') }}">Login</a>
        </form>
    </div>
</div>
@stop
