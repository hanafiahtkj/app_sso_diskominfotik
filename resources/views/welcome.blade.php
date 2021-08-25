<x-guest-layout>
    <x-slot name="header_content"></x-slot>

    <!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <x-jet-welcome />
    </div> -->

    <!-- <x-jet-welcome/> -->

    <div class="bg-white overflow-hidden sm:rounded-lg">
        <div class="p-6 sm:px-10 bg-white border-b border-gray-200">
            <div>
                <x-jet-application-logo class="block h-12 w-auto" />
            </div>

            <div class="mt-6 text-2xl">
                Selamat datang di Aplikasi Banjarmasin!
            </div>

            <div class="mt-6 text-gray-500">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
            </div>

            <div class="mt-6">
            @auth
                <a href="{{ url('/user/profile') }}" class="btn btn-warning icon-left mr-2"><i class="far fa-user"></i> Profile</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary icon-left mr-2" style="width: 100px;">Login</a>
                <a href="{{ route('register') }}" class="btn btn-success icon-left mr-2" style="width: 100px;">Register</a>
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
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <article class="article article-style-b">
                    <div class="article-header">
                    <div class="article-image" data-background="{{ asset(Storage::url($app->path)) }}" style="background-image: url(&quot;{{ asset(Storage::url($app->path)) }}&quot;);">
                    </div>
                    </div>
                    <div class="article-details">
                    <div class="article-title">
                        <h2><a href="#">{{ $app->nama }}</a></h2>
                    </div>
                    <p>{{ $app->keterangan }}</p>
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