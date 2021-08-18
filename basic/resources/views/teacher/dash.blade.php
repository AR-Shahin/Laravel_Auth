<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Teacher Dashboard</h3>

    <form action="{{ route('teacher.logout') }}" method="POST">
    @csrf
    <button>Logout</button>
</form>
</body>
</html>
