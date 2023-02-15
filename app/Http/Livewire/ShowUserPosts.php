<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUserPosts extends Component
{
    use WithPagination;
    public string $buscar="", $campo="id", $orden="asc"; 

    public function render() 
    {
        $posts = Post::where('user_id', auth()->user()->id)   //(usuario=wer) AND (titulo=asd o contenido=sedfr)    
        ->where(function($query){
            $query->where('titulo', 'like', "%{$this->buscar}%")
            ->orWhere('contenido', 'like', "%{$this->buscar}%");
        })->orderBy($this->campo, $this->orden)->paginate(5);

        return view('livewire.show-user-posts', compact('posts'));
    }

    public function updatingBuscar(){
        $this->resetPage();
    }

    public function ordenar(string $campo){
        $this->orden=($this->orden=='asc') ? 'desc' : 'asc';
        $this->campo=$campo;
    }
}
