<x-guest-layout> 

    <div v-show ="route == '/home'">
        <livewire:home /> 
    </div>

    <template v-if="route == '/apps'">
        <livewire:apps /> 
    </template>

    <template v-if="route == '/login'">
        <livewire:login /> 
    </template>

    <template v-if="route == '/register'">
        <livewire:register />
    </template>

    @auth    
    <div v-show ="route == '/profile'">
        <livewire:profile />
    </div>
    @endauth

    <x-slot name="style">
        <link rel="stylesheet" href="{{ asset('vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}">
    </x-slot>

    <x-slot name="script">
        <script src="{{ asset('vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/plugin.js') }}"></script>
        <script src="{{ asset('vendor/vuejs/vue.min.js') }}"></script>
        <script>
        
        // ----- VUE JS ----- //
        let dataVue= {
            id_ket : 'all',
            kategori : @json($kategori),
            route  : '/home',
        };

        console.log(dataVue);

        @if (request('r'))
            localStorage.setItem("route", '/home');
            window.history.pushState({}, 'Aplikasi Dalam Genggaman', '{{ url('/') }}');
        @endif
        
        var app = new Vue({
            el: '#app',
            data: dataVue,
            mounted () {
                var route = localStorage.getItem("route") ? localStorage.getItem("route") : this.route;
                this.changeRoute(route);
            },
            methods: {
                changeId: function (id) {
                    this.id_ket = id;
                    this.changeRoute('/apps');
                },
                appBgImage(src) {
                    let bgImage = "{{ asset(Storage::url('')) }}" + "/" + src;
                    return {
                        backgroundImage: `url("${bgImage}")`,
                    }
                },
                changeRoute: function (route, reload = false) {
                    this.route = route;
                    localStorage.setItem("route", route);

                    var style = document.getElementById("style-home");
                    if (style != null) {
                        style.remove();
                    }

                    head = document.head || document.getElementsByTagName('head')[0],
                    style = document.createElement('style');
                    style.setAttribute("id", "style-home");

                    if (route == '/apps') {
                        style.innerHTML = "@media (max-width: 767px) { .section > *:first-child {margin-top: 70px!important;} }";
                        head.appendChild(style);
                    }
                    else {
                        style.innerHTML = "@media (max-width: 767px) { .section > *:first-child {margin-top: 18px!important;} }";
                        head.appendChild(style);
                    }
                },
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
        <script>
            $(function() {
                $(document).on('click', '.stts-tab .nav-link', function (e) {
                    e.preventDefault();
                    $(this).parent().siblings().find('.nav-link').removeClass('active').find('.badge-white').removeClass('badge-white').addClass('badge-primary');
                    $(this).addClass('active').find('.badge-primary').removeClass('badge-primary').addClass('badge-white');
                }); 

                $("#berita-carousel").owlCarousel({
                    items: 12,
                    margin: 20,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    loop: true,
                    responsive: {
                        0: {
                            items: 2
                        },
                        578: {
                            items: 3
                        },
                        768: {
                            items: 4
                        }
                    }
                });
            }); 
        </script>
    </x-slot>

</x-guest-layout>