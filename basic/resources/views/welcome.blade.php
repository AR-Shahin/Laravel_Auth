<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
<div class="row justify-content-center">
    <div class="col-6">
        <h2 class="text-center">Register</h2>
        <form action="" method="post">
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
        </form>
    </div>
</div>
    </body>
</html>
