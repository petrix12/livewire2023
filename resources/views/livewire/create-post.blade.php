<div>
    <x-danger-button wire:click="$set('open', true)">
        Crear post
    </x-danger-button>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear post
        </x-slot>

        <x-slot name="content">
            {{-- Notificación --}}
            <!-- component -->
            <!-- This is an example component -->
            <div wire:loading wire:target="image" class="max-w-lg mx-auto">
                <div class="flex bg-blue-100 rounded-lg p-4 mb-4 text-sm text-blue-700" role="alert">
                    <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        <span class="font-medium">¡Imagen cargando!</span> Espere mientras se carga la imagen
                    </div>
                </div>
            </div>
            {{-- Notificación --}}
            @if ($image)
                <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="Imagen del post">
            @endif
            <div class="mb-4">
                <x-label value="Título del post" />
                {{-- <x-input type="text" class="w-full" wire:model.defer="title" /> --}}
                <x-input type="text" class="w-full" wire:model="title" />
                {{-- @error('title')
                    <span>{{ $message }}</span>
                @enderror --}}
                <x-input-error for='title' />
            </div>
            <div class="mb-4" wire:ignore>
                <x-label value="Contenido del post" />
                <textarea
                    id="editor"
                    class="form-control w-full"
                    rows="6"
                    wire:model.defer="content"
                ></textarea>
                <x-input-error for='content' />
            </div>

            <div>
                <input type="file" wire:model="image" id="{{ $identificador }}">
                <x-input-error for='image' />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)" class="mx-2">
                Cancelar
            </x-secondary-button>
            {{-- <x-danger-button wire:click="save" wire:loading.remove wire:target="save"> --}}
            {{-- <x-danger-button wire:click="save" wire:loading.class="bg-blue-500" wire:target="save"> --}}
            <x-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save, image" class="disabled:opacity-25">
                Crear post
            </x-danger-button>

            {{-- <span wire:loading wire:target="save">Cargando...</span> --}}
        </x-slot>
    </x-dialog-modal>

    @push('js')
        {{-- https://ckeditor.com/ckeditor-5/download --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>

        {{-- https://ckeditor.com/docs/ckeditor5/latest/installation/getting-started/quick-start.html --}}
        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then(function(editor) {
                    editor.model.document.on('change:data', () => {
                        @this.set('content', editor.getData())
                    });
                    Livewire.on('resetCKEditor', () => {
                        editor.setData('');
                    })
                })
                .catch( error => {
                    console.error( error );
                } );
        </script>
    @endpush
</div>
