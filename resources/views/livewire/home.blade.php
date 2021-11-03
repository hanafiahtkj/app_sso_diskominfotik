<div>
    <div id="welcome" class="bg-white overflow-hidden sm:rounded-lg">
        <div class="p-6 sm:px-10 bg-light text-center">
        
            <div class="mt-0 text-2xl">
                {{ $settings['judul'] }}
            </div>

            <div class="mt-6 text-gray-500 d-none d-sm-block">
                {{ $settings['keterangan'] }}
            </div>

            <div class="mt-6 d-none d-sm-block">
            @auth
                @role('Admin')
                    <a href="{{ url('/admin-dashboard') }}" class="btn btn-primary icon-left mr-2" style="width: 100px;">Dasbor</a>
                @endrole
                <a href="{{ url('/user/profile') }}" class="btn btn-success icon-left mr-2" style="width: 100px;">Profil</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary icon-left mr-2" style="width: 100px;">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-success icon-left mr-2" style="width: 100px;">Daftar</a>
            @endauth
            </div>
        </div>
    </div>

    <div class="py-0 pb-3 px-0 sm:px-0">
        <h2 class="section-title">Pelayanan Publik</h2>
        <p class="section-lead">Aplikasi Pelayanan Publik</p>
    </div>

    <div class="overflow-hidden sm:rounded-lg">
        <div class="row" id="app-kategori">
            @foreach ($aplikasi as $app)
            <div class="col-6 col-sm-4 col-md-4 col-lg-3">
                <a class="onTap" href="
                @auth 
                    {{ $app->base_url_sso}} 
                @else 
                    @if($app->is_sso == 1) 
                        {{ url('login?redirect='.$app->base_url_sso) }} 
                    @else 
                        {{ $app->base_url }} 
                    @endif 
                @endauth">
                    <article class="article">
                        <div class="article-header">
                            <div class="article-image" data-background="url('{{ isset($app->path) ? asset(Storage::url($app->path)) : '' }}')" style="background-image: url(&quot;{{ isset($app->path) ? asset(Storage::url($app->path)) : '' }}&quot;);">
                            </div>
                        </div>
                    </article>
                </a>
            </div>
            @endforeach
            {{-- <div class="col-6 col-sm-4 col-md-4 col-lg-3">
                <a href="{{ route('apps') }}">
                    <article class="article">
                        <div class="article-header">
                            <div class="article-image" data-background="{{ asset('img/plusx.png') }}" style="background-image: url(&quot;{{ asset('img/products/product-3-50.png') }}&quot;);">
                            </div>
                        </div>
                    </article>
                </a>
            </div> --}}
        </div>
    </div>

    <div class="py-0 pb-3 px-0 sm:px-0">
        <h2 class="section-title">Berita Terkini</h2>
        <p class="section-lead">Dari website berita.banjarmasinkota.go.id</p>
    </div>

    <div class="overflow-hidden sm:rounded-lg">
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel owl-theme" id="berita-carousel">
                    {{-- <div class="col-6 col-sm-4 col-md-4 col-lg-3"> --}}
                    @foreach ($berita as $item)
                        <article class="article article-style-b">
                            <div class="article-header">
                                <div class="article-image" data-background="{{ $item->gambar }}" style="background-image: url(&quot;{{ $item->gambar }}&quot;);"></div>
                                <div class="article-title">
                                    <h2><a href="{{ $item->alamat }}">{{\Illuminate\Support\Str::limit($item->judul, 100)}}</a></h2>
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-title">
                                    {{-- <p style="min-height: 65px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p> --}}
                                    <div class="article-cta">
                                        <a href="{{ $item->alamat }}">Selengkapnya <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
