<x-app-layout>
    <x-inicio>
        <form name="az" action="{{ route('cposts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form-input name="titulo" label="Título" placeholder="Título ..." />
            <x-form-textarea name="contenido" placeholder="Contenido..." label="Contenido" rows='4' />
            <x-form-group name="estado" label="Estado" inline>
                <x-form-radio name="estado" value="Publicado" label="PUBLICADO" />
                <x-form-radio name="estado" value="Borrador" label="BORRADOR" />
            </x-form-group>

            <x-form-group inline label="Tags">
                @foreach ($tags as $k => $v)
                    <x-form-checkbox name="etiquetas[]" label="{{ $v }}" value="{{ $k }}"
                        :show-errors="false" />
                @endforeach
            </x-form-group>
            @error('etiquetas')
                <p class="mt-2 text-red-600 italic text-xs">{{$message}}</p>
            @enderror

            <div class="mt-4 flex">
                <div class="mr-4">
                    <label for="img"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Imagen</label>
                    <input type='file' name="imagen" class="hidden" id="img" accept="image/*">
                </div>
                <div>
                    <img src="{{ Storage::url('noimage.png') }}" class="object-center object-cover" id="img1" />
                </div>


            </div>
            @error('imagen')
                <p class="mt-2 text-red-600 italic text-xs">{{ $message }}</p>
            @enderror
            <div class="mt-6">
                <a href="{{ route('cposts.index') }}"
                    class="mr-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-xmark"></i> Cancelar
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>


        </form>
    </x-inicio>
</x-app-layout>
