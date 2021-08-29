<x-guest-layout>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="bg-white overflow-hidden sm:rounded-lg">
            <div class="p-6 sm:px-10 bg-white">
                <div>
                    <img src="{{ asset('img/logo.png') }}" width="225" height="51" class="d-inline-block align-top" alt="">
                </div>

                <div class="mt-6 text-gray-500">
                    {!! $about['konten'] !!}.
                </div>
            </div>
        </div>
    </div>
    
</x-guest-layout>