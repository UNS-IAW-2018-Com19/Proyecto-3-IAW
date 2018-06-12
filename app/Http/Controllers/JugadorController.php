<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\JugadorRequest;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

use Jenssegers\Mongodb\Eloquent\Builder;

use \App\Jugador;
use \App\Equipo;




class JugadorController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }


    public function create($view){

        $jugadores = Jugador::all();
        $equipos = Equipo::all();

        $rutas = array("/agregar/jugador","/modificar/jugador","/eliminar/jugador");
        $name = "Jugador";
    
        return view($view,compact('jugadores','equipos','rutas', 'name'));
    }

    public function store (Request $request){
        if(Auth::check()){
            $jugador = new Jugador;
            $jugador->userName = $request['username'];
            $jugador->id_jugador = (integer)$request['id_jugador'];
            
            $glider = $request['glider'];
            $kart = $request['kart'];
            $ruedas =  $request['ruedas'];

            $arr = array("kart" => $kart, "ruedas" => $ruedas, "glider" => $glider);
            
            $jugador->vehiculo = $arr;

            /** avatar y foto */
            
            $jugador->save();          

            $jugadores = Jugador::all();
            $equipos = Equipo::all();
            $ok = true;
            $name = 'Jugador';

            return view('agregar', compact('jugadores', 'equipos', 'ok','name'));
        }
    }
    
    public function update(Request $request){
        if(Auth::check()){
                $oldUserName = $request['usernameViejo'];
                $username = $request['username'];
                $personaje = $request['personaje'];
                $avatar = $request['avatar'];

                $player = Jugador::where('userName', $oldUserName)->first();

                $check = Jugador::where('userName', $username)->first();

                if($check != null)
                    return redirect("/modificar/jugador")->withErrors([
                        'message' => 'No se permite repetir el mismo username para dos jugadores'
                    ]);; 
              
                if($username != null && $username != $oldUserName)
                    $player->userName = $username;
                            
                if($personaje != null)
                    $player->personaje= $personaje;
                    
                if($avatar != null)
                    $player->avatar= $avatar;
                

                $player->save();

                return redirect("/modificar/jugador");

        }
    }

    public function delete(Request $request){
        if(Auth::check()){
                $id = (integer)$request['id'];
                $player = Jugador::find($id);


                if($equipo = Equipo::where('id_jugadorUno',$id)->first())
                    $equipo->unset('id_jugadorUno');
                else
                if($equipo = Equipo::where('id_jugadorDos',$id)->first())
                    $equipo->unset('id_jugadorDos');
                $equipo->save();


                $player->delete();

                return redirect("/eliminar/jugador");
        }
    }
}
