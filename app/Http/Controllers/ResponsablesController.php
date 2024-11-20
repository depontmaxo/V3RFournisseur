<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;
use App\Models\Contacts;
use App\Models\Coordonnees;
use Illuminate\Support\Facades\Http;
class ResponsablesController extends Controller
{
    protected $redirectTo = '/';

    public function index(Request $request)
    {
        /*
            ///////////////////////////////Check API pour NEQ valid////////////////////////////////////////////////////////////////

            ////////////////////////
            // Ce code fonctionne //
            ////////////////////////

            $test = Http::withoutVerifying()->get('https://donneesquebec.ca/recherche/api/action/datastore_search_sql', [
                //'sql' => 'SELECT * FROM "32f6ec46-85fd-45e9-945b-965d9235840a" WHERE "NEQ" = \'1\''
                'sql' => 'SELECT * FROM "32f6ec46-85fd-45e9-945b-965d9235840a" WHERE "NEQ" = \'8831854938\''
            ]);

            $responseArray = $test->json();
            
            // Check if records array is empty
            if (empty($responseArray['result']['records'])) {
                //dd('No records found');
            } else {
                //dd($responseArray['result']['records']['0']['NEQ']);
                //dd($responseArray['result']['records']);
            }

            //dd($test->json());

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        */
        
        $utilisateurs = Utilisateur::where('role', 'fournisseur')
        ->where('statut', 'Actif')
        ->get();
        return View('responsable.pagePrincipaleResponsable', compact('utilisateurs'));
    }


    /*
    Fonction: Recherche
    Il y a des options pour faire une recherche par:
        -Nom
        -Adresse
    */
    public function recherche(Request $request)
    {
        //dd($request->adresse);

        if($request->recherche == ""){
            $utilisateurs = Utilisateur::where('role', 'fournisseur')->get();

            return view('responsable.pagePrincipaleResponsable', compact('utilisateurs'));
        }

        $recherche = $request->recherche;

        $query = Utilisateur::query();

        if($request->nom == "on"){
            $query->where('role', 'fournisseur');
            $query->whereAny(['nomFournisseur'], 'LIKE' , "%$recherche%");
        }
        else if($request->adresse == "on"){
            $query->where('role', 'fournisseur');
            $query->whereAny(['adresse'], 'LIKE' , "%$recherche%");
        }
        else{
            $query->where('role', 'fournisseur');
            $query->whereAny(['nomFournisseur', 'adresse'], 'LIKE' , "%$recherche%");
        }

        $utilisateurs = $query->get();

        return view('responsable.pagePrincipaleResponsable', compact('utilisateurs'));

    }


    public function voirListeInscription()
    {
        $candidats = Utilisateur::where('statut', 'En attente')->get();
        return View('responsable.listeRequeteInscription', compact('candidats'));
    }

    public function evaluerCandidat(Utilisateur $candidat)
    {
        $contacts = Contacts::where('utilisateur_id', $candidat->id)->firstOrFail();
        $coordonnees = Coordonnees::where('utilisateur_id', $candidat->id)->firstOrFail();
        return View('responsable.formulaireCandidat', compact('candidat', 'contacts', 'coordonnees'));
    }

    public function candidatAccepte(Utilisateur $candidat){
        $candidat->statut = 'Actif';
        $candidat->save();
        $candidats = Utilisateur::where('role', 'fournisseur')->where('statut', 'En attente')
            ->get();
        return View('responsable.listeRequeteInscription', compact('candidats'))->with('message', "Le candidat est ajouté avec succès");
    }

    public function candidatRefuse(Utilisateur $candidat){
        $candidat->statut = 'Refusé';
        $candidat->save();
        $candidats = Utilisateur::where('role', 'fournisseur')
        ->where('statut', 'En attente')
        ->get();
        return View('responsable.listeRequeteInscription', compact('candidats'))->with('message', "Le candidat a été refusé avec succès");
    }



    public function rechercheFournisseur(Request $request)
    {
        //dd($request->adresse);

        if($request->recherche == ""){
            $utilisateurs = Utilisateur::where('role', 'fournisseur')
            ->where('statut', 'Actif')
            ->get();

            return view('responsable.listeFournisseur', compact('utilisateurs'));
        }

        $recherche = $request->recherche;

        $query = Utilisateur::query();

        if($request->nom == "on"){
            $query->where('role', 'fournisseur');
            $query->where('statut', 'Actif');
            $query->whereAny(['nom_entreprise'], 'LIKE' , "%$recherche%");
        }
        else if($request->neq == "on"){
            $query->where('role', 'fournisseur');
            $query->where('statut', 'Actif');
            $query->whereAny(['neq'], 'LIKE' , "%$recherche%");
        }
        else if($request->courriel == "on"){
            $query->where('role', 'fournisseur');
            $query->where('statut', 'Actif');
            $query->whereAny(['email'], 'LIKE' , "%$recherche%");
        }
        else{
            $query->where('role', 'fournisseur');
            $query->where('statut', 'Actif');
            $query->whereAny(['nom_entreprise', 'neq', 'email'], 'LIKE' , "%$recherche%");
        }

        $utilisateurs = $query->get();

        return view('responsable.listeFournisseur', compact('utilisateurs'));

    }


    public function rechercheCandidat(Request $request)
    {
        //dd($request->adresse);

        if($request->recherche == ""){
            $candidats = Utilisateur::where('role', 'fournisseur')
            ->where('statut', 'En attente')
            ->get();

            return view('responsable.listeRequeteInscription', compact('candidats'));
        }

        $recherche = $request->recherche;

        $query = Utilisateur::query();

        if($request->nom == "on"){
            $query->where('role', 'fournisseur');
            $query->where('statut', 'En attente');
            $query->whereAny(['nom_entreprise'], 'LIKE' , "%$recherche%");
        }
        else if($request->neq == "on"){
            $query->where('role', 'fournisseur');
            $query->where('statut', 'En attente');
            $query->whereAny(['neq'], 'LIKE' , "%$recherche%");
        }
        else if($request->courriel == "on"){
            $query->where('role', 'fournisseur');
            $query->where('statut', 'En attente');
            $query->whereAny(['email'], 'LIKE' , "%$recherche%");
        }
        else{
            $query->where('role', 'fournisseur');
            $query->where('statut', 'En attente');
            $query->whereAny(['nom_entreprise', 'neq', 'email'], 'LIKE' , "%$recherche%");
        }

        $candidats = $query->get();

        return view('responsable.listeRequeteInscription', compact('candidats'));

    }

    
}
