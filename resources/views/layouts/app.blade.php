<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Toko') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-3">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Toko') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav me-auto bg-light">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('home*') ? 'active bg-info rounded-2' : '' }}"
                                href="{{ route('home') }}"><i class="bi bi-house-door"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('cart*') ? 'active bg-info rounded-2' : '' }}"
                                href="{{ route('cart.index') }}"><i class="bi bi-cart4"></i> Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('history*') ? 'active bg-info rounded-2' : '' }}"
                                href="{{ route('history.index') }}"><i class="bi bi-clock-history"></i> History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('user-data*') ? 'active bg-info rounded-2' : '' }}"
                                href="{{ route('userData.edit') }}"><i class="bi bi-geo-alt"></i> Address & No Telp</a>
                        </li>
                        @can('admin-operation')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('product*') ? 'active bg-info rounded-2' : '' }}"
                                    href="{{ route('product.index') }}"><i class="bi bi-archive"></i> Manage Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('order*') ? 'active bg-info rounded-2' : '' }}"
                                    href="{{ route('order.index') }}"><i class="bi bi-box"></i> Manage Order</a>
                            </li>
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            @yield('searchByCategories')
                        @endauth
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

        <main class="container">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Pemberitahuan</strong> {{ session('status') }} <em>{{ date('Y-m-d H:i:s') }}</em>
                </div>

                <script>
                    var alertList = document.querySelectorAll('.alert');
                    alertList.forEach(function(alert) {
                        new bootstrap.Alert(alert)
                    })
                </script>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Peringatan</strong> {{ session('error') }} <em>{{ date('Y-m-d H:i:s') }}</em>
                </div>

                <script>
                    var alertList = document.querySelectorAll('.alert');
                    alertList.forEach(function(alert) {
                        new bootstrap.Alert(alert)
                    })
                </script>
            @endif
            <div class="row justify-content-evenly gap-4">
                @yield('content')
            </div>

        </main>

        <div class="p-5 mt-5" style="background: #eeeeee">
            <div class="container-fluid py-5 text-center">
                <h5 class="fw-bold">2023 &copy; {{ config('app.name', 'Toko') }}</h5>
                <p class="cfs-5 fs-5">
                    Pada tanggal 13 April 2023 salah satu dari murid SMKN 1 Cibinong dengan jurusan Rekayasa Perangkat Lunak sedang mengikuti Lomba 
                    Kompetensi Siswa. Lomba dengan bidang Web Technologies adalah bidang yang ia terima. Singkatnya para peserta lomba di bidang Web Technologies harus 
                    dapat menyelesaikan suatu website yaitu, website toko online. Secara umum, Waktu pengerjaan yang telah ditentukan tidaklah waktu yang cukup untuk menyelesaikan website toko online. 
                    Tetapi dalam waktu tujuh jam ia berhasil menyelesaikannya dan berakhir dalam kemenangan dan mendapatkan juara satu. 
                    Ini adalah website yang telah ia buat dalam waktu kurang lebih tujuh jam dan membawa ia ke tingkat provinsi.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
