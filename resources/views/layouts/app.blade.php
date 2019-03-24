<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SILISA</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    SILISA
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Master</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('provinsi.index')}}">Master Provinsi</a>
                                    <a class="dropdown-item" href="{{route('kabupatenkota.index')}}">Master Kabupaten/Kota</a>
                                    <a class="dropdown-item" href="{{route('kecamatan.index')}}">Master Kecamatan</a>
                                    <a class="dropdown-item" href="{{route('desa.index')}}">Master Desa</a>
                                    <a class="dropdown-item" href="{{route('wilayah.index')}}">Master Wilayah</a>
                                    <a class="dropdown-item" href="{{route('area.index')}}">Master Area</a>
                                    <a class="dropdown-item" href="{{route('rayon.index')}}">Master Rayon</a>
                                    <a class="dropdown-item" href="{{route('potensi.index')}}">Master Potensi Energi</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listrik Masuk Desa</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('log')}}">Uploader Data</a>
                                    <a class="dropdown-item" href="{{route('info_data_desa.index')}}">Info Data Desa</a>
                                    <a class="dropdown-item" href="{{route('roadmap_silisa.index')}}">Road Map SILISA</a>
                                    <a class="dropdown-item" href="{{route('desa_prioritas.index')}}">Desa 3T</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Konfigurasi</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">User Management</a>
                                    <a class="dropdown-item" href="#">Role Management</a>
                                </div>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#">Batas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('desa.prioritas') }}">Desa Prioritas</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Info Data Desa</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('info.desa')}}">Info Desa</a>
                                    <a class="dropdown-item" href="{{route('info.desa_rt')}}">Info Desa RT</a>
                                    <a class="dropdown-item" href="{{route('info.desa_pembangkit')}}">Info Desa Pembangkit</a>
                                    <a class="dropdown-item" href="{{route('info.desa_potensi')}}">Info Desa Potensi Energi</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Roadmap LISA</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('roadmap.target')}}">Target</a>
                                    <a class="dropdown-item" href="{{route('roadmap.realisasi')}}">Realisasi</a>
                                </div>
                            </li> --}}
                        </ul>
                    @endauth
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('tambah') }}">Tambah</a>
                        </li> --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->NAMA_USER }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
    </div>

    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.all.min.js"></script>

    {{-- Toastr --}}
    <script>
        @if($errors->count() > 0)
            @foreach($errors->all() as $error)
                toastr.error("{{$error}}")
            @endforeach
        @endif
        @if(Session::has('success'))
            toastr.success("{{Session::get('success')}}")
        @endif
        @if(Session::has('error'))
            toastr.error("{{Session::get('error')}}")
        @endif
    </script>

    @yield('script')
</body>
</html>
