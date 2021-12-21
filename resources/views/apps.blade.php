<x-guest-layout :kategori="$kategori"> 
    
    <livewire:apps /> 

    <x-slot name="style">
        <link rel="stylesheet" href="{{ asset('vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}">
        <style>
            @media (max-width: 767px) { 
                .section > *:first-child {
                    margin-top: 70px!important;
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
        <script src="{{ asset('vendor/sweetalert2/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('vendor/vuejs/vue.min.js') }}"></script>
        <script>
            function changeClass(obj) {
                $(obj).parents('.article').addClass('active');
            }
        
            // ----- VUE JS ----- //
            let dataVue= {
                id_ket : '93',
                kategori : @json($kategori),
            };

            console.log(dataVue);
            
            var app = new Vue({
                el: '#app',
                data: dataVue,
                mounted () {
                
                },
                methods: {
                    changeId: function (id) {
                        this.id_ket = id;
                    },
                    appBgImage(src) {
                        let bgImage = "{{ asset(Storage::url('')) }}" + "/" + src;
                        return {
                            backgroundImage: `url("${bgImage}")`,
                            backgroundSize: 'contain',
                        }
                    },
                },
                computed: {
                    filteredKategori() {
                        let tempKategori = this.kategori
                        tempKategori = tempKategori.filter((item) => {
                            if (item.id == this.id_ket) {
                                return true;
                            }

                            if (this.id_ket == 'all') {
                                if(item.id == 100) {
                                    return false;
                                }
                                return true;
                            }
                        })
                        return tempKategori;
                    }
                }
            });
        </script>
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

                $("form#form-polling").submit(function(e){
                    e.preventDefault();
                    var btn = $('#btn-simpan');
                    btn.addClass('btn-progress');
                    var formData = new FormData($(this)[0]);
                    formData.append('_token', '{{ csrf_token() }}');
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('action'),
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(data, textStatus, jqXHR) {
                            if (data['status'] == true) {
                                // alert('ok');
                                // swal({
                                //     title: "Tersimpan!", 
                                //     icon: "success",
                                // })
                                // .then((value) => {
                                    
                                // });
                                location.reload();
                            }
                            btn.removeClass('btn-progress');
                        },
                        error: function(data, textStatus, jqXHR) {
                            alert(jqXHR + ' , Proses Dibatalkan!');
                        },
                    });
                });
            }); 
        </script>
    </x-slot>


</x-guest-layout>