<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function index()
    {
        return View('inscription');
    }

    public function store(Request $request)
    {
        $request->validate([
        'nom' => [
            'required',
            'regex:/^[A-Za-zÀ-ÖØ-öø-ÿ]+([ -][A-Za-zÀ-ÖØ-öø-ÿ]+)*$/',
            'between:8,65',
        ],
        'neq' => 'required|digits:10|integer',/*REQUIRED SEULEMENT SI IL NE FOURNIT PAS DE COURRIEL (à modifier)*/
        'adresse' => ['required', 'max:128', 'min:5'],
        'numTel' => 'required|digits:10|integer',
        'site' => 'required',
        'nomContact' => 'required',
        'poste' => 'required',
        'courriel' => 'required',
        'rbq' => 'required',
        'services' => 'required',
        /*'fichiersJoints' => 'required',
        'ville' => 'required',
        'codePostal' => 'required',
        'pays' => 'required',
        */
        ]);

        //Création candidat dans BD
        $candidat = CandidatInscription::create([
            'nom' => $request->nom,
            'neq' => $request->neq,
            'adresse' => $request->adresse,
            'numTel' => $request->numTel,
            'site' => $request->site,
            'nomContact' => $request->nomContact,
            'poste' => $request->poste,
            'courriel' => $request->courriel,
            'rbq' => $request->rbq,
            'services' => $request->services,
            'fichiersJoints' => $request->fichiersJoints,
        ]);
    }

    public function login(ConnexionRequest $request)
    {

    }
}
