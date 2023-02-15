<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;
    public bool $openCrear=false;
    public $imagen;
    public $titulo, $contenido, $estado;
    public $etiquetas;

    public function render()
    {
        $tags=Tag::pluck('nombre', 'id')->toArray();
        return view('livewire.create-post', compact('tags'));
    
    }

    public function cancelar(){
        $this->reset(['openCrear', 'titulo', 'contenido', 'estado', 'imagen']);
    }
}
