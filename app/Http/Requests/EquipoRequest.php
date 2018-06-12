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
            'id_equipo' => 'required|integer',
            'nombre' => 'required|min:3|unique:equipos',
            'logo' => 'required|unique:equipos',   
        ];
    }

    public function messages(){
        
        return [
            'nombre.required' => 'Por favor ingresa el nombre del equipo',
            'logo.required' => 'Por favor ingresa el logo del equipo',
            'nombre.min' => 'El nombre debe ser de al menos 3 caracteres',
            'nombre.unique' => 'Ya existe un equipo con ese nombre',
        ];
    }
}
