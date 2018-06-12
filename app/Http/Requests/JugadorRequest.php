<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JugadorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_jugador' => 'required|integer',
            'userName' => 'required|unique:jugadores',
            'personaje' => 'required',
            'glider'=> 'required',
            'ruedas'=>'required',
            'kart'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'id_jugador.required' => 'Por favor ingresa el id del jugador',
            'id_jugador.integer' => 'El id del jugador debe ser un numero',
            'userName.required' => 'Por favor ingresa el username del jugador',
            'userName.unique' => 'Ya existe un jugador con ese username',
            'personaje.required' => 'Por favor ingresa el personaje favorito del jugador',
            'glider.required' => 'Por favor ingresa el glider del vehiculo',
            'ruedas.required' => 'Por favor ingresa las ruedas del vehiculo',
            'kart.required' => 'Por favor ingresa el kart del vehiculo',  
        ];
    }
}
