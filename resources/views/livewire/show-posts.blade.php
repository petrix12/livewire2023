<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
                    @foreach ($posts as $post)
                        <tr>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                {{ $post->id}}
                            </td>
                            <td class="px-4 py-4 text-sm font-medium text-gray-700">
                                <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-emerald-500 bg-emerald-100/60 dark:bg-gray-800">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                    <h2 class="text-sm font-normal">{{ $post->title }}</h2>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                {{ $post->content }}
                            </td>
                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                <div class="flex items-center gap-x-6">
                                    <button class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                        Archive
                                    </button>

                                    <button class="text-blue-500 transition-colors duration-200 hover:text-indigo-500 focus:outline-none">
                                        Download
                                    </button>
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
</div>
