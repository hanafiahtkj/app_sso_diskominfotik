<x-app-layout>
    <x-slot name="header_content">
        <div class="section-header-back">
          <a href="{{ route('user') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>

        <h1>{{ __('Buat User Baru') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item">Buat User Baru</div>
        </div>
    </x-slot>

    <div>
        <livewire:create-user action="createUser" />
    </div>
</x-app-layout>
