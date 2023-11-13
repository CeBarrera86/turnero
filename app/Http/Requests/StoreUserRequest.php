<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:30',
            'surname' => 'required|string|min:3|max:30',
            'role' => 'required|string',
            'username' => 'required|string|min:3|max:20|unique:users',
            'password' => 'required|min:4',
        ];
    }
}
