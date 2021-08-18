@extends('layout.app')

@section('app_content')
<div class="row justify-content-center">
    <div class="col-6">
        <h2 class="text-center">Admin Forgot Pass</h2>
        <form action="{{ route('password.email') }}" method="post">
            @csrf
            @if(session('status'))
            <span class="text-success">{{ session('status') }}</span>
            @endisset

            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" value="user@mail.com" class="form-control" placeholder="Email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-success btn-block btn-sm">Send</button>
            </div>
            <a href="{{ route('admin.login') }}">Login</a>
        </form>
    </div>
</div>
@stop
