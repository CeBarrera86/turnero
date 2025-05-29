<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
            'dni' => 'required|numeric|digits_between:7,10', // Entre 7 y 10 dígitos
        ];
    }

    public function messages()
    {
        return [
            'dni.required' => 'El campo DNI es requerido.',
            'dni.numeric' => 'El campo DNI debe ser numérico.',
            'dni.digits_between' => 'El campo DNI debe tener entre :min y :max dígitos.',
        ];
    }
}
