<!DOCTYPE html>
<html lang="ID">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="/img/logo2.png">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <meta name="robots" content="index, follow">
        <meta name="description" content="Banjarmasin Pintar - Sebuah Aplikasi digital Pemerintah kota banjarmasin yang menampung semua aplikasi SKPD di lingkup kota banjarmasin. Sekaligus SSO (Single Sign On) dimana masyarakat dapat masuk ke semua aplikasi pelayanan publik dengan hanya satu kali pendaftaran atau hanya dengan satu akun.">
        <meta name="keywords" content="Banjarmasin Pintar, SSO Pemerintah kota Banjarmasin, Portal Aplikasi SKPD Pemerintah Kota Banjarmasin">
        <meta name="author" content="{{ url('') }}">
        <meta name="robots" content="all,index,follow">
        <meta http-equiv="Content-Language" content="id-ID">
        <meta NAME="Distribution" CONTENT="Global">
        <meta NAME="Rating" CONTENT="General">
        <link rel="canonical" href="{{ url('') }}"/>

        @isset($meta)
            {{ $meta }}
        @endisset

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@400;600;700&family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
        <link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/notyf/notyf.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
        <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all">
        <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all">

        <livewire:styles />
        <!-- Scripts -->
        <script defer src="{{ asset('vendor/alpine.js') }}"></script>

        @isset($style)
            {{ $style }}
        @endisset
    </head>
    <body class="layout-3">
        <div id="app">
            <div class="main-wrapper container">
                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        @isset($header_content)
                            {{ $header_content }}
                       @endisset
                      
                      <div class="section-body">
                        {{ $slot }}
                      </div>
                    </section>
                  </div>
            </div>
        </div>

        @stack('modals')

        <!-- General JS Scripts -->
        <script src="{{ asset('stisla/js/modules/jquery.min.js') }}"></script>
        <script defer async src="{{ asset('stisla/js/modules/popper.js') }}"></script>
        <script defer async src="{{ asset('stisla/js/modules/tooltip.js') }}"></script>
        <script src="{{ asset('stisla/js/modules/bootstrap.min.js') }}"></script>
        <script defer src="{{ asset('stisla/js/modules/jquery.nicescroll.min.js') }}"></script>
        <script defer src="{{ asset('stisla/js/modules/moment.min.js') }}"></script>
        <script defer src="{{ asset('stisla/js/modules/marked.min.js') }}"></script>
        <script defer src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>
        {{-- <script defer src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script> --}}
        <script defer src="{{ asset('stisla/js/modules/chart.min.js') }}"></script>
        <script defer src="{{ asset('vendor/select2/select2.min.js') }}"></script>

        <script src="{{ asset('stisla/js/stisla.js') }}"></script>
        <script src="{{ asset('stisla/js/scripts.js') }}"></script>

        <livewire:scripts />
        <script src="{{ mix('js/app.js') }}" defer></script>

        @isset($script)
            {{ $script }}
        @endisset
    </body>
</html>

