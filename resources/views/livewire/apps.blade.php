<div>

    <div class="py-0 pb-3 px-0 sm:px-0">
        <h2 class="section-title">Pemerintahan</h2>
        <p class="section-lead">Kota Banjarmasin - Kalimantan Selatan</p>
    </div>

    <div class="overflow-hidden sm:rounded-lg">
        <div class="row" id="app-kategori">
            @foreach ($kategori as $kat)
            <div class="col-6 col-sm-4 col-md-4 col-lg-3">
                <a class="onTap" href="{{ url('app/'.$kat->id) }}">
                    <article class="article">
                        <div class="article-header">
                            <div class="article-image" data-background="url('{{ isset($kat->path) ? asset(Storage::url($kat->path)) : '' }}')" style="background-size: contain; background-image: url(&quot;{{ isset($kat->path) ? asset(Storage::url($kat->path)) : '' }}&quot;);">
                            </div>
                            {{-- <div class="article-title text-white">
                                <h5>{{ $app->keterangan }}</h5>
                            </div> --}}
                        </div>
                    </article>
                </a>
            </div>
            @endforeach
        </div>
    </div>

</div>
