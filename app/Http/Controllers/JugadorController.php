<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
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
    
        return view($view,compact('jugadores','equipos','rutas'));
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
            
            $jugador->save();          

            $jugadores = Jugador::all();
            $equipos = Equipo::all();
            $ok = true;

            return view('agregar', compact('jugadores', 'equipos', 'ok'));
        }
    }
    
    public function update(Request $request){
        dd($request);
        if(Auth::check()){
                $username = $request['username'];
                $jugador = $request['jugador'];
                $avatar = $request['avatar'];

                $jugadores = Jugador::all();

        }
    }
}
