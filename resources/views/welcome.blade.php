<x-guest-layout> 
    <x-slot name="header_content"></x-slot>

    <div class="bg-white overflow-hidden sm:rounded-lg">
        <div class="p-6 sm:px-10 bg-white">
            <div class="d-none d-sm-block">
                <img src="{{ asset('img/logo.png') }}" width="225" height="51" class="d-inline-block align-top" alt="">
            </div>

            <div class="mt-6 text-2xl">
                {{ $settings['judul'] }}
            </div>

            <div class="mt-6 text-gray-500 d-none d-sm-block">
                {{ $settings['keterangan'] }}
            </div>

            <div class="mt-6">
            @auth
                <a href="{{ url('/user/profile') }}" class="btn btn-outline-warning icon-left mr-2">Profil</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary icon-left mr-2" style="width: 100px;">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-success icon-left mr-2" style="width: 100px;">Register</a>
            @endauth
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
                        <div class="article-image" data-background="{{ asset(Storage::url($app->path)) }}" style="background-image: url(&quot;{{ asset(Storage::url($app->path)) }}&quot;);">
                        </div>
                        <div class="article-title">
                            <h2><a target="_blank" href="{!! (Auth::check()) ? $app->base_url_sso : $app->base_url !!}">{{ $app->nama }}</a></h2>
                        </div>
                    </div>
                    <div class="article-details d-none d-md-block">
                    <p style="min-height: 120px;">{{ $app->keterangan }}</p>
                    <div class="article-cta">
                        <a target="_blank" href="{!! (Auth::check()) ? $app->base_url_sso : $app->base_url !!}">Masuk ke Aplikasi <i class="fas fa-chevron-right"></i></a>
                    </div>
                    </div>
                </article>
                </div>
            @endforeach
            </div>
    @endforeach

</x-guest-layout>