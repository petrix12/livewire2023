<div>
    <x-danger-button wire:click="$set('open', true)">
        Crear post
    </x-danger-button>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear post
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Título del post" />
                {{-- <x-input type="text" class="w-full" wire:model.defer="title" /> --}}
                <x-input type="text" class="w-full" wire:model="title" />
                {{-- @error('title')
                    <span>{{ $message }}</span>
                @enderror --}}
                <x-input-error for='title' />
            </div>
            <div class="mb-4">
                <x-label value="Contenido del post" />
                <textarea class="form-control w-full" id="" rows="6" wire:model.defer="content"></textarea>
                <x-input-error for='content' />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)" class="mx-2">
                Cancelar
            </x-secondary-button>
            {{-- <x-danger-button wire:click="save" wire:loading.remove wire:target="save"> --}}
            {{-- <x-danger-button wire:click="save" wire:loading.class="bg-blue-500" wire:target="save"> --}}
            <x-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                Crear post
            </x-danger-button>

            {{-- <span wire:loading wire:target="save">Cargando...</span> --}}
        </x-slot>
    </x-dialog-modal>
</div>
