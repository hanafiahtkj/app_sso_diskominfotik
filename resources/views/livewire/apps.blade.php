<div>
    {{-- <div id="welcome" class="bg-white overflow-hidden sm:rounded-lg mb-3">
        <div class="p-6 sm:px-10 bg-primary">
            
            <div class="mt-0 text-2xl text-white">
                Hai, Selamat Datang
            </div>

            <div class="mt-0 text-1xl text-white">
                {{ $settings['judul'] }}
            </div> --}}
            {{-- 
            <div class="mt-6 text-gray-500 d-none d-sm-block">
                {{ $settings['keterangan'] }}
            </div>

            <div class="mt-6 d-none d-sm-block">
            @auth
                @role('Admin')
                    <a href="{{ url('/admin-dashboard') }}" class="btn btn-outline-primary icon-left mr-2" style="width: 100px;">Dasbor</a>
                @endrole
                <a href="{{ url('/user/profile') }}" class="btn btn-outline-success icon-left mr-2" style="width: 100px;">Profil</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary icon-left mr-2" style="width: 100px;">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-outline-success icon-left mr-2" style="width: 100px;">Daftar</a>
            @endauth --}}
            {{-- </div> --}}
        {{-- </div>
    </div> --}}

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

    <div class="row fixed-top-c">
        <div class="col-12">
            <div class="card mb-0">
            <div class="card-body p-0">   
                <ul class="nav nav-pills stts-tab">
                    <li class="nav-item">
                        <a class="nav-link" v-bind:class="{ 'active' : id_ket == 'all'}" @click="changeId('all')" data-id="all" href="javascript:void(0)">Semua<span class="badge badge-white"></span></a>
                    </li>
                    @foreach ($kategori as $ket)
                        <li class="nav-item">
                            <a class="nav-link" v-bind:class="{ 'active' : id_ket == '{{ $ket->id }}'}" @click="changeId({{ $ket->id }})" data-stts="{{ $ket->id }}" href="javascript:void(0)">{{ $ket->nama }}<span class="badge badge-white"></span></a>
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
                <template v-for="(app, index) in kat.aplikasi">
                    <div class="col-6 col-sm-4 col-md-4 col-lg-3" :key="app.id">
                        <article class="article article-style-b" v-bind:class="{ active: app.isActive }">
                            <div class="article-header header-radius">
                                <a onClick="changeClass(this)" :href="@auth 
                                    app.base_url_sso 
                                @else 
                                    (app.is_sso == 1) ? '{{ url("login?redirect=")}}' + app.base_url_sso : app.base_url
                                @endauth">
                                <div class="article-image" :data-background="'{{ asset(Storage::url('')) }}' + '/' + app.path" :style="appBgImage(app.path)"></div>
                                <div class="article-title text-white">
                                    <h5>@{{ app.keterangan }}</h5>
                                </div>
                                </a>
                            </div>
                            {{-- <div class="article-details d-none d-md-block">
                                <div class="article-title">
                                    <p style="min-height: 65px;">@{{ app.keterangan }}</p>
                                    <div class="article-cta">
                                        <a :href="@auth 
                                            app.base_url_sso 
                                        @else 
                                            (app.is_sso == 1) ? '{{ url("login?redirect=")}}' + app.base_url_sso : app.base_url
                                        @endauth">Masuk ke Aplikasi <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div> --}}
                        </article>
                    </div>
                </template>
            </div>
        </div>
    </template>

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

    <div class="py-0 pb-3 px-0 sm:px-0">
        <h2 class="section-title">Informasi Rumah Sakit</h2>
        <p class="section-lead">Informasi Bed Rumah Sakit Banjarmasin</p>
    </div>

    <iframe src="https://yankes.kemkes.go.id/app/siranap/rumah_sakit?jenis=1&amp;propinsi=63prop&amp;kabkota=6371" height="500px" width="100%"></iframe>

    <div class="py-0 pb-3 px-0 sm:px-0">
        <h2 class="section-title">Polling</h2>
        <p class="section-lead">Aplikasi Banjarmasin Dalam Genggaman</p>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-12 col-md-6 ">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Pendapat anda tentang Aplikasi Banjarmasin Dalam Genggaman?</h4>
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
