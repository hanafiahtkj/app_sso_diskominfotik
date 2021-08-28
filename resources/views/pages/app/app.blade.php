<x-app-layout>

  <x-slot name="title">Aplikasi</x-slot>

  <div class="main-content">
    <section class="section">
      <div class="section-header">
    <div class="section-header-back">
      <a href="#" class="btn btn-icon"><i class="fa fa-th" aria-hidden="true"></i></a>
    </div>
    <h1>Aplikasi</h1>
    <div class="section-header-button">
      <a href="{{ route('app.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Aplikasi Baru</a>
    </div>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dasbor</a></div>
      <div class="breadcrumb-item">Aplikasi</div>
    </div>
  </div>

  <div class="section-body">
    <div>
      <livewire:table.app name="app" :model="$app" />
    </div>
  </div>

  </section>
</div>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/iziToast/dist/css/iziToast.min.css') }}">
  </x-slot>

  <x-slot name="extra_js">
    <!-- <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/iziToast/dist/js/iziToast.min.js') }}"></script> -->
    <script>
    </script>
  </x-slot>

</x-app-layout>