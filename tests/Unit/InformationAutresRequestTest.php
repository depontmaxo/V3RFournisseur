<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Testing\File;
use Illuminate\Http\Testing\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Http\Requests\Inscription\InformationAutresRequest;

class InformationAutresRequestTest extends TestCase
{
    /**
     * Teste si la validation échoue lorsque le RBQ est invalide (pas 10 chiffres).
     */
    public function test_validation_fails_for_invalid_rbq()
    {
        $data = [
            'rbq' => '12345', // Invalide, moins de 10 chiffres
        ];

        $request = new InformationAutresRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        // Vérifie que la validation échoue
        $this->assertTrue($validator->fails());

        // Vérifie que le message d'erreur est celui attendu pour 'rbq'
        $errorMessage = $validator->errors()->first('rbq');
        $this->assertEquals('La licence RBQ doit contenir exactement 10 chiffres.', $errorMessage);
    }

    /**
     * Teste si la validation passe lorsque le RBQ est valide.
     */
    public function test_validation_passes_for_valid_rbq()
    {
        $data = [
            'rbq' => '1234567890', // Valide, exactement 10 chiffres
        ];

        $request = new InformationAutresRequest();
        $validator = Validator::make($data, $request->rules());

        // Vérifie que la validation passe
        $this->assertFalse($validator->fails());
    }

    /**
     * Teste si la validation échoue lorsque les documents sont invalides.
     */
    public function test_validation_fails_for_invalid_documents()
    {
        // Créez un fichier temporaire simulé avec un nom invalide
        $file = UploadedFile::fake()->create('invalid-file.txt', 0); // 0 octets, mais ce n'est pas un fichier valide

        // Définir un tableau de données avec ce fichier simulé
        $data = [
            'documents' => [
                $file,  // Fichier invalide simulé
            ],
        ];

        $request = new InformationAutresRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        // Vérifie que la validation échoue
        $this->assertTrue($validator->fails());

        // Vérifie que le message d'erreur est approprié pour un fichier invalide
        $errorMessage = $validator->errors()->first('documents.*.file');
        $this->assertEquals('Chaque document doit être un fichier valide.', $errorMessage);
    }

    /**
     * Teste si la validation échoue lorsque les documents dépassent la taille maximale.
     */
    public function test_validation_fails_for_large_documents()
    {
        $data = [
            'documents' => [
                // Fichier simulé de taille trop grande (environ 75 Ko)
                new \Illuminate\Http\Testing\File('large-file.pdf', 80000, 'application/pdf'),
            ],
        ];

        $request = new InformationAutresRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        // Vérifie que la validation échoue
        $this->assertTrue($validator->fails());

        // Vérifie que le message d'erreur est celui attendu pour la taille du fichier
        $errorMessage = $validator->errors()->first('documents.*.max');
        $this->assertEquals('Chaque document ne peut pas dépasser 75000 Ko.', $errorMessage);
    }

    /**
     * Teste si la validation réussit lorsque les documents sont valides.
     */
    public function test_validation_passes_for_valid_documents()
    {
        $data = [
            'documents' => [
                // Fichier valide simulé
                new \Illuminate\Http\Testing\File('valid-file.pdf', 50000, 'application/pdf'),
            ],
        ];

        $request = new InformationAutresRequest();
        $validator = Validator::make($data, $request->rules());

        // Vérifie que la validation passe
        $this->assertFalse($validator->fails());
    }

    /**
     * Teste si le champ 'documents' est valide avec un tableau vide.
     */
    public function test_validation_passes_for_empty_documents()
    {
        $data = [
            'documents' => [], // Pas de document, mais c'est valide car 'nullable'
        ];

        $request = new InformationAutresRequest();
        $validator = Validator::make($data, $request->rules());

        // Vérifie que la validation passe
        $this->assertFalse($validator->fails());
    }

    /**
     * Teste si la validation échoue lorsque le champ 'documents' est mal formaté (pas un tableau).
     */
    public function test_validation_fails_when_documents_are_not_array()
    {
        $data = [
            'documents' => 'string-instead-of-array', // Mauvais format, pas un tableau
        ];

        $request = new InformationAutresRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages());

        // Vérifie que la validation échoue
        $this->assertTrue($validator->fails());

        // Vérifie le message d'erreur pour 'documents'
        $errorMessage = $validator->errors()->first('documents.array');
        $this->assertEquals('Les documents doivent être un tableau.', $errorMessage);
    }
}
