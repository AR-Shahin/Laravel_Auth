<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
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
                    <li class="list-group-item"><a href="{{ route('crud.index') }}">Crud</a>
                    </li>
                    <li class="list-group-item"><a href="{{ route('auto-complete-search') }}">Auto Complete Search</a>
                    </li>
                    <li class="list-group-item"><a href="{{ route('user-check') }}">User Check</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('custom/custom.js') }}"></script>

    @stack('script')
</body>

</html>
