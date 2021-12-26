<x-guest-layout> 

    <livewire:home /> 

    <x-slot name="style">
        <link rel="stylesheet" href="{{ asset('vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}">
        <style>
            @media (max-width: 767px) { 
                .section > *:first-child {
                    /* margin-top: 70px!important; */
                } 
            }

            @media (min-width: 768px) {
                iframe .container-fluid .col-md-10 {
                    flex: 0 0 100%;
                    max-width: 100%;
                }
            }
        </style>
    </x-slot> 

    <x-slot name="script">
        <script src="{{ asset('vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
        <script>
            $(function() {
                $("#berita-carousel").owlCarousel({
                    items: 12,
                    margin: 20,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    loop: true,
                    responsive: {
                        0: {
                            items: 2
                        },
                        578: {
                            items: 3
                        },
                        768: {
                            items: 4
                        }
                    }
                });
            }); 
        </script>
    </x-slot>

</x-guest-layout>