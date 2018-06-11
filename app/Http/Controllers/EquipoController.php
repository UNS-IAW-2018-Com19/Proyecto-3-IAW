<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\EquipoRequest;

use \App\Jugador;
use \App\Equipo;

class EquipoController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }
    
     public function create(){
        $jugadores = Jugador::all();
        $equipos = Equipo::all();

        return view('equipos',compact('jugadores','equipos'));
    }

    public function store(EquipoRequest $request){

        if(Auth::check()){
      
            $equipo = new Equipo;
            $equipo->id_equipo =(integer)$request['id_equipo'];
            $equipo->id_jugadorUno =(integer)$request['id_jugadorUno'];
            $equipo->id_jugadorDos =(integer)$request['id_jugadorDos'];
            $equipo->nombre =$request['nombre'];
            $equipo->logo =$request['logo'];
            $equipo->save();
        }  

       return redirect('/equipos/index');

    }
    
}
