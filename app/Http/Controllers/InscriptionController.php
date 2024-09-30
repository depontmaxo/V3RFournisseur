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
            'entreprise' => 'required',
            'neq' => 'required|digits:10|integer',
            'courrielConnexion' => 'required',
            'mdp' => 'required',
            'mdpConf' => 'required',
        ]);

        $this->storeInSession($request, $request->only('entreprise', 'neq', 'courrielConnexion', 'mdp', 'mdpConf'));
        return redirect()->route('Inscription.inscriptionProduits');
    }

    public function verificationContact(Request $request)
    {
        $request->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'poste' => 'required',
            'courrielContact' => 'required',
            'numContact' => 'required',
        ]);

        $this->storeInSession($request, $request->only('prenom', 'nom', 'poste', 'courrielContact', 'numContact'));
    }

    public function verificationCoordonnees(Request $request)
    {
        $request->validate([
            'adresse' => 'required',
            'bureau' => 'required',
            'ville' => 'required',
            'province' => 'required',
            'codePostal' => 'required',
            'pays' => 'required',
            'site' => 'required',
            'numTel' => 'required',
        ]);

        $this->storeInSession($request, $request->only('adresse', 'bureau', 'ville', 'province', 'codePostal', 'pays', 'site', 'numTel'));
    }

    public function verificationProduits(Request $request)
    {
        $request->validate([
            'services' => 'required',
        ]);

        $this->storeInSession($request, $request->only('services'));
    }

    public function verificationRBQ(Request $request)
    {
        $request->validate([
            'rbq' => 'required',
            'fichiersJoints' => 'required',
        ]);

        $this->storeInSession($request, $request->only('rbq', 'fichiersJoints'));
    }


    //VA CHERCHER INFO ET CRÉE CANDIDAT
    public function envoyerFormulaire(Request $request)
    {
        $data = session('user_data', []);

        $candidat = CandidatInscription::create($data);

        session()->forget('user_data');
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
    }

    //Fonctions pour storer les données
    protected function storeInSession(Request $request, $stepData)
    {
        $data = session('user_data', []);
        $data = array_merge($data, $stepData);
        session(['user_data' => $data]);
    }
}
