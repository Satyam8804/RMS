<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ str_replace('_', ' ', config('app.name', 'Laravel')) }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<style>
    #app{
        min-height:100vh;
        background-image: url('{{ asset('images/back.jpg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center center;
    }
</style>
<body >
    <div id="app">
        @include("components.navbar")
        <main class="py-4 ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        @include('components.messages')
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
