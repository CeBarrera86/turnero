<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRolRequest extends FormRequest
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
        $rol = $this->route('role');
        return [
            'tipo' => 'required|string|max:15|unique:roles,tipo,' . $rol->id,
            'descripcion' => 'required|string|max:50',
        ];
    }
}
