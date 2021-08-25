<x-app-layout>

  <x-slot name="title">Aplikasi</x-slot>

  <x-slot name="header_content">
    <div class="section-header-back">
      <a href="{{ route('app.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Aplikasi</h1>
    <div class="section-header-breadcrumb d-none d-md-block">
      <button type="submit" id="btn-simpan" class="btn btn-success"><i class="fas fa-save"></i> SIMPAN</button>
    </div>
  </x-slot>

  <x-slot name="style">

  </x-slot>

  @if(isset($app))
    <form id="form-app" method="POST" action="{{ route('app.update', $app->id) }}" novalidate="" enctype="multipart/form-data">
    @method('PATCH')
  @else
    <form id="form-app" method="POST" action="{{ route('app.store') }}" novalidate="" enctype="multipart/form-data">
  @endif
  @csrf
    <div class="row" id="app">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Utama</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="form-nama">Nama Aplikasi</label>
              <input type="text" name="nama" class="form-control" id="form-nama" value="{{ isset($app) ? $app->nama : '' }}">
              <div class="invalid-feedback feedback-nama"></div>
            </div>
            <div class="form-group">
              <label for="form-base_url">Base Url</label>
              <input type="text" name="base_url" class="form-control" id="form-base_url" value="{{ isset($app) ? $app->base_url : '' }}">
              <div class="invalid-feedback feedback-base_url"></div>
            </div>
            <div class="form-group">
              <label for="form-base_url_sso">Base Url SSO</label>
              <input type="text" name="base_url_sso" class="form-control" id="form-base_url_sso" value="{{ isset($app) ? $app->base_url_sso : '' }}">
              <div class="invalid-feedback feedback-base_url_sso"></div>
            </div>
            <div class="form-group">
              <label for="form-keterangan">Keterangan</label>
              <textarea class="form-control" id="form-keterangan" rows="4">{{ isset($app) ? $app->keterangan : '' }}</textarea>
              <div class="invalid-feedback feedback-keterangan"></div>
            </div>
            <div class="form-group" id="form-foto">
              <label>Logo</label>
              <div class="mt-2">
                <div id="image-preview" class="image-preview" style="background-image: url('{{ isset($app) ? Storage::url('aplikasi/'.$user->path) : '' }}'); background-size: cover; background-position: center center;">
                  <label for="image-upload" id="image-label">Choose File</label>
                  <input type="file" name="foto" id="image-upload">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Kategori</h4>
            </div>
            <div class="card-body">
              <label for="form-urut">Kategori</label>
              <div class="input-group mb-4">
                <select class="custom-select" id="id_kategori" name="id_kategori">
                  <option selected>Pilih...</option>
                  <template v-for="(ket, index) in kategori">
                    <option :value="ket.id" :key="index">@{{ ket.nama }}</option>
                  </template>
                </select>
                <div class="input-group-append">
                  <!-- <button type="button" class="btn btn-outline-secondary">Aksi</button> -->
                  <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Aksi <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Hapus</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" @click="addKategori()">Tambah</a>
                  </div>
                </div>
              </div>
              <template v-if="is_display == true">
              <hr>
              <div class="form-group mt-4">
                <label for="form-urut">No Urut</label>
                <input type="text" name="urut" class="form-control" id="form-urut" v-model="fkategori.urut">
                <div class="invalid-feedback feedback-urut"></div>
              </div>
              <div class="form-group">
                <label for="form-nama">Nama Kategori</label>
                <input type="text" name="nama" class="form-control" id="form-nama" v-model="fkategori.nama">
                <div class="invalid-feedback feedback-nama"></div>
              </div>
              <div class="form-group">
                <label for="form-keterangan">Keterangan</label>
                <textarea class="form-control" id="form-keterangan" rows="4" v-model="fkategori.keterangan"></textarea>
                <div class="invalid-feedback feedback-keterangan"></div>
              </div>
              <input type="hidden" name="id_kategori" v-model="fkategori.id">
              <button type="button" class="btn btn-primary" @click="simpanKategori()"><i class="fas fa-save"></i> Simpan Kategori</button>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="row">
      <div class="col-12">
        <button type="submit" id="btn-simpan" class="btn btn-success d-block d-sm-none"><i class="fas fa-save"></i> SIMPAN</button>
      </div>
    </div>
  </form>

  <x-slot name="script">
  <script src="{{ asset('vendor/vuejs/vue.min.js') }}"></script>
  <script>
    // ----- VUE JS ----- //
    @if (isset($app))
      let action = "{{ route('app.update', $app->id) }}";
      let method = "POST";
    @else
      let action = "{{ route('app.store') }}";
      let method = "POST";
    @endif

    let dataVue= {
      is_display : false,
      kategori : @json($kategori),
      fkategori : {
        id         : '',
        nama       : '',
        keterangan : '',
        urut       : '',
      }
    };

    var app = new Vue({
      el: '#app',
      data: dataVue,
      mounted () {
        
      },
      methods: {
        addKategori: function () 
        {
          this.is_display = true;
          this.fkategori = {
            id         : '',
            nama       : '',
            keterangan : '',
            urut       : '',
          };
        },
        editKategori: function (index) 
        {
          this.is_display = true;
          this.fkategori = {
            id         : kategori[index].id,
            nama       : kategori[index].nama,
            keterangan : kategori[index].keterangan,
            urut       : kategori[index].urut,
          };
        },
        deleteKategori: function (index) 
        {
          kategori.splice(index, 1);
        },
        simpanKategori: function () 
        {
          var self = this;
          var formData = new FormData();
          for ( var key in this.fkategori ) {
            formData.append(key, this.fkategori[key]);
          }
          formData.append('_token', '{{ csrf_token() }}');
          $.ajax({
            type: 'POST',
            url: "{{ route('kategori.store') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data, textStatus, jqXHR) {
              if (data['status'] == true) {
                self.kategori.push(data['data']);
                self.is_display = false;
              }
            },
            error: function(data, textStatus, jqXHR) {
              alert(jqXHR + ' , Proses Dibatalkan!');
            },
          });
        },
      },
    });
    </script>
  </x-slot>

</x-app-layout>