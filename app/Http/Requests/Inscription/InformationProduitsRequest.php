<?php

namespace App\Http\Requests\Inscription;

use Illuminate\Foundation\Http\FormRequest;

class InformationProduitsRequest extends FormRequest
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
            'selected_codes' => [
                'required',        // Ensure it’s provided
                'json',            // Ensure it’s a valid JSON string
                function ($attribute, $value, $fail) {  // Custom validation to decode and check if the value is an array
                    $decoded = json_decode($value, true);
                    if (!is_array($decoded)) {
                        $fail("The $attribute must be a valid JSON array.");
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'selected_codes.required' => 'Vous devez sélectionner au moins un code.',
            'selected_codes.json' => 'Le format des codes sélectionnés est invalide.',
        ];
    }
}
