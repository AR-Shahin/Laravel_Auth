@extends('layout.app')

@section('app_content')
<div class="row justify-content-center">
    <div class="col-6">
        <h2 class="text-center">Forgot Pass</h2>
        <form action="{{ route('password.email') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
            </div>

            <div class="form-group">
                <button class="btn btn-success btn-block btn-sm">Send</button>
            </div>
            <a href="{{ route('login') }}">Login</a>
        </form>
    </div>
</div>
@stop
