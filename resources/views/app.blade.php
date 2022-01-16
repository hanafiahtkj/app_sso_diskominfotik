<x-guest-layout>

    <div>
        <div class="py-0 pb-3 px-0 sm:px-0">
            <h2 class="section-title">{{ $kategori['nama'] }}</h2>
            <p class="section-lead">{{ $kategori['keterangan'] }}</p>
        </div>
    
        <div class="overflow-hidden sm:rounded-lg">
            <div class="row" id="app-kategori">
                @foreach ($aplikasi as $app)
                <div class="col-6 col-sm-4 col-md-4 col-lg-3">
                    <a class="onTap" target="_blank" href="
                    @auth 
                        @if (Auth::user()->email_verified_at != null)
                            {{ ($app->is_sso == 1) ? url($app->base_url_sso) : url($app->base_url) }} 
                        @else
                            {{ ($app->is_sso == 1) ? route("verification.notice") : url($app->base_url) }}
                        @endif
                    @else 
                        @if($app->is_sso == 1) 
                            {{ url('login?redirect='.$app->base_url_sso) }} 
                        @else 
                            {{ $app->base_url }} 
                        @endif 
                    @endauth">
                        <article class="article">
                            <div class="article-header">
                                <div class="article-image" data-background="url('{{ isset($app->path) ? asset(Storage::url($app->path)) : '' }}')" style="background-size: contain; background-image: url(&quot;{{ isset($app->path) ? asset(Storage::url($app->path)) : '' }}&quot;);">
                                </div>
                                <div class="article-title text-white">
                                    <h5>{{ $app->keterangan }}</h5>
                                </div>
                            </div>
                        </article>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    

    <x-slot name="style">
        <link rel="stylesheet" href="{{ asset('vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}">
        <style>
            @media (max-width: 767px) { 
                .section > *:first-child {
                    margin-top: 70px!important;
                } 
            }

            @media (min-width: 768px) {
                iframe .container-fluid .col-md-10 {
                    flex: 0 0 100%;
                    max-width: 100%;
                }
            }
        </style>
    </x-slot> 

    <x-slot name="script">
        <script src="{{ asset('vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
        <script>
            $(function() {
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