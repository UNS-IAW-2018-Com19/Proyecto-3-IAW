<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use \App\User;


class UserController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }

    public function create($view){
        
        $usuarios = User::all();

        $rutas = array("/agregar/usuario","/modificar/usuario","/eliminar/usuario");
        $name = "Usuario";
        return view($view,compact('usuarios','name','rutas'));

    }

    public function update (Request $request){
        if(Auth::check()){
            $oldUserName = $request['usernameViejo'];
            $username = $request['username'];
            $editor = $request['editor'];

            $user = User::where('username',$oldUserName)->first();

            if($username != null && $username != $oldUserName)
                $user->username = $username;
            
            if($editor != null){
                $user->editor = $editor;
            }
            $user->save();
            return redirect("/modificar/usuario");
        }
    }

    public function delete(Request $request){
        if(Auth::check()){
            $id = $request['id'];
            $user = User::find($id);
            $user->delete();
            return redirect("/eliminar/jugador");
        }
    }

}