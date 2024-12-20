<?php

namespace App\Http\Requests\Inscription;

use Illuminate\Foundation\Http\FormRequest;

class InformationAutresRequest extends FormRequest
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
        if ($this->has('rbq')) {
            $this->merge([
                'rbq' => str_replace('-', '', $this->input('rbq'))
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
            'rbq' => [
                'nullable',
                'digits:10',
            ],

            'documents' => [
                'nullable', 
                'array'
            ],

            'documents.*' => [
                'file', 
                'mimes:docx,doc,pdf,jpg,jpeg,xls,xlsx', 
                'max:75000'
            ],
        ];
    }

    public function messages()
    {
        return [
            'rbq.digits' => 'La licence RBQ doit contenir exactement 10 chiffres.',
            
            'documents.required' => 'Veuillez fournir au moins 1 document pour prouver l\'existence de votre entreprise.',
            'documents.array' => 'Les documents doivent être un tableau.',
    
            'documents.*.file' => 'Les documents fournis sont invalides.',
            'documents.*.mimes' => 'Chaque document doit être de type :values.',
            'documents.*.max' => 'Chaque document ne peut pas dépasser :max Ko.',
        ];
    }
}
