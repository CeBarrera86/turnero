<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route('user');
        return [
            'name' => 'required|string|min:3|max:30',
            'surname' => 'required|string|min:3|max:30',
            'role' => 'required|string',
            'username' => 'required|string|min:3|max:20|unique:users,username,' . $user->id,
            'password' => 'sometimes',
        ];
    }
}
