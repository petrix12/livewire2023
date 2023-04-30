<div>
    <a class="btn btn-green" wire:click="$set('open', true)">
        <i class="fas fa-edit"></i>
    </a>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar el  post {{ $post->title}}
        </x-slot>

        <x-slot name="content">
            {{-- Notificación --}}
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
                <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="Nueva imagen del post">
            @else
                <img class="mb-4" src="{{ Storage::url($post->image) }}" alt="Antigua imagen del post">
            @endif
            <div class="mb-4">
                <x-label value="Título del post" />
                <x-input type="text" class="w-full" wire:model="post.title" />
                <x-input-error for='post.title' />
            </div>
            <div class="mb-4">
                <x-label value="Contenido del post" />
                <textarea class="form-control w-full" id="" rows="6" wire:model.defer="post.content"></textarea>
                <x-input-error for='post.content' />
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
            <x-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update, image" class="disabled:opacity-25">
                Actualizar post
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
