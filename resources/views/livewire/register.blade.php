<div>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div style="text-align:center;">
                <h1><i class="fas fa-user-plus fa-3x text-primar"></i></h1>
                {{-- <p>Banjarmasin Dalam Genggaman</p> --}}
            </div>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label value="{{ __('Nama') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Konfirmasi Password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" @click="changeRoute('/login')">
                    {{ __('Sudah memiliki Akun?') }}
                </a>

                <x-jet-button class="ml-4" id="btn-simpan">
                    {{ __('Selesai') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</div>