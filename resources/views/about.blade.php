<x-guest-layout>
    <x-slot name="header_content">
        <!-- <h1>Tentang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('') }}">Beranda</a></div>
            <div class="breadcrumb-item">Tentang</div>
        </div> -->
    </x-slot>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="bg-white overflow-hidden sm:rounded-lg">
            <div class="p-6 sm:px-10 bg-white">
                <div>
                    <x-jet-application-logo class="block h-12 w-auto" />
                </div>

                <div class="mt-6 text-gray-500">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>