<div>
    {{-- Encabezado --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Listar registros --}}
    <x-propios.table>
        <div class="px-4 py-4 flex items-center">
            <x-input type="text" wire:model="search" class="flex-1 mr-4" placeholder="Buscar..." />
            @livewire('create-post')
        </div>
        @if ($posts->count())
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="col"
                            class="cursor-pointer px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400 w-24"
                            wire:click="order('id')"
                        >
                            ID
                            {{-- sort --}}
                            @if ($sort == 'id')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>

                        <th scope="col"
                            class="cursor-pointer px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                            wire:click="order('title')"
                        >
                            Título
                            {{-- sort --}}
                            @if ($sort == 'title')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>

                        <th scope="col"
                            class="cursor-pointer px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                            wire:click="order('content')"
                        >
                            Contenido
                            {{-- sort --}}
                            @if ($sort == 'content')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>

                        <th scope="col" class="relative py-3.5 px-4">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                    @foreach ($posts as $item)
                        <tr>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                {{ $item->id}}
                            </td>
                            <td class="px-4 py-4 text-sm font-medium text-gray-700">
                                <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-emerald-500 bg-emerald-100/60 dark:bg-gray-800">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                    <h2 class="text-sm font-normal">{{ $item->title }}</h2>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                {{ $item->content }}
                            </td>
                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                <div class="flex items-center gap-x-6">
                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                                    <a class="btn btn-green" wire:click="edit({{ $item }})">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="px-4 py-4">
                No se encontró ninguna coincidencia
            </div>
        @endif
    </x-propios.table>

    {{-- Modal Editar --}}
    <x-dialog-modal wire:model="open_edit">
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
            <x-secondary-button wire:click="$set('open_edit', false)" class="mx-2">
                Cancelar
            </x-secondary-button>
            <x-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update, image" class="disabled:opacity-25">
                Actualizar post
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
