<x-app-layout>

    <x-slot name="script">
        <script src="{{ asset('vendor/sweetalert2/dist/sweetalert.min.js') }}"></script>
        <script>
            swal({
                title: "Berhasil!",
                text: "Registrasi Berhasil!",
                icon: "success",
                button: "Close!",
                closeOnClickOutside: false,
            })
            .then(willDelete => {
                window.location.replace("{{ route('welcome') }}");
            });
        </script>
    </x-slot>
    
</x-app-layout>