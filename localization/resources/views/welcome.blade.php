<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('language') }}" method="post">
        @csrf
        <select name="lan" id="">
            <option value="">Select Option</option>
            <option value="bn">Ban</option>
             <option value="en">Eng</option>
        </select>

        <button>Submit</button>
    </form>

    {{ __('text.title') }} <br>
    {{ trans_choice('text.apple',1) }} <br>
    {{ __('text.welcome',['name' => 'Shahin','flag' => 'omi']) }} <br>
    {{trans_choice('text.snacks',10,['test' => 'habiajbi']) }}
</body>
</html>
