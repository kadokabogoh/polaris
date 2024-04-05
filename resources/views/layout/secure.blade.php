<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Anaheim">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('images/icon.ico') }}" />

    <meta name="theme-color" content="#7952b3">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/secure/main.css') }}" rel="stylesheet" />
    @yield('styles')
</head>
<body>

<main>
    <header class="py-3 mb-4 border-bottom">

        <div class="container d-flex flex-wrap justify-content-center">
            <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <img src="{{ asset('images/logo.png') }}" alt="logo" />
                <span class="fs-4 p-1 text-logo">POLARIS</span>
            </a>

        </div>

    </header>
    <nav class="py-2 bg-light border-bottom">
        <div class="container d-flex flex-wrap">
            <ul class="nav me-auto">
                <li class="nav-item"><a href="{{ route('secure.home.index') }}" class="nav-link link-dark px-2 active" aria-current="page">Beranda</a></li>
            </ul>
            <ul class="nav">
                <li class="nav-item"><a href="{{ route('secure.home.logout') }}" class="nav-link link-dark px-2">Logout</a></li>
            </ul>
        </div>
    </nav>

</main>

<main class="flex-shrink-0">
    <div class="container-fluid">
        @yield('content')
    </div>
</main>

<script src="{{ asset('js/secure/main.js') }}" type="application/javascript"></script>
@yield('scripts')
</body>
</html>
