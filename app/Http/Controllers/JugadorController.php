<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use \App\Jugador;




class JugadorController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }


    public function create(){

        $jugadores = Jugador::all();

        return view('jugadores',compact('jugadores'));
    }

    public function store (Request $request){
        if(Auth::check()){
            $jugador = new Jugador;
            $jugador->userName = $request['username'];
            $jugador->id_jugador = (integer)$request['id_jugador'];
            $jugador->save();   
            return redirect('/jugadores');
        }
    }
 
}
