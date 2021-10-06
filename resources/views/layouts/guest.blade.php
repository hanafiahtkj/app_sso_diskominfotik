<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        @isset($style)
            {{ $style }}
        @endisset

        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        
    </head>
    <body class="layout-3">
        <div id="app">
            <div class="main-wrapper container">
                @include('components.navbar')
                @include('components.sidebar')

                <!-- Main Content -->
                <div class="main-content" id="app">
                    <section class="section">
                        @isset($header_content)
                            {{ $header_content }}
                        @endisset
                      
                      <div class="section-body">
                        {{ $slot }}
                      </div>
                    </section>
                  </div>
                  
                  <footer class="main-footer">
                        <div class="footer-left d-none d-md-block">
                        <p>© Designed by <a href="https://getstisla.com/" rel="nofollow">Stisla</a> || Develoved by Diskominfotik Kota Banjarmsin</p>
                    </div>
                  </footer>
                  
                  @include('components.navbar-bottom')

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
        <script defer src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
        <script defer src="{{ asset('stisla/js/modules/chart.min.js') }}"></script>
        <script defer src="{{ asset('vendor/select2/select2.min.js') }}"></script>

        <script src="{{ asset('stisla/js/stisla.js') }}"></script>
        <script src="{{ asset('stisla/js/scripts.js') }}"></script>

        <livewire:scripts />

        <script src="{{ mix('js/app.js') }}" defer></script>

        <script src="{{ asset('js/plugin.js') }}"></script>

        @isset($script)
            {{ $script }}
        @endisset

        <script src="{{ asset('js/plugin.js') }}"></script>
        <script src="{{ asset('vendor/vuejs/vue.min.js') }}"></script>
        <script>
        
            // ----- VUE JS ----- //
            let dataVue= {
                id_ket : 'all',
                kategori : @json($kategori),
                // route  : '/home',
            };

            console.log(dataVue);
            
            var app = new Vue({
                el: '#app',
                data: dataVue,
                mounted () {
                    // var route = localStorage.getItem("route") ? localStorage.getItem("route") : this.route;
                    // this.changeRoute(route);
                },
                methods: {
                    changeId: function (id) {
                        this.id_ket = id;
                        //this.changeRoute('/apps');
                    },
                    appBgImage(src) {
                        let bgImage = "{{ asset(Storage::url('')) }}" + "/" + src;
                        return {
                            backgroundImage: `url("${bgImage}")`,
                        }
                    },
                    // changeRoute: function (route, reload = false) {
                        // this.route = route;
                        // localStorage.setItem("route", route);

                        // var style = document.getElementById("style-home");
                        // if (style != null) {
                        //     style.remove();
                        // }

                        // head = document.head || document.getElementsByTagName('head')[0],
                        // style = document.createElement('style');
                        // style.setAttribute("id", "style-home");

                        // if (route == '/apps') {
                        //     style.innerHTML = "@media (max-width: 767px) { .section > *:first-child {margin-top: 70px!important;} }";
                        //     head.appendChild(style);
                        // }
                        // else {
                        //     style.innerHTML = "@media (max-width: 767px) { .section > *:first-child {margin-top: 18px!important;} }";
                        //     head.appendChild(style);
                        // }
                    // },
                },
                computed: {
                    filteredKategori() {
                        let tempKategori = this.kategori
                        tempKategori = tempKategori.filter((item) => {
                            return ((item.id == this.id_ket) || (this.id_ket == 'all'))
                        })
                        return tempKategori;
                    }
                }
            });
        </script>
    
    </body>
</html>

