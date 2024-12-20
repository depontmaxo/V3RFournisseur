<?php

namespace App\Http\Requests\Inscription;

use Illuminate\Foundation\Http\FormRequest;

class InformationContactsRequest extends FormRequest
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
        if ($this->has('numContact')) {
            $this->merge([
                'numContact' => str_replace('-', '', $this->input('numContact'))
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
            'prenom' => [
                'required', 
                'regex:/^[A-Za-zÀ-ÿ,\'\- ]*$/',
                'regex:/^(?!.*\s{2,}).*$/',
                'max:32'
            ],

            'nom' => [
                'required', 
                'regex:/^[A-Za-zÀ-ÿ,\'\- ]*$/',
                'regex:/^(?!.*\s{2,}).*$/',
                'max:32'
            ],

            'fonction' => [
                'nullable', 
                'regex:/^[A-Za-zÀ-ÿ\W_]*$/', 
                'max:32'
            ],

            'courrielContact' => [
                'required', 
                'email',
                'max:64', 
                'regex:/^[^\s\-\.](?!.*\.\.)(?!.*--)(?!.*\.\-|-\.).*[^-\.\s]$/u', // Empêche doubles points, tirets mal placés
                'regex:/^[^@\s]+@[^@\s]+\.[a-zA-Z]{2,}$/', // S'assure que le courriel a une extension valide
                'regex:/^[^-@]+@[^-@]+$/', // Empêche un tiret juste avant ou après le @
                'unique:contacts,email_contact'
            ],

            'numContact' => [
                'required', 
                'digits:10', 
                'integer'
            ],

            'posteTelContact' => [
                'nullable', 
                'digits_between:1,6'
            ],

            'typeTelContact' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'prenom.required' => 'Ce champ est obligatoire.',
            'prenom.regex' => 'Le prénom entrée est invalide.',
            'prenom.min' => 'Le prénom doit contenir au moins :min caractères.',
            'prenom.max' => 'Le prénom ne peut pas dépasser :max caractères.',
    
            'nom.required' => 'Ce champ est obligatoire.',
            'nom.regex' => 'Le nom entrée est invalide.',
            'nom.min' => 'Le nom doit contenir au moins :min caractères.',
            'nom.max' => 'Le nom ne peut pas dépasser :max caractères.',
    
            'fonction.required' => 'Ce champ est obligatoire.',
            'fonction.regex' => 'Le poste entrée est invalide.',
            'fonction.min' => 'Le poste doit contenir au moins :min caractères.',
            'fonction.max' => 'Le poste ne peut pas dépasser :max caractères.',
    
            'courrielContact.required' => 'Ce champ est obligatoire.',
            'courrielContact.min' => 'Le courriel doit contenir au moins :min caractères.',
            'courrielContact.max' => 'Le courriel ne peut pas dépasser :max caractères.',
            'courrielContact.regex' => 'L’adresse courriel est invalide.',
            'courrielContact.unique' => 'Ce courriel est déjà utilisé.',
            'courrielContact.email' => 'L’adresse courriel est invalide.',
    
            'numContact.required' => 'Ce champ est obligatoire.',
            'numContact.digits' => 'Le numéro de contact doit contenir exactement :digits chiffres.',
            'numContact.integer' => 'Le numéro de contact doit être un entier.',

            'typeTelContact.required' => 'Ce champ est obligatoire.',

            'posteTelContact.digits_between' => 'Le numéro de poste doit contenir uniquement des chiffres (entre 1 et 6 chiffres).',
            //'posteTelContact.digits_between' => 'Le poste ne peut pas dépasser :max caractères.',
        ];
    }
}
