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
                <x-jet-label for="judul" value="{{ __('Judul') }}" />
                <x-jet-input id="judul" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="pages.judul" />
                <x-jet-input-error for="pages.judul" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5" wire:ignore>
                <x-jet-label for="konten" value="{{ __('Konten') }}" />
                <textarea id="konten" class="summernote-simple-liveware mt-1 block w-full form-control shadow-none" rows="3" wire:model.defer="pages.konten" style="height:250px!important">{{ $pages->konten }}</textarea>
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
        <script>
            $(".summernote-simple-liveware").summernote({
                dialogsInBody: true,
                minHeight: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough']],
                    ['para', ['paragraph']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('pages.konten', contents);
                    }
                }
            });
        </script>
    </x-slot>
</div>