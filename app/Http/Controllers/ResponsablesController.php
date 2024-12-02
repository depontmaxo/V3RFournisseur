<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Utilisateur;
use App\Models\User;
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

        $utilisateurs = Utilisateur::where('statut', 'Actif')
        ->with('coordonnees')
        ->paginate(15);

        foreach ($utilisateurs as $utilisateur) {
            $mostCommonCategory = DB::table('utilisateur_unspsc')
                ->join('code_unspsc', 'utilisateur_unspsc.unspsc_id', '=', 'code_unspsc.code_unspsc')
                ->select('code_unspsc.desc_cat', DB::raw('COUNT(code_unspsc.desc_cat) as count'))
                ->where('utilisateur_unspsc.utilisateur_id', $utilisateur->id)
                ->groupBy('code_unspsc.desc_cat')
                ->orderByDesc('count')
                ->first();
        
            $utilisateur->most_common_category = $mostCommonCategory;
        }

        //dd($utilisateur);

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
            $utilisateurs = Utilisateur::where('statut', 'Actif')
            ->paginate(10);

            return view('responsable.pagePrincipaleResponsable', compact('utilisateurs'));
        }

        $recherche = $request->recherche;

        $query = Utilisateur::query();

        if($request->nom == "on"){
            $query->whereAny(['nomFournisseur'], 'LIKE' , "%$recherche%");
        }
        else if($request->adresse == "on"){
            $query->whereAny(['adresse'], 'LIKE' , "%$recherche%");
        }
        else if($request->categorie == "on"){
            $query->whereAny(['categorie'], 'LIKE' , "%$recherche%");
        }
        else{
            $query->whereAny(['nomFournisseur', 'adresse'], 'LIKE' , "%$recherche%");
        }

        $utilisateurs = $query->paginate(10);

        return view('responsable.pagePrincipaleResponsable', compact('utilisateurs'));

    }


    public function voirListeInscription()
    {
        $candidats = Utilisateur::where('statut', 'En attente')->paginate(10);
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
        $candidats = Utilisateur::where('statut', 'En attente')
            ->paginate(10);
        return View('responsable.listeRequeteInscription', compact('candidats'))->with('message', "Le candidat est ajouté avec succès");
    }

    public function candidatRefuse(Utilisateur $candidat){
        $candidat->statut = 'Refusé';
        $candidat->save();
        $candidats = Utilisateur::where('statut', 'En attente')
        ->paginate(10);
        return View('responsable.listeRequeteInscription', compact('candidats'))->with('message', "Le candidat a été refusé avec succès");
    }



    public function rechercheFournisseur(Request $request)
    {
        //dd($request->adresse);

        if($request->recherche == ""){
            $utilisateurs = Utilisateur::where('statut', 'Actif')
            ->paginate(10);;

            return view('responsable.pagePrincipaleResponsable', compact('utilisateurs'));
        }

        $recherche = $request->recherche;

        $query = Utilisateur::query();

        if($request->nom == "on"){
            $query->where('statut', 'Actif');
            $query->whereAny(['nom_entreprise'], 'LIKE' , "%$recherche%");
        }
        else if($request->neq == "on"){
            $query->where('statut', 'Actif');
            $query->whereAny(['neq'], 'LIKE' , "%$recherche%");
        }
        else if($request->courriel == "on"){
            $query->where('statut', 'Actif');
            $query->whereAny(['email'], 'LIKE' , "%$recherche%");
        }
        else{
            $query->where('statut', 'Actif');
            $query->whereAny(['nom_entreprise', 'neq', 'email'], 'LIKE' , "%$recherche%");
        }

        $utilisateurs = $query->paginate(10);;

        return view('responsable.pagePrincipaleResponsable', compact('utilisateurs'));

    }


    public function rechercheCandidat(Request $request)
    {
        //dd($request->adresse);

        if($request->recherche == ""){
            $candidats = Utilisateur::where('statut', 'En attente')
            ->paginate(10);;

            return view('responsable.listeRequeteInscription', compact('candidats'));
        }

        $recherche = $request->recherche;

        $query = Utilisateur::query();

        if($request->nom == "on"){
            $query->where('statut', 'En attente');
            $query->whereAny(['nom_entreprise'], 'LIKE' , "%$recherche%");
        }
        else if($request->neq == "on"){
            $query->where('statut', 'En attente');
            $query->whereAny(['neq'], 'LIKE' , "%$recherche%");
        }
        else if($request->courriel == "on"){
            $query->where('statut', 'En attente');
            $query->whereAny(['email'], 'LIKE' , "%$recherche%");
        }
        else{
            $query->where('statut', 'En attente');
            $query->whereAny(['nom_entreprise', 'neq', 'email'], 'LIKE' , "%$recherche%");
        }

        $candidats = $query->paginate(10);

        return view('responsable.listeRequeteInscription', compact('candidats'));

    }

    
}
