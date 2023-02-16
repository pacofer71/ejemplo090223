<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;
    public bool $openCrear=false;
    public $imagen;
    public $titulo, $contenido, $estado;
    public array $etiquetas=[];

    protected $rules=[
        'titulo'=>['required', 'string', 'min:3', 'unique:posts,titulo'],
        'contenido'=>['required', 'string', 'min:5'],
        'estado'=>['required', 'in:Publicado,Borrador'],
        'imagen'=>['required', 'image', 'max:2048'],
        'etiquetas'=>['required', 'exists:tags,id']
    ];

    public function render()
    {
        $tags=Tag::pluck('nombre', 'id')->toArray();
        return view('livewire.create-post', compact('tags'));
    
    }

    public function cancelar(){
        $this->reset(['openCrear', 'titulo', 'contenido', 'estado', 'imagen']);
    }

    public function guardar(){
        $this->validate();
        //guardamos la imagen
        $ruta=$this->imagen->store('posts');
        //Guardamos el registro
        $post=Post::create([
            'titulo'=>$this->titulo,
            'contenido'=>$this->contenido,
            'estado'=>$this->estado,
            'user_id'=>auth()->user()->id,
            'imagen'=>$ruta
        ]);
        //guardamos en la tabla post_tag las etiquetas de este post
        $post->tags()->attach($this->etiquetas);
        
        $this->cancelar();
        $this->emitTo('show-user-posts', 'render');


    }
}
