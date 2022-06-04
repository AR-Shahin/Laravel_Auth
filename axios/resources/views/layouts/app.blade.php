<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Axios with Laravel | @yield('title')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        ul {
            list-style: none;
        }

    </style>
    @stack('css')
</head>

<body>
    <div class="container-fluid">
        <h2 class="text-center my-2">Laravel With Axios</h2>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ route('auto-complete-search') }}">Auto Complete Search</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center text-info">@yield('project_title')</h3>
                        <hr>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"></script>
    <script>
        const $$ = (el) => document.querySelector(el);
        const log = (el = 'ok') => console.log(el);
    </script>
    @stack('script')
</body>

</html>
