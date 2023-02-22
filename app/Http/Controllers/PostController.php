<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $tags = Tag::pluck('nombre', 'id')->toArray();
          return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'=>['required', 'string', 'min:3', 'unique:posts,titulo'],
            'contenido'=>['required', 'string', 'min:5'],
            'estado'=>['required', 'in:Publicado,Borrador'],
            'imagen'=>['required', 'image', 'max:2048'],
            'etiquetas'=>['required', 'exists:tags,id']
        ]);
        //guardo la imagen y me quedo con la ruta
        $ruta=$request->imagen->store('posts');
        //guardo el post
        $post=Post::create([
            'titulo'=>$request->titulo,
            'contenido'=>$request->contenido,
            'estado'=>$request->estado,
            'user_id'=>auth()->user()->id,
            'imagen'=>$ruta
        ]);
        //Le asigno a ese posts todos los tags selecionados
        $post->tags()->attach($request->etiquetas);
        return redirect()->route('cposts.index')->with('info', 'Post Creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $cpost)
    {
        $this->authorize('update', $cpost);

        $tags = Tag::pluck('nombre', 'id')->toArray();
        $tagsSelected = $cpost->tags->pluck('id')->toArray();  // [1, 4, 5]
        return view('posts.edit', compact('cpost', 'tags', 'tagsSelected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $cpost)
    {

        $request->validate([
            'titulo'=>['required', 'string', 'min:3', 'unique:posts,titulo,'.$cpost->id],
            'contenido'=>['required', 'string', 'min:5'],
            'estado'=>['required', 'in:Publicado,Borrador'],
            'imagen'=>['nullable', 'image', 'max:2048'],
            'etiquetas'=>['required', 'exists:tags,id']
        ]);
        //borramos la imagen vieja si hemos subido otra
        if($request->imagen){
            Storage::delete($cpost->imagen);
            $cpost->imagen=$request->imagen->store('posts');
        }
        $cpost->update([
            'titulo'=>$request->titulo,
            'contenido'=>$request->contenido,
            'estado'=>$request->estado,
        ]);

        //post_tag
        $cpost->tags()->sync($request->etiquetas);
        return redirect()->route('cposts.index')->with('info', 'Post Actualizado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $cpost)
    {
        $this->authorize('delete', $cpost);
        
        Storage::delete($cpost->imagen);
        $cpost->delete();
        return redirect()->route('cposts.index')->with('info', 'Post Borrado');
    }
}
