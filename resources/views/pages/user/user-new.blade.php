<x-app-layout>
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="{{ route('user') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>

        <h1>{{ __('Buat User Baru') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item">Buat User Baru</div>
        </div>
    </div>

    <div class="section-body">
    <div>
        <livewire:create-user action="createUser" />
    </div>
    </div>
  </section>
</div>
</x-app-layout>
