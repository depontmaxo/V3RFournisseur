<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        //$codeUNSPSCnature = CodeUNSPSC::select('nature_contrat')->groupBy('nature_contrat')->get();

        $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'code_unspsc', 'desc_det_unspsc')->paginate(10);

        //dd($codeUNSPSCunite);

        //Seed pour voir si une page refresh
        $randomId = rand(2,9999999);


        // Retrieve checked items in session.
        $checked_UNSPSC = [];
        if (Session::has('checked_UNSPSC'))
            $checked_UNSPSC = Session::get('checked_UNSPSC');

        // Persist new checked items.
        $checked_UNSPSC = array_merge($checked_UNSPSC, Input::get('codeUNSPSCunite'));
        Session::flash('checked_UNSPSC', $checked_UNSPSC);

        /*
        return View::make('form')->with('items', $items);
        */

        return View('pagePrincipale', compact('codeUNSPSCunite','randomId'));

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

    public function recherche(Request $request)
    {

        $randomId = rand(2,9999999);

        if($request->recherche == ""){
            $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'code_unspsc', 'desc_det_unspsc')
            ->orderBy('code_unspsc', 'asc')
            ->paginate(10);

            return view('pagePrincipale', compact('codeUNSPSCunite','randomId'));
        }

        $recherche = $request->recherche;

        $query = CodeUNSPSC::query();

        if($request->code_unspsc == "on"){
            $query->whereAny(['code_unspsc'], 'LIKE' , "%$recherche%");
        }
        else if($request->nature_contrat == "on"){
            $query->whereAny(['nature_contrat'], 'LIKE' , "%$recherche%");
        }
        else if($request->desc_det_unspsc == "on"){
            $query->whereAny(['desc_det_unspsc'], 'LIKE' , "%$recherche%");
        }
        else{
            $query->whereAny(['code_unspsc', 'desc_det_unspsc', 'nature_contrat'], 'LIKE' , "%$recherche%");
        }

        $codeUNSPSCunite = $query->paginate(10);


        // Retrieve checked items in session.
        $checked_UNSPSC = [];
        if (Session::has('checked_UNSPSC'))
            $checked_UNSPSC = Session::get('checked_UNSPSC');

        // Persist new checked items.
        $checked_UNSPSC = array_merge($checked_UNSPSC, Input::get('codeUNSPSCunite'));
        Session::flash('checked_UNSPSC', $checked_UNSPSC);

        /*
        return View::make('form')->with('items', $items);
        */


        return view('pagePrincipale', compact('codeUNSPSCunite','randomId'));

    }

    
    public function choisit(Request $request)
    {
        $randomId = rand(2,9999999);
        
        dd($request);

        $utilisateurId = $request->input('utilisateur_id');
        $selectedCodes = $request->input('code_unspsc_choisit', []);
        
        if ($utilisateurId && !empty($selectedCodes)) {
            foreach ($selectedCodes as $unscpscId) {
                DB::table('utilisateur_unspsc')->insert([
                    'utilisateur_id' => $utilisateurId,
                    'unscpsc_id' => $unscpscId,
                    'id' => (string) Str::uuid(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        
        $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'code_unspsc', 'desc_det_unspsc')
            ->orderBy('code_unspsc', 'asc')
            ->paginate(10);
    
        return view('pagePrincipale', compact('codeUNSPSCunite','randomId'));
    }

    
}
