<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Requests\Inscription\InformationContactsRequest;
use Illuminate\Support\Facades\Validator;

class InformationContactsRequestTest extends TestCase
{
    /**
     * Teste si les règles de validation refusent les entrées incorrectes.
     */
    public function test_validation_fails_with_invalid_data()
    {
        $data = [
            'prenom' => 'John1', // Contient un chiffre
            'nom' => 'Doe  ', // Espaces consécutifs à la fin
            'fonction' => '123', // Fonction invalide (contenant des chiffres)
            'courrielContact' => 'invalid-email', // Email invalide
            'numContact' => '12345', // Trop court, il faut 10 chiffres
            'posteTelContact' => '1234567', // Trop long, il faut entre 1 et 6 chiffres
            'typeTelContact' => '', // Manque de données
        ];

        $request = new InformationContactsRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        $this->assertTrue($validator->fails());

        // Vérification des erreurs spécifiques
        $expectedErrors = [
            'prenom' => 'Le prénom entrée est invalide.',
            'nom' => 'Le nom entrée est invalide.',
            'fonction' => 'Le poste entrée est invalide.',
            'courrielContact' => 'L’adresse courriel est invalide.',
            'numContact' => 'Le numéro de contact doit contenir exactement 10 chiffres.',
            'posteTelContact' => 'Le numéro de poste doit contenir uniquement des chiffres (entre 1 et 6 chiffres).',
            'typeTelContact' => 'Ce champ est obligatoire.',
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
            'prenom' => 'John', // Valide
            'nom' => 'Doe', // Valide
            'fonction' => 'Directeur', // Valide
            'courrielContact' => 'john.doe@example.com', // Email valide
            'numContact' => '1234567890', // 10 chiffres
            'posteTelContact' => '123', // Entre 1 et 6 chiffres
            'typeTelContact' => 'Mobile', // Type valide
        ];

        $request = new InformationContactsRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->fails());
    }

    /**
     * Teste la logique de transformation dans prepareForValidation.
     */
    public function test_prepare_for_validation_removes_dashes_from_numContact()
    {
        $data = [
            'numContact' => '123-456-7890',
        ];

        $request = new InformationContactsRequest();
        $request->merge($data);
        $request->prepareForValidation();

        $this->assertEquals('1234567890', $request->input('numContact'));
    }

    /**
     * Teste si le message d'erreur personnalisé est bien défini pour le champ 'prenom'.
     */
    public function test_custom_error_message_for_prenom()
    {
        $data = [
            'prenom' => 'John1', // Contient un chiffre
        ];

        $request = new InformationContactsRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());
        $this->assertTrue($validator->fails());

        $errorMessage = $validator->errors()->first('prenom');
        $this->assertEquals('Le prénom entrée est invalide.', $errorMessage);
    }

    /**
     * Teste si le message d'erreur personnalisé est bien défini pour le champ 'courrielContact'.
     */
    public function test_custom_error_message_for_courrielContact()
    {
        $data = [
            'courrielContact' => 'invalid-email', // Email invalide
        ];

        $request = new InformationContactsRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());
        $this->assertTrue($validator->fails());

        $errorMessage = $validator->errors()->first('courrielContact');
        $this->assertEquals('L’adresse courriel est invalide.', $errorMessage);
    }
}
