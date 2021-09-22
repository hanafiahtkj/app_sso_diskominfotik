<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Halaman Tentang') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Lengkapi data berikut dan submit untuk membuat perubahan') }}
        </x-slot>

        <x-slot name="form">
            <div class="form-group col-span-6 sm:col-span-5">
                <textarea id="konten" class="summernote-simple mt-1 block w-full form-control shadow-none" rows="3" wire:model.defer="pages.konten" style="height:250px!important"></textarea>
                <x-jet-input-error for="pages.konten" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __($button['submit_response']) }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __($button['submit_text']) }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />

    <x-slot name="style">
        <link rel="stylesheet" href="{{ asset('vendor/summernote-0.8.18/summernote-bs4.css') }}">
    </x-slot>

    <x-slot name="script">
        <script src="{{ asset('vendor/summernote-0.8.18/summernote-bs4.js') }}"></script>
    </x-slot>
</div>