<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstadoRequest extends FormRequest
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
        $estado = $this->route('estado');

        return [
            'letra' => 'required|string|max:2|unique:estados,letra,'.$estado->id,
            'descripcion' => 'required|string|min:1|max:50',
        ];
    }
}
