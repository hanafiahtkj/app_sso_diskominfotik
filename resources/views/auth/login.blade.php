<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div style="text-align:center;">
                <h1>Login</h1>
                <p>Banjarmasin Dalam Genggaman</p>
            </div>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label value="{{ __('Email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4" id="btn-simpan">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
    
    <x-slot name="script">
        <script> 
        // jquery
        // $(function() {
        //     $("form").submit(function(e){
        //         e.preventDefault();
        //         var btn = $('#btn-simpan');
        //         btn.addClass('btn-progress');
        //         var formData = new FormData($(this)[0]);
        //         $.ajax({
        //             type: "POST",
        //             url: "{{ route('login') }}",
        //             data: formData,
        //             processData: false,
        //             contentType: false,
        //             dataType: "json",
        //             success: function(data, textStatus, jqXHR) {
        //                 //$(".is-invalid").removeClass("is-invalid");
        //                 if (data['status'] == true) {
        //                     window.location.replace("{{ route('welcome') }}");
        //                 }   
        //             },
        //             error: function(data, textStatus, jqXHR) {
        //                 console.log(data);
        //                 alert('Login Gagal!');
        //                 btn.removeClass('btn-progress');
        //             },
        //         });
        //     });
        // }); 
        </script>
    </x-slot>
</x-guest-layout>
