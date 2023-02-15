<div>
    <button wire:click="$set('openCrear', true)"
        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-add"></i> Nuevo
    </button>
    @php $size='2xl' @endphp
    <x-jet-dialog-modal :maxWidth="$size" wire:model="openCrear">
        <x-slot name="title">
            Crear Post
        </x-slot>
        <x-slot name="content">
            @wire('defer')
            <x-form-input name="titulo" label="Título" placeholder="Título" />
            <x-form-textarea name="contenido" placeholder="Contenido" label="Contenido" />
            <x-form-group name="estado" label="Estado del Post (Publicado/Borrador)" inline>
                <x-form-radio name="estado" value="Publicado" label="Publicado" />
                <x-form-radio name="estado" value="Borrador" label="Borrador" />
            </x-form-group>
            @endwire
            <x-form-group inline label="Etiquetas">
                @foreach ($tags as $k => $v)
                    <x-form-checkbox name="" label="{{ $v }}" value="{{ $k }}" />
                @endforeach
            </x-form-group>
            <div class="relative my-4">
                @if ($imagen)
                    <img src="{{ $imagen->temporaryUrl() }}" class="object-cover object-center">
                    <button wire:click="$set('imagen')"
                        class="absolute right-2 bottom-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Cambiar
                        Imagen
                    </button>
                @else
                    <img src="{{ Storage::url('noimage.png') }}" class="object-cover object-center">
                    <label for="imgc"
                        class="absolute right-2 bottom-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Seleccionar
                        Imagen</label>
                @endif
                <input type="file" class="hidden" wire:model.defer="imagen" id="imgc" />

            </div>

        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <button wire:click="cancelar" 
                class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-xmark"></i> Cancelar
                </button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
