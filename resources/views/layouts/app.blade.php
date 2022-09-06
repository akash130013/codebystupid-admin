<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CodeByStupid') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
    @yield('css')
</head>

<body>
    <div class="container-fluid d-flex flex-column h-100 align-items-center px-0">

        <!-- <div class="container"> -->

        <div class="row grow w-100">
            <div class="col-12 bg-dark text-white py-3">
                @include('layouts.header')
            </div>
            <div class="col-1 bg-primary py-3 aside-bar">
                @include('layouts.aside')
            </div>
            <div class="main col-11 py-3">
                @yield('content')
            </div>
        </div>

        <footer class="container-fluid fixed-bottom w-100">
            <div class="row">
                <div class="col-12 py-3 bg-dark text-white">
                    Footer
                </div>
            </div>
        </footer>

    </div>
</body>

@yield('js')

</html>