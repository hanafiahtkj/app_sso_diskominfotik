@php
$user = auth()->user();
@endphp

<x-sso-layout> 
    @if(Auth::check()) 
    <div id="wrapper1">
        <x-jet-authentication-card>
            <x-slot name="logo">
                <x-jet-authentication-card-logo />
            </x-slot>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-jet-label value="{{ __('Anda sudah masuk di aplikasi SSO dengan Email') }}" />
                    <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" readonly required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
        
                        <a id="btn-to-form-login" class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Gunakan Akun yang lain?') }}
                        </a>
                    

                    <x-jet-button class="ml-4" id="btn-login-1">
                        {{ __('Masuk') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
    </div>
    @endif

    <div id="wrapper2" style="display: {{ (Auth::check()) ? 'none;' : 'block;' }}">
        <x-jet-authentication-card> 
            <x-slot name="logo">
                <x-jet-authentication-card-logo />
            </x-slot>

            <x-jet-validation-errors class="mb-4" />

            <div id="error_msg" class="mb-4 font-medium text-sm text-green-600" style="display:none"></div>

            <form id="form-login" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-jet-label value="{{ __('Email') }}" />
                    <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label value="{{ __('Password') }}" />
                    <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <input type="hidden" name="is_sso" value="true">

                <div class="flex items-center justify-end mt-4">
                    <a id="btn-to-form-register" target="_blank" class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                            {{ __('Belum memiliki Akun?') }}
                        </a>
                    <x-jet-button class="ml-4" id="btn-login-2">
                        {{ __('Masuk') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
    </div>

    <x-slot name="style">
        <style> 
        body.layout-3 .main-content {
            padding-top: 0px!important;
        }
        </style> 
    </x-slot>

    <x-slot name="script">
        <script defer src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
        <script>  
        // jquery
        $(function() {
            $("#btn-to-form-login").click(function(e){
                e.preventDefault();
                var formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    type: "POST",
                    url: "{{ route('logout') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    //dataType: "json",
                    success: function(data, textStatus, jqXHR) {
                        console.log('Logout Berhasil!'); 
                        location.reload();
                    },
                    error: function(data, textStatus, jqXHR) {
                        console.log('Logout Gagal!');
                    },
                });
            });

            $("#btn-login-1").click(function(e){
                e.preventDefault();
                window.close();
            });

            $("form#form-login").submit(function(e){
                e.preventDefault();
                $('#error_msg').hide();
                var btn = $('#btn-register');
                btn.addClass('btn-progress');
                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('login') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(data, textStatus, jqXHR) {
                        //$(".is-invalid").removeClass("is-invalid");
                        if (data['status'] == true) {
                            // alert(data['status']);
                            swal({
                                title: "Berhasil!",
                                text: "Login Berhasil!",
                                icon: "success",
                                button: "Close!",
                            });
                            window.close();
                        }   
                    },
                    error: function(data, textStatus, jqXHR) {
                        console.log(textStatus);
                        $('#error_msg').show().text('Email atau Password Tidak Ditemukan.');
                        btn.removeClass('btn-progress');
                    },
                });
            });

            // $("form#form-register").submit(function(e){
            //     e.preventDefault();
            //     var btn = $('#btn-register');
            //     btn.addClass('btn-progress');
            //     var formData = new FormData($(this)[0]);
            //     $.ajax({
            //         type: "POST",
            //         url: "{{ route('register') }}",
            //         data: formData,
            //         processData: false,
            //         contentType: false,
            //         dataType: "json",
            //         success: function(data, textStatus, jqXHR) {
            //             //$(".is-invalid").removeClass("is-invalid");
            //             if (data['status'] == true) {
            //                 alert(data['status']);
            //                 window.close();
            //             }   
            //         },
            //         error: function(data, textStatus, jqXHR) {
            //             console.log(data);
            //             alert('register Gagal!');
            //             btn.removeClass('btn-progress');
            //         },
            //     });
            // });
        }); 
        </script>
    </x-slot>
</x-sso-layout>
