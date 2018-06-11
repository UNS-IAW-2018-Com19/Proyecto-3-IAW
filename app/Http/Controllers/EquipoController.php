<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\EquipoRequest;

use \App\Jugador;
use \App\Equipo;

class EquipoController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function create($view){
        $jugadores = Jugador::all();
        $equipos = Equipo::all();

        $rutas = array("/agregar/equipo","/modificar/equipo","/eliminar/equipo");
        $name = "Equipo";
    
        return view($view,compact('jugadores','equipos','rutas', 'name'));
    }

    public function store(EquipoRequest $request){
        if(Auth::check()){
            $jugador1 = (integer)$request['jugador1'];
            $jugador2 = (integer)$request['jugador2'];
            $idequipo =(integer)$request['id_equipo'];
            
            $chequear = Equipo::find($idequipo);
            
            if($chequear == null){
                $equipo = new Equipo;
                $equipo->id_equipo = $idequipo;
                $equipo->id_jugadorUno = $jugador1;
                $equipo->id_jugadorDos = $jugador2;
                $equipo->nombre =$request['nombre'];
                $equipo->logo =$request['logo'];

                /** Actualizo el equipo del jugador */
                $player1 = Jugador::find($jugador1);
                $player1->id_equipo = $idequipo;

                $player2 = Jugador::find($jugador2);
                $player2->id_equipo = $idequipo;
                $player1->save();
                $player2->save();
                $equipo->save();
            }
            else{
                redirect('/agregar/equipo')->withErrors([
                    'message' => 'La ID del equipo ya existe'
                ]);;
            }
        }  

       return redirect('/agregar/equipo');

    }

    public function update(Request $request){
        if(Auth::check()){
            $newname = $request['nombre'];
            $newlogo = $request['logo'];  
            $oldName = $request['nombreViejo'];   
            $namejugador1 = $request['jugadorone'];
            $namejugador2 = $request['jugadortwo'];    


            $equipo = Equipo::where('nombre', $oldName)->first();
        
            $playerone = Jugador::where('userName', $namejugador1)->first();

            $playertwo = Jugador::where('userName', $namejugador2)->first();

            if($newname != null && $newname != $oldName)
                $equipo->nombre = $newname;
            
            if($newlogo != null && $newlogo != $equipo->logo)
                $equipo->logo = $newlogo;

            if($playerone != null && $playerone->id_equipo == null){
                $equipo->id_jugadorUno = $playerone->id_jugador;
                $playerone->id_equipo = $equipo->id_equipo;
                $playerone->save();
            }

            if($playertwo != null && $playertwo->id_equipo == null){
                $equipo->id_jugadorDos = $playertwo->id_jugador;
                $playertwo->id_equipo = $equipo->id_equipo;
                $playertwo->save();
            }        
        
            $equipo->save();

            return redirect("/modificar/equipo");
        }
       
    }
    
    public function delete(Request $request){
        if(Auth::check()){
            $id = (integer)$request['id'];
            $equipo = Equipo::find($id);


            $player1 = Jugador::find($equipo->id_jugadorUno);
            $player2 = Jugador::find($equipo->id_jugadorDos);

            if($player1 != null){
                    $player1->unset('id_equipo');    
                    $player1->save();
            }
            else
                if($player2 != null){
                    $player2->unset('id_equipo');
                    $player2->save();
                }
            
            $equipo->delete();

            return redirect("/eliminar/equipo");
        }
    }
}
