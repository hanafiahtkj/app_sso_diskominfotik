<x-app-layout>

  <x-slot name="title">Aplikasi</x-slot>

  <x-slot name="header_content">
    <div class="section-header-back">
      <a href="{{ route('app.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Aplikasi</h1>
    <div class="section-header-breadcrumb d-none d-md-block">
      <button type="submit" id="btn-simpan" class="btn-simpan btn btn-success"><i class="fas fa-save"></i> SIMPAN</button>
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
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
        <a href="{{ route('app.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Aplikasi</h1>
      <div class="section-header-breadcrumb d-none d-md-block">
        <button type="submit" id="btn-simpan" class="btn-simpan btn btn-success"><i class="fas fa-save"></i> SIMPAN</button>
      </div>
    </div>

    <div class="section-body">
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
                <textarea class="form-control" name="keterangan" id="form-keterangan" rows="4">{{ isset($app) ? $app->keterangan : '' }}</textarea>
                <div class="invalid-feedback feedback-keterangan"></div>
              </div>
              <div class="form-group" id="form-foto">
                <label>Logo</label>
                <div class="mt-2">
                  <div id="image-preview" class="image-preview" style="background-image: url('{{ isset($app) ? asset(Storage::url($app->path)) : '' }}'); background-size: cover; background-position: center center;">
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
                  <select class="custom-select" @change="cancelKategori()" id="id_kategori" name="id_kategori" v-model="id_kategori">
                    <option value="" selected>Pilih...</option>
                    <template v-for="(ket, index) in kategori">
                      <option :value="ket.id" :key="index">@{{ ket.urut }} | @{{ ket.nama }}</option>
                    </template>
                  </select>
                  <div class="input-group-append">
                    <!-- <button type="button" class="btn btn-outline-secondary">Aksi</button> -->
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Aksi <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#" @click="deleteKategori()">Hapus</a>
                      <div role="separator" class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#" @click="addKategori()">Tambah</a>
                      <div role="separator" class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#" @click="editKategori()">Ubah</a>
                    </div>
                  </div>
                  <div class="invalid-feedback feedback-id_kategori"></div>
                </div>
                <div v-show ="is_display == true">
                <hr>
                <div class="form-group mt-4">
                  <label for="form-urut">No Urut</label>
                  <input type="text" class="form-control" id="form-urut" v-model="fkategori.urut">
                  <div class="invalid-feedback feedback-urut"></div>
                </div>
                <div class="form-group">
                  <label for="form-nama2">Nama Kategori</label>
                  <input type="text" class="form-control" id="form-nama2" v-model="fkategori.nama">
                  <div class="invalid-feedback feedback-nama2"></div>
                </div>
                <div class="form-group">
                  <label for="form-keterangan2">Keterangan</label>
                  <textarea class="form-control" id="form-keterangan2" rows="4" v-model="fkategori.keterangan"></textarea>
                  <div class="invalid-feedback feedback-keterangan"></div>
                </div>
                <div class="form-group">
                  <label>Logo</label>
                  <div class="mt-2">
                    <div id="image-preview2" class="image-preview">
                      <label for="image-upload2" id="image-label2">Choose File</label>
                      <input type="file" name="foto2" id="image-upload2">
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-primary mr-2" @click="simpanKategori()">Simpan</button>
                <button type="button" class="btn btn-light" @click="cancelKategori()">Batal</button>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="row">
        <div class="col-12">
          <button type="submit" id="btn-simpan" class="btn-simpan btn btn-success d-block d-sm-none"><i class="fas fa-save"></i> SIMPAN</button>
        </div>
      </div>
    </div>
  </section>
</div>
  </form>

  <x-slot name="script">
  <script src="{{ asset('js/plugin.js') }}"></script>
  <script src="{{ asset('vendor/vuejs/vue.min.js') }}"></script>
  <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
  <script>
    // ----- VUE JS ----- //
    @if (isset($app))
      let action = "{{ route('app.update', $app->id) }}";
    @else
      let action = "{{ route('app.store') }}";
    @endif

    let dataVue= {
      is_display  : false,
      id_kategori : '{{ isset($app) ? $app->id_kategori : '' }}',
      kategori    : @json($kategori),
      fkategori   : {}
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
          this.fkategori = {};
          $("#image-upload2").val('');
          $('#image-preview2').css({"background-image" : "url('')", "background-size" : "cover", "background-position" : "center center"});
        },
        editKategori: function () 
        {
          $("#image-upload2").val('');
          $('#image-preview2').css({"background-image" : "url('')", "background-size" : "cover", "background-position" : "center center"});
          this.is_display = true;
          for (var key in this.kategori) {
            var entry = this.kategori[key];
            if (entry.id == this.id_kategori) {
              this.fkategori = {
                id         : this.kategori[key].id,
                nama       : this.kategori[key].nama,
                keterangan : this.kategori[key].keterangan,
                urut       : this.kategori[key].urut,
              };
              var url = (this.kategori[key].path != null) ? "{{ asset(Storage::url('')) }}/" + this.kategori[key].path : "'xx'";
              $('#image-preview2').css({"background-image" : "url('" + url + "')", "background-size" : "cover", "background-position" : "center center"});
            }
          }
        },
        deleteKategori: function () 
        {
          var r = confirm("Yakin ingin menghapus?");
          if (r == true) {
            var self = this;
            var url = '{{ route("kategori.destroy", ":id") }}';
            url = url.replace(':id', this.id_kategori);
            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'DELETE');
            $.ajax({
              type: 'POST',
              url: url,
              data: formData,
              dataType: "json",
              processData: false,
              contentType: false,
              //cache: true,
              success: function(data, textStatus, jqXHR) {
                if (data['status'] == true) {
                  self.kategori = data['data'];
                  self.id_kategori = '';
                  //self.is_display = false;
                }
              },
              error: function(data, textStatus, jqXHR) {
                alert(jqXHR + ' , Proses Dibatalkan!');
              },
            });
          }
        },
        cancelKategori: function () 
        {
          this.is_display = false;
          this.fkategori = {};
        },
        simpanKategori: function () 
        {
          var self = this;
          var formData = new FormData();
          for ( var key in this.fkategori ) {
            formData.append(key, this.fkategori[key]);
          }
          formData.append('foto', $('#image-upload2')[0].files[0]);
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
                self.kategori = data['data'];
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

    // jquery

    $(function() {

      $("form#form-app").submit(function(e){
        e.preventDefault();
        var btn = $('.btn-simpan');
        btn.addClass('btn-progress');
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: action,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data, textStatus, jqXHR) {
              $(".is-invalid").removeClass("is-invalid");
              if (data['status'] == true) {
                alert('ok');
                window.location = "{{ route('app.index') }}";
              }
              else {
                printErrorMsg(data.errors);
              }
              btn.removeClass('btn-progress');
            },
            error: function(data, textStatus, jqXHR) {
              alert(jqXHR + ' , Proses Dibatalkan!');
            },
        });
      });

      $.uploadPreview({
        input_field: "#image-upload",   // Default: .image-upload
        preview_box: "#image-preview",  // Default: .image-preview
        label_field: "#image-label",    // Default: .image-label
        label_default: "Choose File",   // Default: Choose File
        label_selected: "Change File",  // Default: Change File
        no_label: false,                // Default: false
        success_callback: null          // Default: null
      });

      $.uploadPreview({
        input_field: "#image-upload2",   // Default: .image-upload
        preview_box: "#image-preview2",  // Default: .image-preview
        label_field: "#image-label2",    // Default: .image-label
        label_default: "Choose File",   // Default: Choose File
        label_selected: "Change File",  // Default: Change File
        no_label: false,                // Default: false
        success_callback: null          // Default: null
      });

    }); 
    </script>
  </x-slot>

</x-app-layout>