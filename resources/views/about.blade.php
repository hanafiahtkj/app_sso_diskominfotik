<x-guest-layout>

    <div class="bg-white overflow-hidden sm:rounded-lg">
        <div class="p-6 sm:px-10 bg-white text-center">
        
            <div class="mt-0 text-2xl">
                {{ $about['judul'] }}
            </div>

            <div class="mt-6 text-gray-500">
                {!! $about['konten'] !!}
            </div>
        </div>
    </div>
    
</x-guest-layout>