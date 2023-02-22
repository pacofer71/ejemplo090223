<x-inicio>
    <x-tabla>
        <div class="flex mb-2">
            <div class="flex-1">
                <x-jet-input class="w-full" placeholder="Buscar..." type="search" wire:model="buscar" />
            </div>
            <div class="ml-2">
                @livewire('create-post')
            </div>
        </div>
        @if ($posts->count())
            <table class="min-w-full">
                <thead class="bg-white border-b">
                    <tr>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            INFO
                        </th>
                        <th scope="col" wire:click="ordenar('titulo')"
                            class="cursor-pointer text-sm font-medium text-gray-900 px-6 py-4 text-left whitespace-nowrap">
                            TITULO<i class="ml-2 fas fa-sort"></i>
                        </th>
                        <th scope="col" wire:click="ordenar('contenido')"
                            class="cursor-pointer text-sm font-medium text-gray-900 px-6 py-4 text-left whitespace-nowrap">
                            CONTENIDO<i class="ml-2 fas fa-sort"></i>
                        </th>
                        <th scope="col" wire:click="ordenar('estado')"
                            class="cursor-pointer text-sm font-medium text-gray-900 px-6 py-4 text-left whitespace-nowrap">
                            ESTADO<i class="ml-2 fas fa-sort"></i>
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            ACCIONES
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $item)
                        <tr class="bg-gray-100 border-b">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <a href="{{ route('cposts.show', $item) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="fas fa-info"></i>
                                </a>
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $item->titulo }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4">
                                {{ $item->contenido }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $item->estado }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                <button wire:click="editar({{ $item->id }})"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button wire:click="borrar({{ $item->id }})"
                                    class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $posts->links() }}
            </div>
        @else
            <p class="px-2 py-2 rounded-xl bg-gray-300">
                No se encontró ningún post a aun no ha creado ninguno.
            </p>
        @endif
    </x-tabla>

    <!------------------------------------- Modal Para editar Post ---------------------------------------->
    @if ($post->imagen)
        <x-jet-dialog-modal wire:model="openEditar">
            <x-slot name="title">
                Editar Post
            </x-slot>
            <x-slot name="content">
                @wire($post)
                    <x-form-input name="post.titulo" label="Título" placeholder="Título" />
                    <x-form-textarea name="post.contenido" placeholder="Contenido" label="Contenido" />
                    <x-form-group name="estado" label="Estado del Post (Publicado/Borrador)" inline>
                        <x-form-radio name="post.estado" value="Publicado" label="Publicado" />
                        <x-form-radio name="post.estado" value="Borrador" label="Borrador" />
                    </x-form-group>
                @endwire
                <x-form-group inline label="Etiquetas">
                    @foreach ($tags as $k => $v)
                        <x-form-checkbox name="selectedTags[]"  label="{{ $v }}" value="{{ $k }}"
                            :show-errors='false' wire:model.defer='selectedTags' />
                    @endforeach
                </x-form-group>
                <x-jet-input-error for="selectedTags" />
                <div class="relative my-4">
                    @if ($imagen)
                        <img src="{{ $imagen->temporaryUrl() }}" class="h-32 object-cover object-center">
                        <button wire:click="$set('imagen')"
                            class="absolute right-2 bottom-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Cambiar
                            Imagen
                        </button>
                    @else
                        <img src="{{ Storage::url($post->imagen) }}" class="h-32 object-cover object-center">
                        <label for="imge"
                            class="absolute right-2 bottom-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Seleccionar
                            Imagen</label>
                    @endif
                    <input type="file" class="hidden" wire:model.defer="imagen" id="imge" />

                </div>
                <x-jet-input-error for="imagen" />

            </x-slot>
            <x-slot name="footer">
                <div class="flex flex-row-reverse">
                    <button wire:click="update"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-editar"></i> Editar
                    </button>
                    <button wire:click="cancelar"
                        class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-xmark"></i> Cancelar
                    </button>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    @endif

</x-inicio>
