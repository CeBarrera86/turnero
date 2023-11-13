<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectorRequest extends FormRequest
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
        $sector = $this->route('sectore');
        return [
            'letra' => 'required|string|max:3|unique:sectores,letra,'.$sector->id,
            'nombre' => 'required|string|max:30',
            'descripcion' => 'string|max:150',
        ];
    }
}
