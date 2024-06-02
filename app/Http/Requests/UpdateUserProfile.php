<?php

namespace App\Http\Requests;

use App\Rules\AlphaSpaces;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $userId = Auth::id();

        return [
            'email' => [
                'required',
                //'unique:users',
                Rule::unique('users')->ignore($userId),
                'email'
            ],
            'name' => [
                'required',
                'max:50',
                new AlphaSpaces()
            ],
            'phone' => [
                'min:6'
            ]
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Podany adres email jest zajęty',
            'name.max' => 'Maksymalna ilość znaków to: :max'
        ];
    }
}
