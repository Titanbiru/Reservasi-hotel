<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        
        <footer class="bg-dark text-white py-4">
            <div class="container">

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold">Hotel Hebat</h5>
                        <p class="text-muted">Penginapan nyaman dengan fasilitas terbaik dan pelayanan profesional.</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold">Kontak</h5>
                        <ul class="list-unstyled text-muted">
                            <li>Alamat: Jalan Mawar No. 12</li>
                            <li>Telp: 021-5678-1234</li>
                            <li>Email: info@hotelhebat.com</li>
                        </ul>
                    </div>

                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold">Menu</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                            <li><a href="#tipe-kamar" class="text-white text-decoration-none">Tipe Kamar</a></li>
                            <li><a href="#fasilitas" class="text-white text-decoration-none">Fasilitas</a></li>
                            <li>
                                @guest
                                    <a href="{{ route('login') }}" class="text-white text-decoration-none">Login</a>
                                @else
                                    <a href="{{ route('reservation.create', 1) }}" class="text-white text-decoration-none">Reservasi</a>
                                @endguest
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="text-center text-muted pt-3 border-top mt-3 color-white">
                    <p style=color:white;>© {{ date('Y') }} Sistem Pemesanan Hotel — All Rights Reserved.</p>
                </div>

            </div>
        </footer>


    </div>
</body>
</html>
