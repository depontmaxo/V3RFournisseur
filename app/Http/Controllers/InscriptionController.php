<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    //LES CHEMINS DE PAGE DU FORMULAIRE D'INSCRIPTION
    public function identification()
    {
        return View('Inscription.inscriptionIdentification');
    }

    public function contact()
    {
        return View('Inscription.inscriptionContact');
    }

    public function coordonnees()
    {
        return View('Inscription.inscriptionCoordonnees');
    }

    public function produits()
    {
        return View('Inscription.inscriptionProduits');
    }

    public function rbq()
    {
        return View('Inscription.inscriptionRBQ');
    }

    public function formComplet()
    {
        return View('Inscription.inscriptionComplet');
    }


    //VALIDATION DE DONNEE, REDIRECT ET SAUVEGARDE DANS SESSION
    public function verificationIdentification(Request $request)
    {
        $request->validate([
            'entreprise' => [
                'required', 
            'min:5', 
            'max:75', 
            'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/' //Vérifie qu'il n'y a plusieurs espaces un après l'autre
            ],

            'neq' => ['required', 'digits:10', 'integer'],
            'courrielConnexion' => ['required', 'min:10', 'max:75', 'regex:/^[^\s]*$/'],
            'password' => [
                'required', 
                'min:8', 
                'max:25', 
                'confirmed', 
                'regex:/^[^\s]*$/' //Vérifie qu'il ne contient aucun espace dans le string
                ]
        ]);

        $this->storeInSession($request, $request->only('entreprise', 'neq', 'courrielConnexion', 'password'));

        return redirect()->route('Inscription.Produits');
    }


    public function verificationProduits(Request $request)
    {
        $request->validate([
            'services' => ['required', 'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/'],
        ]);

        $this->storeInSession($request, $request->only('services'));
        return redirect()->route('Inscription.Coordonnees');
    }

    public function verificationCoordonnees(Request $request)
    {
        $request->validate([
            'adresse' => ['required', 'regex:/^\d+\s+[a-zA-Z]+/', 'min:5', 'max:50'], // Vérifier le format avec chiffres et lettres
            'bureau' => ['required', 'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/', 'min:5', 'max:15'],
            'ville' => ['required', 'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/', 'min:3', 'max:30'],
            'province' => ['required', 'min:3', 'max:25', 'regex:/^[^\s]*$/'],
            'codePostal' => [
                'required', 
                'regex:/^[A-Za-z]\d[A-Za-z]\s?\d[A-Za-z]\d$/'], // Valider le code postal
            'pays' => ['required', 'regex:/^[^\s]*$/', 'min:5', 'max:35'],
            'site' => ['required', 'regex:/^[^\s]*$/'],
            'numTel' => ['required', 'digits:10', 'integer'],
        ]);

        $this->storeInSession($request, $request->only('adresse', 'bureau', 'ville', 'province', 'codePostal', 'pays', 'site', 'numTel'));
        return redirect()->route('Inscription.Contact');
    }

    public function verificationContact(Request $request)
    {
        $request->validate([
            'prenom' => ['required', 'regex:/^[^\s]*$/', 'min:3', 'max:20'],
            'nom' => ['required', 'regex:/^[^\s]*$/', 'min:3', 'max:50'],
            'poste' => ['required', 'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/', 'min:3', 'max:30'],
            'courrielContact' => ['required', 'regex:/^[^\s]*$/'],
            'numContact' => ['required', 'digits:10', 'integer'],
        ]);

        $this->storeInSession($request, $request->only('prenom', 'nom', 'poste', 'courrielContact', 'numContact'));
        return redirect()->route('Inscription.RBQ');
    }


    public function verificationRBQ(Request $request)
    {
        $request->validate([
            'rbq' => ['required'],
            'fichiersJoints' => ['required'],
        ]);

        $this->storeInSession($request, $request->only('rbq', 'fichiersJoints'));
        return redirect()->route('Inscription.Complet');
    }


    //VA CHERCHER INFO ET CRÉE CANDIDAT
    public function envoyerFormulaire(Request $request)
    {
        $data = session('user_data', []);

        //$candidat = CandidatInscription::create($data);

        session()->forget('user_data');
        //session()->flush();

        /*Envoyer à une page qui demande de confirmer son compte dans ses courriels*/

        /*$candidat = CandidatInscription::create([
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
        ]);*/
        //return redirect()->route('Inscription.Produits');
    }

    //Fonctions pour storer les données
    protected function storeInSession(Request $request, $stepData)
    {
        $data = session('user_data', []);
        $data = array_merge($data, $stepData);
        session(['user_data' => $data]);
    }
}
