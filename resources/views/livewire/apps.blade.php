<div>

    <div class="py-0 pb-3 px-0 sm:px-0">
        <h2 class="section-title">Pemerintahan</h2>
        <p class="section-lead">Kota Banjarmasin, Kalimantan Selatan</p>
    </div>

    <div class="overflow-hidden sm:rounded-lg">
        <div class="row" id="app-kategori">
            @foreach ($kategori as $kat)
            <div class="col-6 col-sm-4 col-md-4 col-lg-3">
                <a class="onTap" href="{{ url('app/'.$kat->id) }}">
                    <article class="article">
                        <div class="article-header p-2 pt-3">
                            <div class="article-image" data-background="url('{{ isset($kat->path) ? asset(Storage::url($kat->path)) : '' }}')" style="background-size: contain; background-image: url(&quot;{{ isset($kat->path) ? asset(Storage::url($kat->path)) : '' }}&quot;);">
                            </div>
                        </div>
                        <div class="article-details line-clamp px-3 pt-0 pb-1 d-flex align-items-center justify-content-center">
                            {{ $kat->keterangan }}
                        </div>
                    </article>
                </a>
            </div>
            @endforeach
        </div>
    </div>

</div>
