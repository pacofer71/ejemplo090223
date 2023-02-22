<x-app-layout>
    <x-inicio>
        <div class="px-4 py-4 rounded-xl shadow-xl border-2 border-black mx-auto w-3/4 bg-gray-200">
            <form name="a" method="POST" action="{{ route('contacto.send') }}">
                @csrf
                <x-jet-label for="nom">Nombre</x-jet-label>
                <x-jet-input type="text" name="nombre" placeholder="Nombre..." class="w-full" id="nom" />
                <x-jet-input-error for="nombre" />

                @guest
                    <x-jet-label for="em" class="mt-2">Email</x-jet-label>
                    <x-jet-input type="email" name="email" placeholder="Email..." class="w-full" id="em" />
                    <x-jet-input-error for="email" />
                @endguest
                
                <x-jet-label for="con" class="mt-2">Contenido</x-jet-label>
                <textarea name="contenido" id="con" placeholder="Contenido..." class="form-control w-full"></textarea>
                <x-jet-input-error for="contenido" />

                <div class="flex flex-row-reverse mt-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-paper-plane"></i> ENVIAR
                    </button>
                    <a href="/" class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-xmark"></i> CANCELAR
                    </a>
                </div>
            </form>
        </div>

    </x-inicio>
</x-app-layout>
