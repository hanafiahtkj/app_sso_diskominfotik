<div>
    <div class="alert alert-dismissible show fade alert-primary alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
          <div class="alert-title">Hai, Selamat Datang</div>
          {{ $settings['judul'] }}
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
                        <div class="article-header p-2 pt-3">
                            <div class="article-image" data-background="url('{{ isset($app->path) ? asset(Storage::url($app->path)) : '' }}')" style="background-size: contain; background-image: url(&quot;{{ isset($app->path) ? asset(Storage::url($app->path)) : '' }}&quot;);">
                            </div>
                            {{-- <div class="article-title text-white">
                                <h5>{{ $app->keterangan }}</h5>
                            </div> --}}
                        </div>
                        <div class="article-details line-clamp px-3 pt-0 pb-1 d-flex align-items-center justify-content-center">
                            {{ $app->keterangan }}
                        </div>
                    </article>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
