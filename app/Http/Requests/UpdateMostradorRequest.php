<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMostradorRequest extends FormRequest
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
        $mostrador = $this->route('mostradore');
        return [
            'numero' => 'required|integer',
            'ip' => 'required|ipv4|unique:mostradores,ip,'.$mostrador->id,
            'alfa' => 'string|max:4',
            'tipo' => 'string|max:10',
            'sector' => 'required|string',
        ];
    }
}
