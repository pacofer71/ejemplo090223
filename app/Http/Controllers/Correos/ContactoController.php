<?php

namespace App\Http\Controllers\Correos;

use App\Http\Controllers\Controller;
use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\Email;

class ContactoController extends Controller
{
    public function index(){
        //pintamos el form de contacto
        return view('fcontacto.index');
    }

    public function send(Request $request){
        //procesamos los datos y enviamos el correo
        $array1=[
            'nombre'=>['required', 'string', 'min:3'],
            'contenido'=>['required', 'string', 'min:10'],
        ];

        if(!auth()->user()){
            $array2=['email' =>['required','email']];
            $array1 =array_merge($array1, $array2);
            
        }
        //dd($array1);
        $request->validate($array1);
        
        try{
            Mail::to('admin@misitio.org')->send(new ContactoMailable($request->all()));
            return redirect()->to('/')->with('info', 'Mensaje enviado');
        }catch(\Exception $ex){
            return redirect()->to('/')->with('info', 'No se pudo enviar el mensaje');
        }


    }
}
