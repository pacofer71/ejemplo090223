<x-inicio>
    <x-tabla>
        <div class="flex mb-2">
            <div class="flex-1">
            <x-jet-input class="w-full" placeholder="Buscar..." type="search" wire:model="buscar"  />
            </div>
            <div class="ml-2">
                @livewire('create-post')
            </div>
        </div>
        @if($posts->count())
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
                @foreach($posts as $item)
                <tr class="bg-gray-100 border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        <a href="{{route('cposts.show', $item)}}"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-info"></i>
                        </a>
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        {{$item->titulo}}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4">
                        {{$item->contenido}}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        {{$item->estado}}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        <form action="{{route('cposts.destroy', $item)}}" method="POST">
                        @csrf
                        @method('delete')
                        <a href="{{route('cposts.edit', $item)}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-edit"></i>
                        </a>
                        <button type="submit" class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-trash"></i>
                        </button>
                        </form>
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
        <div class="mt-2">
            {{$posts->links()}}
        </div>
        @else
        <p class="px-2 py-2 rounded-xl bg-gray-300">
            No se encontró ningún post a aun no ha creado ninguno.
        </p> 
        @endif
    </x-tabla>

</x-inicio>