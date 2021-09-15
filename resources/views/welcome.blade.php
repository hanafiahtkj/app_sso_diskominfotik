<x-guest-layout> 
    <x-slot name="header_content"></x-slot>

    <div class="bg-white overflow-hidden sm:rounded-lg">
        <div class="p-6 sm:px-10 bg-white text-center">
            <!-- <div class="d-none d-sm-block">
                <img src="{{ asset('img/logo.png') }}" width="225" height="51" class="d-inline-block align-top" alt="">
            </div> -->

            <div class="mt-0 text-2xl">
                {{ $settings['judul'] }}
            </div>

            <div class="mt-6 text-gray-500 d-none d-sm-block">
                {{ $settings['keterangan'] }}
            </div>

            <div class="mt-6">
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

    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills" id="stts-tab">
                    <li class="nav-item">
                        <a class="nav-link active" data-stts="all" href="#">Semua<span class="badge badge-white"></span></a>
                    </li>
                    @foreach ($kategori as $ket)
                        <li class="nav-item">
                            <a class="nav-link" data-stts="{{ $ket->id }}" href="#">{{ $ket->nama }}<span class="badge badge-white"></span></a>
                        </li>
                    @endforeach
                </ul>
            </div>
            </div>
        </div>
    </div>

    @foreach ($kategori as $ket)
        <div class="py-0 pb-3 px-0 sm:px-0">
            <h2 class="section-title">{{ $ket->nama }}</h2>
            <p class="section-lead">{{ $ket->keterangan }}</p>
        </div>

        <div class="overflow-hidden sm:rounded-lg">
            <div class="row">
            @foreach ($ket->aplikasi as $app)
                <div class="col-6 col-sm-4 col-md-4 col-lg-3">
                <article class="article article-style-b">
                    <div class="article-header">
                        <a target="_blank" href="{!! (Auth::check()) ? $app->base_url_sso : $app->base_url !!}"><div class="article-image" data-background="{{ asset(Storage::url($app->path)) }}" style="background-image: url(&quot;{{ asset(Storage::url($app->path)) }}&quot;);"></div></a>
                        <div class="article-title">
                            <h2><a target="_blank" href="{!! (Auth::check()) ? $app->base_url_sso : $app->base_url !!}">{{ $app->nama }}</a></h2>
                        </div>
                    </div>
                    <div class="article-details d-none d-md-block">
                    <p style="min-height: 84px;">{{ $app->keterangan }}</p>
                    <div class="article-cta">
                        <a target="_blank" href="{!! (Auth::check()) ? $app->base_url_sso : $app->base_url !!}">Masuk ke Aplikasi <i class="fas fa-chevron-right"></i></a>
                    </div>
                    </div>
                </article>
                </div>
            @endforeach
            </div>
    @endforeach

    <x-slot name="script">
        <script src="{{ asset('js/plugin.js') }}"></script>
        <script src="{{ asset('vendor/vuejs/vue.min.js') }}"></script>
        <script>
        // ----- VUE JS ----- //
        // let dataVue= {};
        // var app = new Vue({
        // el: '#app',
        // data: dataVue,
        // mounted () {
            
        // },
        // methods: {
            
        // });

        // jquery
        $(function() {
            $('#stts-tab .nav-link').on('click', function (e) {
                e.preventDefault();
                $('#stts-verif').val($(this).data('stts'));
                $('#stts-tab .nav-link').removeClass('active').find('.badge-white').removeClass('badge-white').addClass('badge-primary');
                $(this).addClass('active').find('.badge-primary').removeClass('badge-primary').addClass('badge-white');
                //$('#table-rtlh').DataTable().ajax.reload()
            }); 
        }); 
        </script>
    </x-slot>

</x-guest-layout>