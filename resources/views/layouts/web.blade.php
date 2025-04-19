<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>

    <!-- General CSS Files -->
    <link rel="shortcut icon" href="{{ asset('img/logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">

    <!-- CSS Libraries -->
    @yield('style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/stisla@2.3.0/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/stisla@2.3.0/assets/css/components.min.css">
    <style>
        body {
            font-size: 1.05rem !important;
        }

        .navbar-secondary .navbar-nav .nav-link,
        i {
            font-size: 1.05rem !important;
        }
    </style>
</head>

<body class="layout-3">



    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="{{ url('/', []) }}" class="navbar-brand sidebar-gone-hide">{{ env('APP_NAME') }}</a>
                <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar">
                    <i class="fas fa-bars"></i>
                </a>
                <div class="nav-collapse">
                    <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#profileModal">Profile
                                Peneliti</a>
                        </li>
                        <li class="nav-item active">
                            <a href="https://wa.me/+6285786444814" target="_blank" class="nav-link">Kontak Saya</a>
                        </li>
                    </ul>
                </div>
                <form class="form-inline ml-auto">
                    {{-- <ul class="navbar-nav">
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                        <input class="form-control" type="search" placeholder="Cari Materi.." aria-label="Search"
                            data-width="300">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div> --}}
                </form>
            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item {{ $menuActive == 'beranda' ? 'active' : '' }}">
                            <a href="{{ url('/', []) }}" class="nav-link">
                                <i class="fas fa-fire"></i>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li class="nav-item {{ $menuActive == 'kompetensi' ? 'active' : '' }}">
                            <a href="{{ url('/kompetensi', []) }}" class="nav-link">
                                <i class="fas fa-brain"></i>
                                <span>Kompetensi</span>
                            </a>
                        </li>
                        <li class="nav-item {{ $menuActive == 'materi' ? 'active' : '' }}">
                            <a href="{{ url('/materi', []) }}" class="nav-link">
                                <i class="fas fa-book"></i>
                                <span>Materi</span>
                            </a>
                        </li>
                        <li class="nav-item {{ $menuActive == 'kuis' ? 'active' : '' }}">
                            <a href="{{ url('/kuis', []) }}" class="nav-link">
                                <i class="fas fa-book-reader"></i>
                                <span>Kuis</span>
                            </a>
                        </li>
                        <li class="nav-item {{ $menuActive == 'kirim-tugas' ? 'active' : '' }}">
                            <a href="{{ url('/kirimtugas', []) }}" class="nav-link">
                                <i class="fas fa-edit"></i>
                                <span>Kirim Tugas</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('title')</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="{{ url('/', []) }}">Beranda</a></div>
                            @yield('breadcrumb')
                        </div>
                    </div>

                    <div class="section-body">
                        @yield('content')
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <p class="text-center">
                    Copyright &copy; {{ date('Y') }} By <a href="#"
                        target="_blank">{{ env('APP_NAME') }}</a>
                </p>
            </footer>
        </div>
    </div>

    <!-- Modal Profile Peneliti -->
    <x-profile-modal />

    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/stisla@2.3.0/assets/js/stisla.js"></script>

    <!-- Template JS File -->
    <script src="https://cdn.jsdelivr.net/npm/stisla@2.3.0/assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/stisla@2.3.0/assets/js/custom.js"></script>

    <!-- JS Libraies -->
    @include('sweetalert::alert')
</body>

</html>
