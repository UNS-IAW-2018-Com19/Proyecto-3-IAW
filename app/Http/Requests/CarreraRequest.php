<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarreraRequest extends FormRequest
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
    public function rules(){
        return [
            'id_carrera' => 'required|integer|unique:carreras',
            'fecha' => 'required|integer|unique:carreras',
            'mapa' => 'required',
            'vueltas'=> 'required|integer',
        ];
    
    }


    public function messages(){
        return [
            'fecha.required' => 'Por favor ingresa la fecha de la carrera',
            'fecha.integer' => 'La fecha ingresada debe ser un numero',
            'fecha.unique' => 'Ya existe una carrera en esa fecha',
            'id_carrera.required' => 'Por favor ingresa el id de la carrera',
            'id_carrera.integer' => 'El id de carrera debe ser un numero',
            'id_carrera.integer' => 'Ya existe carrera con esa id',
            'mapa.required' => 'Por favor ingresa el mapa de la carrera',
            'vueltas.required' => 'Por favor ingresa el numero de vueltas',
            'vueltas.integer' => 'Las vueltas deben ser ingresadas con un numero',
            'descripcion.integer' => 'Sólo se permiten números en la id del Equipo',
        ];
    }
}
