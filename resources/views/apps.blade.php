<x-guest-layout :kategori="$kategori"> 
    
    <livewire:apps /> 

    <x-slot name="style">
        <style>
            @media (max-width: 767px) { 
                .section > *:first-child {
                    margin-top: 70px!important;
                } 
            }
        </style>
    </x-slot>

    <x-slot name="script">
        <script src="{{ asset('vendor/vuejs/vue.min.js') }}"></script>
        <script>
            function changeClass(obj) {
                $(obj).parents('.article').addClass('active');
            }
        
            // ----- VUE JS ----- //
            let dataVue= {
                id_ket : 'all',
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
                        }
                    },
                },
                computed: {
                    filteredKategori() {
                        let tempKategori = this.kategori
                        tempKategori = tempKategori.filter((item) => {
                            return ((item.id == this.id_ket) || (this.id_ket == 'all'))
                        })
                        return tempKategori;
                    }
                }
            });
        </script>
    </x-slot>


</x-guest-layout>