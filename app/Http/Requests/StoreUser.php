<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'username' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
            'name' => 'required',
            'gender' => 'required',
            'city' => 'required',
            'state' => 'required',
        ];
    }
}
