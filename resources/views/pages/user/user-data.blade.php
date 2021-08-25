<x-app-layout>
    <x-slot name="header_content">
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
    </x-slot>

    <div>
        <livewire:table.main name="user" :model="$user" />
    </div>
</x-app-layout>
