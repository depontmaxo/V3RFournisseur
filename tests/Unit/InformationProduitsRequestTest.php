<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Inscription\InformationProduitsRequest;

class InformationProduitsRequestTest extends TestCase
{

    /**
     * Teste si la validation échoue pour des données invalides.
     */
    public function test_validation_fails_with_invalid_data()
    {
        // Données invalides
        $data = [
            'selected_codes' => '', // Vide, invalide
        ];

        $request = new InformationProduitsRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        // Vérifie que la validation échoue
        $this->assertTrue($validator->fails());

        // Vérifie que les messages d'erreur sont appropriés
        $errorMessage = $validator->errors()->first('selected_codes');
        $this->assertEquals('Vous devez sélectionner au moins un code.', $errorMessage);
    }

    /**
     * Teste si la validation échoue pour un format JSON invalide.
     */
    public function test_validation_fails_with_invalid_json_format()
    {
        // Données avec un format JSON invalide
        $data = [
            'selected_codes' => 'invalid-json', // Mauvais format JSON
        ];

        $request = new InformationProduitsRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        // Vérifie que la validation échoue
        $this->assertTrue($validator->fails());

        // Vérifie que le message d'erreur est celui attendu pour un format JSON invalide
        $errorMessage = $validator->errors()->first('selected_codes');
        $this->assertEquals('Le format des codes sélectionnés est invalide.', $errorMessage);
    }

    /**
     * Teste si la validation réussit avec des données valides.
     */
    public function test_validation_passes_with_valid_data()
    {
        // Données valides (une chaîne JSON représentant un tableau valide)
        $data = [
            'selected_codes' => json_encode([1, 2, 3]), // JSON valide
        ];

        $request = new InformationProduitsRequest();
        $validator = Validator::make($data, $request->rules());

        // Vérifie que la validation passe
        $this->assertFalse($validator->fails());
    }

    /**
     * Teste si le message d'erreur personnalisé est bien renvoyé pour un champ requis.
     */
    public function test_custom_error_message_for_required_field()
    {
        // Données sans 'selected_codes' (champ requis manquant)
        $data = [];

        $request = new InformationProduitsRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        // Vérifie que la validation échoue
        $this->assertTrue($validator->fails());

        // Vérifie que le message d'erreur pour 'selected_codes' est correct
        $errorMessage = $validator->errors()->first('selected_codes');
        $this->assertEquals('Vous devez sélectionner au moins un code.', $errorMessage);
    }
}
