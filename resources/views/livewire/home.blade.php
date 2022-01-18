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
        <p class="section-lead">Kota Banjarmasin, Kalimantan Selatan</p>
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
                            {{-- <div class="article-title text-white line-clamp">
                                <h5>{{ $app->keterangan }}</h5>
                            </div> --}}
                        </div>
                        <div class="article-details px-3 py-1">
                            <p class="line-clamp">{{ $app->keterangan }}</p>
                        </div>
                    </article>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    {{-- <a href="{{ url('apps') }}" class="p-0">
        <div class="alert alert-dismissible show fade alert-has-icon p-0">
        <div class="alert-body" style="height: 120px;background-image: url(&quot;{{ asset('img/pemerintahan.png') }}&quot;);background-size: contain;">
            <div class="alert-title m-3">PEMERINTAHAN</div>
            <div>
            </div>
        </div>
    </div>
    </a> --}}

    <a href="{{ url('apps') }}" class="p-0">
        <div class="alert alert-dismissible show fade alert-primary alert-has-icon p-0">
            <div class="alert-body" style="height: 100px;">
        {{-- <div class="alert-body" style="height: 120px;background-image: url(&quot;{{ asset('img/pemerintahan.png') }}&quot;);background-size: contain;"> --}}
            <div class="alert-title mt-2 ml-3 font-weight-bold">PEMERINTAHAN</div>
            <div>
            </div>
        </div>
    </div>
    </a>

    @if(!empty($berita))
    <div class="py-0 pb-3 px-0 sm:px-0">
        <h2 class="section-title">Berita Terkini</h2>
        <p class="section-lead">Kota Banjarmasin, Kalimantan Selatan</p>
    </div>

    <div class="overflow-hidden sm:rounded-lg">
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel owl-theme" id="berita-carousel">
                    {{-- <div class="col-6 col-sm-4 col-md-4 col-lg-3"> --}}
                    @foreach ($berita as $item)
                        <article class="article article-style-b">
                            <div class="article-header">
                                <div class="article-image" data-background="{{ $item->gambar }}" style="background-size: contain; background-image: url(&quot;{{ $item->gambar }}&quot;);"></div>
                                <div class="article-title">
                                    <h2><a href="{{ $item->alamat }}">{{\Illuminate\Support\Str::limit($item->judul, 100)}}</a></h2>
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-title">
                                    <div class="article-cta">
                                        <a href="{{ $item->alamat }}">Selengkapnya <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif 
    
    <div class="py-0 pb-3 px-0 sm:px-0">
        <h2 class="section-title">Polling</h2>
        <p class="section-lead">Aplikasi Banjarmasin Pintar</p>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-12 col-md-6 ">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Pendapat anda tentang Aplikasi Banjarmasin Pintar?</h4>
                </div>
                <div class="card-body">
                    @if (session('polling') != true ) 
                    <form id="form-polling" action="{{ route('polling') }}" method="POST" style="">
                        @csrf
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="polling" id="exampleRadios1" value="1" checked="">
                            <label class="form-check-label" for="exampleRadios1">
                                Sangat Baik
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="polling" id="exampleRadios2" value="2">
                            <label class="form-check-label" for="exampleRadios2">
                                Baik
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="polling" id="exampleRadios3" value="3">
                            <label class="form-check-label" for="exampleRadios3">
                                Cukup
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="polling" id="exampleRadios4" value="4">
                            <label class="form-check-label" for="exampleRadios4">
                                Kurang
                            </label>
                        </div>
        
                        <div align="center" class="mt-3 mb-3">
                            <button id="btn-simpan" class="btn btn-primary" name="vote">Kirim</button>
                        </div>
                    </form>
                    @else
                        <h1 style="text-align: center;" class="mb-3">Terimakasih atas masukan anda</h1>
                    @endif
                    
                    <hr class="mb-3">

                    <span class="skill m3-4">Sangat Baik</span>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $polling['sangatbaik'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $polling['sangatbaik'] }}%;">{{ $polling['sangatbaik'] }}%</div>
                    </div>
                    <span class="skill m3-4">Baik</span>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-primary" role="progressbar" data-width="{{ $polling['baik'] }}%" aria-valuenow="{{ $polling['baik'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $polling['baik'] }}%;">{{ $polling['baik'] }}%</div>
                    </div>
                    <span class="skill m3-4">Cukup</span>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-warning" role="progressbar" data-width="{{ $polling['cukup'] }}%" aria-valuenow="{{ $polling['cukup'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $polling['cukup'] }}%;">{{ $polling['cukup'] }}%</div>
                    </div>
                    <span class="skill m3-4">Kurang</span>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-danger" role="progressbar" data-width="{{ $polling['kurang'] }}%" aria-valuenow="{{ $polling['kurang'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $polling['kurang'] }}%;">{{ $polling['kurang'] }}%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
