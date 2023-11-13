<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMostradorRequest extends FormRequest
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
            'numero' => 'required|integer|unique:mostradores',
            'ip'=> 'required|ipv4|unique:mostradores',
            'alfa'=> 'string|max:4',
            'tipo'=> 'string|max:10',
            'sector' => 'required|string',
        ];
    }
}
