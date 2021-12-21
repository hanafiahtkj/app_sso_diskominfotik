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

    <div class="row fixed-top-c">
        <div class="col-12">
            <div class="card mb-0">
            <div class="card-body p-0">   
                <ul class="nav nav-pills stts-tab">
                    {{-- <li class="nav-item">
                        <a class="nav-link" v-bind:class="{ 'active' : id_ket == 'all'}" @click="changeId('all')" data-id="all" href="javascript:void(0)">Semua<span class="badge badge-white"></span></a>
                    </li> --}}
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
                                <a onClick="changeClass(this)" target="_blank" :href="@auth 
                                    @if (Auth::user()->email_verified_at != null)
                                        (app.is_sso == 1) ? app.base_url_sso : app.base_url 
                                    @else
                                        (app.is_sso == 1) ? '{{ route("verification.notice") }}' : app.base_url
                                    @endif
                                @else 
                                    (app.is_sso == 1) ? '{{ url("login?redirect=")}}' + app.base_url_sso : app.base_url
                                @endauth">
                                <div class="article-image" :data-background="'{{ asset(Storage::url('')) }}' + '/' + app.path" :style="appBgImage(app.path)"></div>
                                <div class="article-title text-white">
                                    <h5>@{{ app.keterangan }}</h5>
                                </div>
                                </a>
                            </div>
                        </article>
                    </div>
                    <template v-if="id_ket == 8">
                        <div class="iframe col-12">
                            <iframe src="https://yankes.kemkes.go.id/app/siranap/rumah_sakit?jenis=1&amp;propinsi=63prop&amp;kabkota=6371" height="500px" width="100%"></iframe>
                        </div>
                    </template>
                </template>
            </div>
        </div>
    </template>
</div>
