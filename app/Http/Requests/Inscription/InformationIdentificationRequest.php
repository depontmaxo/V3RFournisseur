<?php

namespace App\Http\Requests\Inscription;

use Illuminate\Foundation\Http\FormRequest;

class InformationIdentificationRequest extends FormRequest
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

            'neq' => [
                'nullable',
                'required_without:courrielConnexion', // La valeur est obligatoire.
                'string',   // La valeur doit être une chaîne de caractères.
                'unique:utilisateur,neq',
                
                function ($attribute, $value, $fail) {
                    // Suppression des espaces pour valider le contenu réel
                    $cleanedValue = preg_replace('/\s+/', '', $value);
        
                    // Vérification : le champ est-il bien de 10 chiffres, commence-t-il par 11, 22, 33 ou 88 ?
                    if (!preg_match('/^(11|22|33|88)\d{8}$/', $cleanedValue)) {
                        if (!preg_match('/^\d+$/', $cleanedValue)) {
                            $fail('Le champ NEQ ne doit contenir que des caractères numériques.');
                        } elseif (strlen($cleanedValue) !== 10) {
                            $fail('Le champ NEQ doit être composé exactement de 10 caractères numériques.');
                        } elseif (!preg_match('/^(11|22|33|88)/', $cleanedValue)) {
                            $fail('Le champ NEQ doit commencer par 11, 22, 33 ou 88.');
                        } else {
                            $fail('Le champ NEQ n’est pas conforme.');
                        }
                    }
                },
            ],

            'courrielConnexion' => [
                'nullable',
                'required_without:neq',
                'email',
                'max:64', 
                'regex:/^[^\s\-\.](?!.*\.\.)(?!.*--)(?!.*\.\-|-\.).*[^-\.\s]$/u', // Empêche doubles points, tirets mal placés
                'regex:/^[^@\s]+@[^@\s]+\.[a-zA-Z]{2,}$/', // S'assure que le courriel a une extension valide
                'regex:/^[^-@]+@[^-@]+$/', // Empêche un tiret juste avant ou après le @
                'unique:utilisateur,email'
            ],
            'password' => [
                'required', 
                'string',
                'min:7', 
                'max:12', 
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{7,12}$/',
                'confirmed',
                'regex:/^[^\s]*$/' //Vérifie qu'il ne contient aucun espace dans le string
                ]
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
    
            'neq.required_without' => 'Le champ NEQ est obligatoire si le champ courriel n\'est pas renseigné.',
            'neq.unique' => 'Ce code NEQ est déjà utilisé.',
            'neq.regex' => 'Le code NEQ doit être composé de 10 caractères numériques et commencer par 11, 22, 33 ou 88.',
            'neq.numeric' => 'Le code NEQ ne doit contenir que des chiffres.',
            'neq.invalid_format' => 'Le code NEQ n’est pas valide. Assurez-vous qu’il est au bon format et sans caractères spéciaux.',
            'neq.no_spaces' => 'Le code NEQ ne doit pas contenir d’espaces inutiles.',
            'neq.invalid_prefix' => 'Le code NEQ doit commencer par 11, 22, 33 ou 88.',
            'neq.length' => 'Le code NEQ doit être exactement composé de 10 caractères.',
    
            'courrielConnexion.required_without' => 'L’adresse courriel est obligatoire si le champ NEQ n\'est pas renseigné.',
            'courrielConnexion.email' => 'L’adresse courriel est invalide. Assurez-vous qu’elle respecte les règles.',
            'courrielConnexion.max' => 'L’adresse courriel ne peut pas dépasser :max caractères.',
            'courrielConnexion.regex' => 'L’adresse courriel est invalide. Assurez-vous qu’elle respecte les règles.',
            'courrielConnexion.unique' => 'L’adresse courriel est déjà utilisé.',
    
            'password.required' => 'Ce champ est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.max' => 'Le mot de passe ne peut pas dépasser :max caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.regex' => 'Le mot de passe n’est pas valide.',
        ];
    }
}

