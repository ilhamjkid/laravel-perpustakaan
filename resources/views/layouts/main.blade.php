<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/css/dashboard.css">

    @if (Request::is('/'))
        <style>
            .element-dashboard:hover {
                border-radius: 0 !important;
                opacity: .8 !important;
            }

        </style>
    @endif

    <style>
        .nav-link.active {
            color: #198754 !important;
        }

    </style>
</head>

<body>

    @include('layouts.header')

    <div class="container-fluid">
        <div class="row">
            @include('layouts.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('container')
            </main>
        </div>
    </div>


    <script src="/js/bootstrap.js"></script>
    <script src="/js/feather.min.js"></script>
    <script>
        feather.replace({
            "aria-hidden": "true"
        });
    </script>
</body>

</html>
