<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConnexionRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'neq' =>'min:1',
            'email' =>'email',
            'password' => 'required|min:4|max:12'
        ];
    }
    public function messages()
    {
        return
        [
            'neq.min' => 'Le NEQ doit contenir min 1 caractères',
            'password.min' => 'Le password doit contenir min 4 caractères',
            'password.max' => 'Le password doit contenir min 12 caractères',
        ];
    }
}

