<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')
            ],
            'password' => ['required', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "The name field is required",
            'email.required' => "The email field is required",
            'email.email' => "The value is not a valid email address",
            'email.unique' => "The email has already been taken",
            'password.required' => "The password field is required",
            'password.min' => "The password must be at least 8 characters",
            'password.regex' => "The password must contain at least one letter and one number",
        ];
    }
}
