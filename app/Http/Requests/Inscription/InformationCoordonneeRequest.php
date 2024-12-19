<?php

namespace App\Http\Requests\Inscription;

use Illuminate\Foundation\Http\FormRequest;

class InformationCoordonneeRequest extends FormRequest
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
        if ($this->has('numTel')) {
            $this->merge([
                'numTel' => str_replace('-', '', $this->input('numTel'))
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
            'Ncivique' => [
                'required',
                'max:8',
                'alpha_num',
            ], 

            'rue' => [
                'required',
                'max:64',
                'regex:/^[a-zA-Z0-9\s\-.,;:!()&]*$/', // Alphanumérique et certains caractères spéciaux
            ], 

            'bureau' => [
                'nullable', 
                'max:8',
                'alpha_num',
            ], 

            'ville' => [
                'required_without:ville-autre',
                //'regex:/^[A-Za-zÀ-ÿ0-9]+(?:[- ][A-Za-zÀ-ÿ0-9]+)*$/', // Acceptation des lettres accentuées
                'max:64',
                'required_if:province,Québec'
            ], 

            'ville-autre' => [
                'required_without:ville', 
                //'regex:/^[A-Za-zÀ-ÿ0-9]+(?:[- ][A-Za-zÀ-ÿ0-9]+)*$/', // Acceptation des lettres accentuées
                'max:64',
                'required_if:province,!Québec'
            ], 

            'province' => [
                'required', 
                'min:3', 
                'max:25', 
                'regex:/^[A-Za-zÀ-ÿ0-9\s\-]*$/' // Acceptation des lettres accentuées, espaces et tirets
            ], 

            'codePostal' => [
                'required', 
                'regex:/^[A-Za-z]\d[A-Za-z]\s?\d[A-Za-z]\d$/'
            ],

            'site' => [
                'nullable', 
                'url'
            ],

            'numTel' => [
                'required', 
                'digits:10', 
            ],

            'posteTel' => [
                'nullable', 
                'digits_between:1,6'
            ],

            'typeContact' => [
                'required', 
            ],
        ];
    }

    public function messages()
    {
        return [
            'rue.required' => 'Ce champ est obligatoire.',
            'rue.max' => 'Le nom de la rue ne peut pas dépasser 64 caractères.',
            'rue.regex' => 'Le nom de la rue peut contenir uniquement des lettres, des chiffres, des espaces et certains caractères spéciaux (comme - . , ; : ! () &).',

            'Ncivique.required' => 'Ce champ est obligatoire.',
            'Ncivique.max' => 'Le numéro civique ne peut pas dépasser 8 caractères.',
            'Ncivique.alpha_num' => 'Le numéro civique doit contenir uniquement des lettres et des chiffres.',
    
            'bureau.regex' => 'Le format du bureau est invalide.',
            'bureau.max' => 'Le bureau ne peut pas dépasser :max caractères.',
    
            'ville.required_without' => 'Ce champ est obligatoire.',
            'ville.regex' => 'Le format de la ville est invalide.',
            'ville.min' => 'La ville doit contenir au moins :min caractères.',
            'ville.max' => 'La ville ne peut pas dépasser :max caractères.',

            'ville-autre.required_without' => 'Ce champ est obligatoire.',
            'ville-autre.regex' => 'Le format de la ville est invalide.',
            'ville-autre.min' => 'La ville doit contenir au moins :min caractères.',
            'ville-autre.max' => 'La ville ne peut pas dépasser :max caractères.',
    
            'province.required' => 'Ce champ est obligatoire.',
            'province.min' => 'La province doit contenir au moins :min caractères.',
            'province.max' => 'La province ne peut pas dépasser :max caractères.',
            'province.regex' => 'Le format de la province est invalide.',
    
            'codePostal.required' => 'Ce champ est obligatoire.',
            'codePostal.regex' => 'Le format du code postal est invalide.',
    
            'site.url' => 'Le champ site doit être une URL valide.',
    
            'numTel.required' => 'Ce champ est obligatoire.',
            'numTel.digits' => 'Le numéro de téléphone doit contenir exactement 10 chiffres.',

            'posteTel.digits_between' => 'Le numéro de poste doit contenir uniquement des chiffres (entre 1 et 6 chiffres).',
            //'posteTel.max' => 'Le poste ne peut pas dépasser :max caractères.',

            'typeContact.required' => 'Ce champ est obligatoire.',
        ];
    }
}
