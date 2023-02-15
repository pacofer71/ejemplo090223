<x-app-layout>
    <x-inicio>
        <x-tabla>
            <div class="flex flex-row-reverse mb-2">
                <a href="{{route('cposts.create')}}"  class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-add"></i> Nuevo
                    </a>
            </div>
            <table class="min-w-full">
                <thead class="bg-white border-b">
                    <tr>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            INFO
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            TITULO
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            CONTENIDO
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            ESTADO
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
        </x-tabla>

    </x-inicio>
</x-app-layout>
