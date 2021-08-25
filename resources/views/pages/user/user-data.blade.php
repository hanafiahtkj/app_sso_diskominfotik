<x-app-layout>
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="#" class="btn btn-icon"><i class="fa fa-th" aria-hidden="true"></i></a>
        </div>

        <h1>{{ __('Data User') }}</h1>

        <div class="section-header-button">
        <a href="{{ route('user.new') }}" class="-ml- btn btn-primary shadow-none">
            <span class="fas fa-plus"></span> Buat User Baru
        </a>    
        </div>
    

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dasbor</a></div>
        <div class="breadcrumb-item">Data User</div>
        </div>
    </div>

    <div class="section-body">
    <div>
        <livewire:table.main name="user" :model="$user" />
    </div>
    </div>
  </section>
</div>
</x-app-layout>
