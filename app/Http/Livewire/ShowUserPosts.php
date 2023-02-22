<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowUserPosts extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public string $buscar="", $campo="id", $orden="asc"; 
    public $imagen;
    public bool $openEditar=false;
    public Post $post;
    public array $selectedTags=[];

    protected $listeners=[
        'render',
    ];

    protected $rules=[
        'post.titulo'=>'',
        'post.contenido'=>'',
        'post.estado'=>'',
    ];
    

    public function mount(){
        $this->post=new Post;
    }

    public function render() 
    {
        $posts = Post::where('user_id', auth()->user()->id)   //(usuario=wer) AND (titulo=asd o contenido=sedfr)    
        ->where(function($query){
            $query->where('titulo', 'like', "%{$this->buscar}%")
            ->orWhere('contenido', 'like', "%{$this->buscar}%");
        })->orderBy($this->campo, $this->orden)->paginate(5);

        $tags=Tag::pluck('nombre', 'id')->toArray();
    

        return view('livewire.show-user-posts', compact('posts', 'tags'));
    }

    public function updatingBuscar(){
        $this->resetPage();
    }

    public function ordenar(string $campo){
        $this->orden=($this->orden=='asc') ? 'desc' : 'asc';
         $this->campo=$campo;
    }

    public function borrar(Post $post){
        $this->authorize('delete', $post);
        Storage::delete($post->imagen);
        $post->delete();
        //$this->resetPage();
    }

    public function editar(Post $post){

        $this->authorize('update', $post);

        $this->post=$post;
        $this->selectedTags=$post->tags->pluck('id')->toArray();
        $this->openEditar=true;
    }

    public function cancelar(){
        $this->reset(['openEditar', 'imagen']);
        $this->post=new Post;
        
    }

    public function update(){
        
        $this->validate([
            'post.titulo'=>['required', 'string', 'min:3', 'unique:posts,titulo,'.$this->post->id],
            'post.contenido'=>['required', 'string', 'min:5'],
            'post.estado'=>['required', 'in:Publicado,Borrador'],
            'imagen'=>['nullable', 'image', 'max:2048'],
            'selectedTags'=>['required', 'exists:tags,id']
        ]);

        //si he subido imagen borro la vieja actualizo la ruta con la nueva
        if($this->imagen){
            Storage::delete($this->post->imagen);
            $this->post->imagen=$this->imagen->store('posts');
        }
        $this->post->save();
        $this->post->tags()->sync($this->selectedTags);
        $this->cancelar();


    }
}
