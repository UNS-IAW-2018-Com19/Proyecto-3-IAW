<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CarreraRequest;

use Illuminate\Support\Facades\Auth;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use \App\Carrera;
use \App\Jugador;
use \App\Equipo;
use \App\Imagen;

class CarreraController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }
    

    public function create($view){
        
        $jugadores = Jugador::all();
        $equipos = Equipo::all();
        $carreras = Carrera::all();
        $imagenes = Imagen::all();

        $rutas = array("/agregar/carrera","/modificar/carrera","/eliminar/carrera");
        $name = "Carrera";
    
        return view($view,compact('jugadores','equipos','rutas', 'carreras', 'name', 'imagenes'));
 
    }

    public function store(Request $request){
        $idCarrera=(integer)$request['id_carrera']; 
        $fechaCarrera=(integer)$request['fecha'];
    
        $EncontrarCarrera=Carrera::where('id_carrera',$idCarrera)->first();

        if ($EncontrarCarrera!==null){
            return redirect('/agregar/carrera')->withErrors([
                'id_carrera' => 'La ID de la carrera ya existe'
            ]);
        }
        
        $CarreraConFecha = Carrera::where('fecha',$fechaCarrera)->first();
        if ($CarreraConFecha!==null){
             return  redirect('/agregar/carrera')->withErrors([
                'fecha' => 'Ya existe una carrera en esa fecha'
            ]);        
        }

   /*     if($request->has('checkCompletada')){*/
                $completada='true';    

                //Primero revisaremos que no haya jugadores duplicados en las posiciones                
                $checkDuplicate=array();
                for ($i = 1; $i <= 12; $i++) {
                    $username = 'username'.$i;
                    array_push($checkDuplicate,$request[$username]);
                }
                //De ser asi, envio un error
                if(count($checkDuplicate) !== count(array_unique($checkDuplicate))){
                    $error = \Illuminate\Validation\ValidationException::withMessages([
                        'Posiciones' => ['No puede haber jugadores repetidos en las posiciones de la carrera'],  
                    ]);
                    throw $error;
                }
                //Asigna ids de jugadores junto con su puntaje, segun el username y la posicion. 
                $jugadores= Jugador::all();
                $posiciones=array();
                $puntaje = 15;

                for ($i = 1; $i <= 12; $i++) {
                    $username = 'username'.$i;
                    $jugadorConcreto=$jugadores->firstWhere('userName',$request[$username]);
                    array_push($posiciones, array(array("jugador" =>$jugadorConcreto->id_jugador, "puntaje" => $puntaje))); 
                    $puntaje--;   
                }  
   /*      }
       else{
            $completada='false';   
            return redirect('/agregar/carrera')->withErrors([
                'message' => 'La carrera no está completada'
            ]);        
        }*/

        $carrera = new Carrera;
        $carrera->id_carrera = (integer)request('id_carrera');
        $carrera->fecha = (integer)request('fecha');
        $carrera->mapa = request('mapa');
        $carrera->fotoMapa = request('fotoMapa');
        $carrera->vueltas = request('vueltas');
        $carrera->completada = $completada;
        $carrera->save();

       return redirect('/agregar/carrera');

    }

    public function delete(Request $request){
        if(Auth::check()){
            $id = (integer)$request['id'];
            $carrera = Carrera::find($id);
            $carrera->delete();
        }
    }
}
