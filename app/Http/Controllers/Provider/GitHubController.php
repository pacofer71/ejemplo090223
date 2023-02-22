<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GitHubController extends Controller
{
    public function redirect(){
        return Socialite::driver('github')->redirect();
        
    }

    public function callback(){
        //Recuperamos el usuario que devuelve github
        $gitUser= Socialite::driver('github')->user();
        //comporbamos si el usuario existe, es decir si no hemos logeados antes,
        //si no exiete lo registramos si SI lo actualizamos con el nuevo token
        $usuario=User::where('external_provider', 'github')
        ->where('external_id', $gitUser->getId())->first();
        if($usuario){
            $usuario->update([
                'external_token'=>$gitUser->token,
                'external_refresh_token'=>$gitUser->refreshToken
            ]);
        }else{
           $usuario= User::create([
                'external_provider'=>'github',
                'external_id'=>$gitUser->getId(),
                'name'=>$gitUser->getName(),
                'email'=>$gitUser->getEmail(),
                'password'=>bcrypt('password'),
                'email_verified_at'=>now(), //solo es necesario si tenemos mustVerifyEmail
                'external_token'=>$gitUser->token,
                'external_refresh_token'=>$gitUser->refreshToken,
           ]);
        }
        Auth::login($usuario);
        return redirect('/');
        


    }
}
