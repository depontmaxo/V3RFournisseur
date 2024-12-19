<?php

namespace Tests\Unit; // ✅ Changement de namespace

use Illuminate\Foundation\Testing\RefreshDatabase; // ✅ Maintenant ça fonctionne
use Tests\TestCase; // ✅ Remplace PHPUnit\Framework\TestCase par Tests\TestCase
use App\Http\Requests\Inscription\InformationIdentificationRequest;
use Illuminate\Support\Facades\Validator;

class InformationIdentificationRequestTest extends TestCase
{
     /**
     * Teste si les règles de validation refusent les entrées incorrectes.
     */
    public function test_validation_fails_with_invalid_data()
    {
        $data = [
            'entreprise' => 'A', // Trop court (min: 5)
            'neq' => '123456789', // Manque 1 chiffre (10 chiffres requis)
            'courrielConnexion' => 'invalid-email', // Email invalide
            'password' => '123', // Mot de passe trop court
        ];

        $request = new InformationIdentificationRequest();

        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());

        $expectedErrors = [
            'entreprise' => 'Ce champ est obligatoire.',
            'neq' => 'Le code NEQ doit être exactement composé de 10 caractères.',
            'courrielConnexion' => 'L’adresse courriel est invalide.',
            'password' => 'Le mot de passe doit contenir au moins 7 caractères.',
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
            'entreprise' => 'Ma Super Entreprise',
            'neq' => '1123456789', // 10 chiffres commençant par 11
            'courrielConnexion' => 'test@example.com',
            'password' => 'A!b2c3d', // Mot de passe conforme
            'password_confirmation' => 'A!b2c3d', // Confirmation du mot de passe
        ];

        $request = new InformationIdentificationRequest();

        $validator = Validator::make($data, $request->rules());
        $this->assertFalse($validator->fails());
    }

    /**
     * Teste la logique de transformation dans prepareForValidation.
     */
    public function test_prepare_for_validation_removes_spaces_from_neq()
    {
        $data = [
            'neq' => '11 234 567 89',
        ];

        $request = new InformationIdentificationRequest();
        $request->merge($data);
        $request->prepareForValidation();

        $this->assertEquals('1123456789', $request->input('neq'));
    }

    /**
     * Teste si le message d'erreur personnalisé est bien défini.
     */
    public function test_custom_error_messages_are_correct()
    {
        $data = [
            'entreprise' => '', // Manque de données ici
        ];

        $request = new InformationIdentificationRequest();

        $validator = Validator::make($data, $request->rules(), $request->messages());
        $this->assertTrue($validator->fails());

        $errorMessage = $validator->errors()->first('entreprise');
        $this->assertEquals('Ce champ est obligatoire.', $errorMessage);
    }
}
