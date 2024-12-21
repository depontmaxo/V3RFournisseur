<?php

namespace App\Http\Requests\Inscription;

use Illuminate\Foundation\Http\FormRequest;

class InformationModificationNomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        if ($this->has('neq')) {
            $this->merge([
                'neq' => str_replace(' ', '', $this->input('neq'))
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'entreprise' => [
                'required', 
                'min:5', 
                'max:75', 
                'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/', //Vérifie qu'il n'y a plusieurs espaces un après l'autre
                'unique:utilisateur,nom_entreprise'
            ],
        ];
    }

    public function messages()
    {
        return [
            'entreprise.required' => 'Ce champ est obligatoire.',
            'entreprise.min' => 'Le champ entreprise doit contenir au moins :min caractères.',
            'entreprise.max' => 'Le champ entreprise ne peut pas dépasser :max caractères.',
            'entreprise.regex' => 'Le champ entreprise ne doit pas contenir d\'espaces consécutifs.',
            'entreprise.unique' => 'Ce nom d\'entreprise est déjà utilisé.',
        ];
    }
}

