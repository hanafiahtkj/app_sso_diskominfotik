<div>
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
                <template v-for="app in kat.aplikasi">
                    <div class="col-6 col-sm-4 col-md-4 col-lg-3" :key="app.id">
                        <article class="article article-style-b">
                            <div class="article-header header-radius mb-4">
                                <a target="_blank" :href="@auth app.base_url_sso @else app.base_url @endauth"><div class="article-image" :data-background="'{{ asset(Storage::url('')) }}' + '/' + app.path" :style="appBgImage(app.path)"></div></a>
                            </div>
                            <div class="article-details d-none d-md-block">
                                <div class="article-title">
                                    <p style="min-height: 65px;">@{{ app.keterangan }}</p>
                                    <div class="article-cta">
                                        <a target="_blank" :href="@auth app.base_url_sso @else app.base_url @endauth">Masuk ke Aplikasi <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>
