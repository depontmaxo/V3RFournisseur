<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Utilisateur;
use App\Models\CodeUNSPSC;
use App\Models\Contacts;
use App\Models\Coordonnees;
use App\Models\Document;

class FournisseursController extends Controller
{
    protected $redirectTo = '/';

    /**
     * Index du site web.
     */
    public function index()
    {
        $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'code_unspsc', 'desc_det_unspsc')->paginate(10);
        //dd($codeUNSPSCunite);

        return View('pagePrincipale', compact('codeUNSPSCunite'));

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
        $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'code_unspsc', 'desc_det_unspsc')->paginate(10);

        //dd($utilisateur);

        $codes = DB::table('utilisateur_unspsc')
        ->join('code_unspsc', 'utilisateur_unspsc.unspsc_id', '=', 'code_unspsc.code_unspsc')
        ->where('utilisateur_unspsc.utilisateur_id', $utilisateur->id)
        ->select('utilisateur_unspsc.unspsc_id', 'code_unspsc.desc_det_unspsc') // Select the needed fields
        ->get();
    
        //dd($codes);

        return View('ficheFournisseur', compact('utilisateur', 'contacts', 'coordonnees','codes','codeUNSPSCunite'));
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
        $utilisateur->statut = 'Inactif';
        $utilisateur->save();
        return View('pagePrincipale')->with('message', "Votre compte est rendu inactif");

    }

    public function actif(Utilisateur $utilisateur)
    {
        //Comment on supprime / met inactif les comptes
        // Ajouter une confirmation email pour la désactivation/supression du compte
        $utilisateur->statut = 'Actif';
        $utilisateur->save();
        return View('pagePrincipale')->with('message', "Votre compte est rendu actif");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function support()
    {
        return View('support');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utilisateur $utilisateur)
    {

    }

    public function recherche(Request $request)
    {

        if($request->recherche == ""){
            $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'code_unspsc', 'desc_det_unspsc')
            ->orderBy('code_unspsc', 'asc')
            ->paginate(10);

            return view('pagePrincipale', compact('codeUNSPSCunite'));
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


        return view('pagePrincipale', compact('codeUNSPSCunite'));

    }

    
    public function choisit(Request $request)
    {
        //dd($request->code_unspsc_choisit);
        //dd($request->code_unspsc_choisit);

        $selectedCodes = $request->code_unspsc_choisit;
        $utilisateurId = auth()->id();

        //dd($utilisateurId);
        //dd($selectedCodes);
        
        if ($utilisateurId && !empty($selectedCodes)) {
            foreach ($selectedCodes as $unspscId) {
                // Regarde si il existe déjà
                $exists = DB::table('utilisateur_unspsc')
                    ->where('utilisateur_id', $utilisateurId)
                    ->where('unspsc_id', $unspscId)
                    ->exists();
        
                // Insertion
                if (!$exists) {
                    DB::table('utilisateur_unspsc')->insert([
                        'utilisateur_id' => $utilisateurId,
                        'unspsc_id' => $unspscId,
                    ]);
                }
                else{
                    //Mettre un message d'erreur
                    //dd($exists);
                }
            }
        }
        
        $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'code_unspsc', 'desc_det_unspsc')
            ->orderBy('code_unspsc', 'asc')
            ->paginate(10);
    
        return view('pagePrincipale', compact('codeUNSPSCunite'));
    }


    /*
    Debug pour les codes unspsc
        <!-- Debugging Section -->
        <h4>Debugging Selected UNSPSC Codes:</h4>
        @foreach (request('code_unspsc_choisit', []) as $selectedCode)
            <input type="text" name="code_unspsc_choisit[]" value="{{ $selectedCode }}" />
        @endforeach
    */

    
}
