<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Requests\Inscription\InformationCoordonneeRequest;
use Illuminate\Support\Facades\Validator;

class InformationCoordonneeRequestTest extends TestCase
{
    /**
     * Teste si les règles de validation refusent les entrées incorrectes.
     */
    public function test_validation_fails_with_invalid_data()
    {
        $data = [
            'Ncivique' => '12345678901',  // Trop long (max: 8 caractères)
            'rue' => '123 Rue Main $$$',  // Caractères spéciaux non permis
            'bureau' => 'bonjour %)',     // Caractères spéciaux non permis
            'numTel' => '123456789',      // Trop court (10 chiffres requis)
            'codePostal' => 'A1B 2C',     // Code postal invalide
            'ville' => '',                // Ville manquante, mais obligatoire
            'province' => 'AB',           // Province trop courte (min: 3 caractères)
            'typeContact' => '',          // typeContact est vide, mais obligatoire
            'posteTel' => '1234567',      // Doit contenir entre 1 et 6 chiffres
            'site' => 'invalid-url',      // URL invalide
        ];

        $request = new InformationCoordonneeRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());

        $expectedErrors = [
            'Ncivique' => 'Le numéro civique ne peut pas dépasser 8 caractères.',
            'rue' => 'Le nom de la rue peut contenir uniquement des lettres, des chiffres, des espaces et certains caractères spéciaux (comme - . , ; : ! () &).',
            'bureau' => 'Le bureau doit contenir uniquement des lettres et des chiffres.',
            'numTel' => 'Le numéro de téléphone doit contenir exactement 10 chiffres.',
            'codePostal' => 'Le format du code postal est invalide.',
            'ville' => 'Ce champ est obligatoire.',
            'province' => 'La province doit contenir au moins 3 caractères.',
            'typeContact' => 'Ce champ est obligatoire.',
            'posteTel' => 'Le numéro de poste doit contenir uniquement des chiffres (entre 1 et 6 chiffres).',
            'site' => 'Le champ site doit être une URL valide.',
        ];

        foreach ($expectedErrors as $field => $expectedError) {
            $this->assertTrue($validator->errors()->has($field), "Erreur attendue sur le champ: $field");
        }
    }

    /**
     * Teste si les règles de validation acceptent les données valides.
     */
    public function test_validation_passes_with_valid_data()
    {
        $data = [
            'Ncivique' => '1234ABCD',      // Valide
            'rue' => '123 Rue Main!',      // Valide
            'numTel' => '1234567890',      // 10 chiffres
            'codePostal' => 'A1B 2C3',     // Code postal valide
            'ville' => 'Montréal',         // Ville valide
            'province' => 'Québec',        // Province valide
            'typeContact' => 'Bureau',
            'site' => 'https://example.com', // URL valide
        ];

        $request = new InformationCoordonneeRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->fails());
    }

    /**
     * Teste la transformation des données dans prepareForValidation.
     */
    public function test_prepare_for_validation_removes_special_characters_from_numTel()
    {
        $data = [
            'numTel' => '123-456-7890',  // Le numéro contient des tirets
        ];

        $request = new InformationCoordonneeRequest();
        $request->merge($data);
        $request->prepareForValidation();

        // Vérifier que les tirets ont été enlevés
        $this->assertEquals('1234567890', $request->input('numTel'));
    }

    public function test_prepare_for_validation_removes_spaces_from_codePostal()
    {
        $data = [
            'codePostal' => 'A1B 2C3',  // Le code postal contient des espaces
        ];

        $request = new InformationCoordonneeRequest();
        $request->merge($data);
        $request->prepareForValidation();

        // Vérifier que les espaces ont été enlevés
        $this->assertEquals('A1B2C3', $request->input('codePostal'));
    }

    /**
     * Teste pour des champs facultatifs.
     */
    public function test_optional_fields_validation()
    {
        $data = [
            'Ncivique' => '1234ABCD',  // Obligatoire et valide
            'rue' => '123 Rue Main',   // Obligatoire et valide
            'bureau' => '',            // Optionnel
            'numTel' => '1234567890',  // Obligatoire et valide
            'codePostal' => 'A1B2C3',  // Obligatoire et valide
            'province' => 'Québec',    // Obligatoire et valide
            'ville' => 'Montréal',     // Obligatoire et valide
            'ville-autre' => '',       // Optionnel
            'typeContact' => 'Bureau', // Obligatoire et valide
            'posteTel' => '',          // Optionnel
            'site' => '',              // Optionnel
        ];

        $request = new InformationCoordonneeRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->fails());
    }

    /**
     * Teste validation avec des valeurs limites.
     */
    public function test_validation_with_maximum_length()
    {
        $data = [
            'Ncivique' => str_repeat('A', 8),  // 8 caractères (max)
            'rue' => str_repeat('A', 64),      // 64 caractères (max)
            'bureau' => str_repeat('A', 8),    // 8 caractères (max)
            'numTel' => '1234567890',          // 10 chiffres
            'codePostal' => 'A1B2C3',          // Code postal valide
            'ville' => str_repeat('A', 64),    // 64 caractères (max)
            'province' => str_repeat('A', 25), // 25 caractères (max)
            'typeContact' => 'Télécopieur',    // typeContact valide
            'posteTel' => '123456',            // Entre 1 et 6 chiffres
            'site' => 'https://example.com',   // URL valide
        ];

        $request = new InformationCoordonneeRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->fails());
    }
}
