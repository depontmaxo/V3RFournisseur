<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;
use App\Models\CodeUNSPSC;
use App\Models\Contacts;
use App\Models\Coordonnees;
use App\Models\Document;

class FournisseursController extends Controller
{
    /**
     * Index du site web.
     */
    public function index()
    {

        //dd(auth()->user()->id);
        $codeUNSPSC = CodeUNSPSC::all();

        //$codeUNSPSCnature = CodeUNSPSC::select('nature_contrat')->groupBy('nature_contrat')->get();

        $codeUNSPSCunite = CodeUNSPSC::select('code_unspsc', 'desc_det_unspsc', 'nature_contrat')->paginate(25);

        //dd($codeUNSPSCunite);

        return View('pagePrincipale', compact('codeUNSPSC', 'codeUNSPSCunite'));

    }

    /**
     * Pas utiliser car il y a une vérification qui n'est pas compléter 16/09/2024
     */
    public function create()
    {
        //
    }

    /**
     * Pas utiliser car il y a une vérification qui n'est pas compléter 16/09/2024
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Laisse le fournisseur voir les infomation de sa fiche
     */
    public function show(Utilisateur $utilisateur)
    {
        $contacts = Contacts::where('utilisateur_id', $utilisateur->id)->firstOrFail();
        $coordonnees = Coordonnees::where('utilisateur_id', $utilisateur->id)->firstOrFail();
        //dd($utilisateur);
        return View('ficheFournisseur', compact('utilisateur', 'contacts', 'coordonnees'));
    }


    /**
     * Sert à modifier les infomations de la fiche du fournisseur
     */
    public function edit(Utilisateur $utilisateur)
    {
        //
        return View('modificationFicheFournisseur', compact('utilisateur'));
    }

    /**
     * Updater le compte avec les nouvelles informations
     */
    public function update(Request $request, Utilisateur $utilisateur)
    {

        //Vérification modifs?
        $utilisateur->neq = $request->neq;
        $utilisateur->email = $request->email;
        $utilisateur->nomFournisseur = $request->nomFournisseur;
        $utilisateur->adresse = $request->adresse;
        $utilisateur->noTelephone = $request->noTelephone;
        $utilisateur->personneRessource = $request->personneRessource;
        $utilisateur->emailPersonneRessource = $request->emailPersonneRessource;
        $utilisateur->licenceRBQ = $request->licenceRBQ;
        $utilisateur->posteOccupeEntreprise = $request->posteOccupeEntreprise;
        $utilisateur->siteWeb = $request->siteWeb;
        $utilisateur->produitOuService = $request->produitOuService;

        
        $utilisateur->save();
        return redirect()->route('Fournisseur.index')->with('message', "Modification de " . $utilisateur->nom . " réussi!");
    }
    /**
     * Rendre le compte inactif.
     */
    public function inactif(Utilisateur $utilisateur)
    {
        //Comment on supprime / met inactif les comptes
        // Ajouter une confirmation email pour la désactivation/supression du compte
        $utilisateur->statut = 'inactif';
        $utilisateur->save();
        return View('pagePrincipale')->with('message', "Votre compte est rendu inactif");

    }

    public function actif(Utilisateur $utilisateur)
    {
        //Comment on supprime / met inactif les comptes
        // Ajouter une confirmation email pour la désactivation/supression du compte
        $utilisateur->statut = 'actif';
        $utilisateur->save();
        return View('pagePrincipale')->with('message', "Votre compte est rendu actif");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utilisateur $utilisateur)
    {

    }
}
