<x-guest-layout> 

    <template v-if="route == '/home'">

        <div class="bg-white overflow-hidden sm:rounded-lg">
            <div class="p-6 sm:px-10 bg-white text-center">
            
                <div class="mt-0 text-2xl">
                    {{ $settings['judul'] }}
                </div>

                <div class="mt-6 text-gray-500 d-none d-sm-block">
                    {{ $settings['keterangan'] }}
                </div>

                <div class="mt-6 d-none d-sm-block">
                @auth
                    @role('Admin')
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary icon-left mr-2" style="width: 100px;">Dasbor</a>
                    @endrole
                    <a href="{{ url('/user/profile') }}" class="btn btn-outline-success icon-left mr-2" style="width: 100px;">Profil</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary icon-left mr-2" style="width: 100px;">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success icon-left mr-2" style="width: 100px;">Daftar</a>
                @endauth
                </div>
            </div>
        </div>

        <div class="row mt-4 fixed-top-c">
            <div class="col-12">
                <div class="card mb-0">
                <div class="card-body">
                    <ul class="nav nav-pills stts-tab">
                        <li class="nav-item">
                            <a class="nav-link active" @click="changeId('all')" data-id="all" href="#">Semua<span class="badge badge-white"></span></a>
                        </li>
                        @foreach ($kategori as $ket)
                            <li class="nav-item">
                                <a class="nav-link" @click="changeId({{ $ket->id }})" data-stts="{{ $ket->id }}" href="#">{{ $ket->nama }}<span class="badge badge-white"></span></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                </div>
            </div>
        </div>

        <template v-for="kat in filteredKategori">
            <div class="py-0 pb-3 px-0 sm:px-0">
                <h2 class="section-title">@{{ kat.nama }}</h2>
                <p class="section-lead">@{{ kat.keterangan }}</p>
            </div>

            <div class="overflow-hidden sm:rounded-lg">
                <div class="row">
                    <template v-for="app in kat.aplikasi">
                        <div class="col-6 col-sm-4 col-md-4 col-lg-3" :key="app.id">
                            <article class="article article-style-b">
                                <div class="article-header">
                                    <a target="_blank" :href="@auth app.base_url_sso @else app.base_url @endauth"><div class="article-image" :data-background="'{{ asset(Storage::url('')) }}' + '/' + app.path" :style="appBgImage(app.path)"></div></a>
                                    <div class="article-title">
                                        <h2><a target="_blank" :href="@auth app.base_url_sso @else app.base_url @endauth">@{{ app.nama }}</a></h2>
                                    </div>
                                </div>
                                <div class="article-details">
                                    <div class="article-title">
                                        <h2><a target="_blank" :href="@auth app.base_url_sso @else app.base_url @endauth">@{{ app.keterangan }}</a></h2>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </template>

    <template v-if="route == '/login'">
        <x-jet-authentication-card>
            <x-slot name="logo">
                <div style="text-align:center;">
                    <h1><i class="fas fa-sign-in-alt fa-3x"></i></h1>
                    {{-- <p>Banjarmasin Dalam Genggaman</p> --}}
                </div>
            </x-slot>

            <x-jet-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-jet-label value="{{ __('Email') }}" />
                    <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label value="{{ __('Password') }}" />
                    <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                        </a>
                    @endif

                    <x-jet-button class="ml-4" id="btn-simpan">
                        {{ __('Masuk') }}
                    </x-jet-button>

                </div>

                <div class="flex items-center justify-center mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" @click="changeRoute('/register')">
                        {{ __('Belum memiliki akun?') }}
                    </a>
                @endif
                </div>
            </form>
        </x-jet-authentication-card>
    </template>

    <template v-if="route == '/register'">
        <x-jet-authentication-card>
            <x-slot name="logo">
                <div style="text-align:center;">
                    <h1><i class="fas fa-user-plus fa-3x"></i></h1>
                    {{-- <p>Banjarmasin Dalam Genggaman</p> --}}
                </div>
            </x-slot>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-jet-label value="{{ __('Nama') }}" />
                    <x-jet-input class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-jet-label value="{{ __('Email') }}" />
                    <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <div class="mt-4">
                    <x-jet-label value="{{ __('Password') }}" />
                    <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-jet-label value="{{ __('Konfirmasi Password') }}" />
                    <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" @click="changeRoute('/login')">
                        {{ __('Sudah memiliki Akun?') }}
                    </a>

                    <x-jet-button class="ml-4" id="btn-simpan">
                        {{ __('Selesai') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
    </template>

    @auth    
    <template v-if="route == '/profile'">
        
        <div>
            <div class="max-w-7xl mx-auto py-0 sm:px-0 lg:px-0">
                @livewire('profile.update-profile-information-form')

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <x-jet-section-border />
                
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.update-password-form')
                    </div>
                @endif

                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            </div>
        </div>
            
    </template>
    @endauth
    <x-slot name="script">
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
            var route = localStorage.getItem("route") ? localStorage.getItem("route") : '/home';
            this.changeRoute(route);
        },
        methods: {
            changeId: function (id) {
                this.id_ket = id;
            },
            appBgImage(src) {
                let bgImage = "{{ asset(Storage::url('')) }}" + "/" + src;
                return {
                    backgroundImage: `url("${bgImage}")`,
                }
            },
            changeRoute: function (route) {
                this.route = route;
                localStorage.setItem("route", route);
                if (route == '/home') {
                    head = document.head || document.getElementsByTagName('head')[0],
                    style = document.createElement('style');
                    style.setAttribute("id", "style-home");
                    style.innerHTML = "@media (max-width: 767px) { .section > *:first-child {margin-top: 60px!important;} }";
                    head.appendChild(style);
                }
                else {
                    var style = document.getElementById("style-home");
                    if (style != null) {
                        style.remove();
                    }
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
            // jquery
            $(function() {
                $(document).on('click', '.stts-tab .nav-link', function (e) {
                    e.preventDefault();
                    $(this).parent().siblings().find('.nav-link').removeClass('active').find('.badge-white').removeClass('badge-white').addClass('badge-primary');
                    $(this).addClass('active').find('.badge-primary').removeClass('badge-primary').addClass('badge-white');
                }); 
            }); 
        </script>
    </x-slot>

</x-guest-layout>