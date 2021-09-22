<x-app-layout>
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>

        <h1>{{ __('Pengaturan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item">Pengaturan</div>
        </div>
    </div>

    <div class="section-body">
    <div>
        <livewire:settings.halaman-utama action="updateSetting" />

        <x-jet-section-border />

        <livewire:settings.about action="updateSetting" />
    </div>
    </div>
  </section>
</div>
</x-app-layout>
