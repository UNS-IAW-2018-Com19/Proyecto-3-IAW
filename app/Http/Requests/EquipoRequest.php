<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;

class EquipoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
         return [

            'id_equipo' => 'required|integer|unique:equipos',
            'id_jugadorUno' => 'required|integer|unique:equipos|unique:equipos,id_jugadorDos',
           'id_jugadorDos' => 'required|integer|unique:equipos|unique:equipos,id_jugadorUno',
           'nombre' => 'required|min:3|unique:equipos',
           'logo' => 'required|unique:equipos', 
            
        ];
    }

    public function messages(){
        
        return [
            'nombre.required' => 'Por favor ingresa el nombre del equipo',
            'id_equipo.required' => 'Por favor ingresa el id del equipo',
            'id_jugadorUno.required' => 'Por favor ingresa el id del Jugador Uno',
            'id_jugadorDos.required' => 'Por favor ingresa el id del Jugador Dos',
            'logo.required' => 'Por favor ingresa el logo del equipo',
            'id_equipo.integer' => 'Sólo se permiten números en la id del Equipo',
            'id_jugadorUno.integer' => 'Sólo se permiten números en la id del Jugador Uno',
            'id_jugadorDos.integer' => 'Sólo se permiten números en la id del Jugador Dos',
            'nombre.min' => 'El nombre debe ser de al menos 3 caracteres',
            'nombre.unique' => 'Ya existe un equipo con ese nombre',
            'id_equipo.unique' => 'Ya existe un equipo con esa id',
            'id_jugadorUno.unique' => 'Ya existe un jugador con esa id en otro equipo (Jugador Uno)',
            'id_jugadorDos.unique' => 'Ya existe un jugador con esa id en otro equipo (Jugador Dos)',
            
        ];
    }
}
