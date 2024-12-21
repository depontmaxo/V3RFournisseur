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
use App\Models\Finance;
use App\Models\Coordonnees;
use App\Models\Document;
use App\Models\Ville;
use App\Models\RegionAdministrative;

use App\Http\Requests\Inscription\InformationModificationNomRequest;
use App\Http\Requests\Inscription\InformationProduitsRequest;
use App\Http\Requests\Inscription\InformationCoordonneeRequest;
use App\Http\Requests\Inscription\InformationContactsRequest;
use App\Http\Requests\Inscription\InformationAutresRequest;

class FournisseursController extends Controller
{
    protected $redirectTo = '/';

    /**
     * Index du site web.
     */
    public function index(Utilisateur $utilisateur)
    {
        $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'desc_cat', 'code_unspsc', 'desc_det_unspsc')->paginate(10);
        //dd($codeUNSPSCunite);

        return View('pagePrincipale', compact('codeUNSPSCunite'));
    }

    /**
     * Laisse le fournisseur voir les infomation de sa fiche
     */
    public function show(Utilisateur $utilisateur)
    {
        $contacts = Contacts::where('utilisateur_id', $utilisateur->id)->get();
        $coordonnees = Coordonnees::where('utilisateur_id', $utilisateur->id)->firstOrFail();
        $finances = Finance::where('utilisateur_id', $utilisateur->id)->first();
        $documents = Document::where('utilisateur_id', $utilisateur->id)->get();
        $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'desc_cat', 'code_unspsc', 'desc_det_unspsc')->paginate(10);

        $codes = DB::table('utilisateur_unspsc')
            ->join('code_unspsc', 'utilisateur_unspsc.unspsc_id', '=', 'code_unspsc.code_unspsc')
            ->where('utilisateur_unspsc.utilisateur_id',  $utilisateur->id)
            ->select('utilisateur_unspsc.unspsc_id', 'code_unspsc.nature_contrat', 'code_unspsc.desc_cat', 'code_unspsc.desc_det_unspsc')
            ->get();
    
        //dd($codes);

        return View('ficheFournisseur', compact('utilisateur', 'contacts', 'coordonnees','codes','codeUNSPSCunite', 'documents','finances'));
    }


    /**
     * Sert à modifier les infomations de la fiche du fournisseur
     */
    public function edit(Utilisateur $utilisateur)
    {
        $villes = Ville::all();
        $contacts = Contacts::where('utilisateur_id', $utilisateur->id)->get();
        $coordonnees = Coordonnees::where('utilisateur_id', $utilisateur->id)->firstOrFail();
        $finances = Finance::where('utilisateur_id', $utilisateur->id)->first();
        return View('modificationFicheFournisseur', compact('utilisateur', 'contacts', 'coordonnees','finances', 'villes'));
    }

    /**
     * Updater le compte avec les nouvelles informations
     */

    public function update(InformationModificationNomRequest $requestIdent, InformationCoordonneeRequest $requestCoord, Utilisateur $utilisateur)
    {   
        //dd($utilisateur);
        $contacts = Contacts::where('utilisateur_id', $utilisateur->id)->get();
        $coordonnees = Coordonnees::where('utilisateur_id', $utilisateur->id)->firstOrFail();
        $finances = Finance::where('utilisateur_id', $utilisateur->id)->first();


        $validatedIdent = $requestIdent->validated();
        $validatedCoord = $requestCoord->validated();

        //dd($requestIdent);
        $request = $requestIdent;
        if($request->neq == null){
            $request->request->add(['neq' => $utilisateur->neq]);
        }
        if($request->site == null){
            $request->request->add(['siteweb' => $utilisateur->siteweb]);
        }
        if($request->code_region == null){
            $request->request->add(['code_region' => $utilisateur->code_region]);
        }        
        if($request->ville == null){
            $request->ville = $request->input('ville-autre');
        }        
        if($request->email == null){
            $request->email = $utilisateur->email;
        }

        //dd($requestIdent);

        //Vérification modifs?
        $utilisateur->nom_entreprise = $request->entreprise;
        $utilisateur->neq = $request->neq;
        $utilisateur->email = $request->email;
        $utilisateur->rbq = $request->rbq;

        
        $coordonnees->num_civique = $request->Ncivique;
        $coordonnees->rue = $request->rue;
        $coordonnees->bureau = $request->bureau;

        $coordonnees->province = $request->province;
        $coordonnees->ville = $request->ville;
        
        $coordonnees->code_postal = $request->codePostal;
        $coordonnees->num_telephone = $request->numTel;
        $coordonnees->poste = $request->poste;
        $coordonnees->type_contact = $request->typeContact;
        $coordonnees->siteweb = $request->site;
        
        //s'assure qu'il y a une ligne finance vu qu'il y en a pas encore sur l'inscription
        if ($finances === null) {
            $finances = new Finance();
            $finances->utilisateur_id = $utilisateur->id; // Ensure the association is correct
        }

        $finances->numeroTPS = $request->numeroTPS;
        $finances->numeroTVQ = $request->numeroTVQ;
        $finances->conditionPaiement = $request->conditionPaiement;
        $finances->devise = $request->devise;
        $finances->modeCommunication = $request->modeCommunication;

        
        $utilisateur->save();
        $coordonnees->save();
        $finances->save();
        return redirect()->route('Fournisseur.fiche', [$utilisateur])->with('message', "Modification réussi!");
    }

    /**
     * Sert à modifier les infomations de la fiche du fournisseur
     */
    public function editUNSPSC(Utilisateur $utilisateur)
    {
        $utilisateur = $utilisateur;
        $UNSPSC = CodeUNSPSC::all();
        $codes = DB::table('utilisateur_unspsc')
            ->join('code_unspsc', 'utilisateur_unspsc.unspsc_id', '=', 'code_unspsc.code_unspsc')
            ->where('utilisateur_unspsc.utilisateur_id',  $utilisateur->id)
            ->select('utilisateur_unspsc.unspsc_id', 'code_unspsc.nature_contrat', 'code_unspsc.desc_cat', 'code_unspsc.desc_det_unspsc')
            ->get();
        return View('modificationUNSPSC', compact('UNSPSC','codes','utilisateur'));
    }

    /**
     * Updater le compte avec les nouvelles informations
     */

    public function updateUNSPSC(Request $request, Utilisateur $utilisateur)
    {   
        //dd($request);
        $unspsc_codes = $request->unspsc_codes;
        //dd($unspsc_codes);
        $utilisateurId = $utilisateur->id;
        //dd($utilisateurId);
        
        //dd($utilisateurId, !empty($selectedCodes));
        if ($utilisateurId && !empty($unspsc_codes)) {
            foreach ($unspsc_codes as $unspscId) {
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
                    dd($exists);
                }
            }
        }
        return redirect()->route('Fournisseur.fiche', [$utilisateur])->with('message', "Modification des UNSPSC réussi!");
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
        
        /*Reprence ce qu'il y a dans la page du fournisseur*/
        $utilisateur = Utilisateur::where( 'id', $utilisateur->id)->first();
        $contacts = Contacts::where('utilisateur_id',  $utilisateur->id)->get();
        $finances = Finance::where('utilisateur_id', $utilisateur->id)->first();
        $coordonnees = Coordonnees::where('utilisateur_id',  $utilisateur->id)->firstOrFail();
        $documents = Document::where('utilisateur_id', $utilisateur->id)->get();
        $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'desc_cat', 'code_unspsc', 'desc_det_unspsc')
            ->orderBy('code_unspsc', 'asc')
            ->paginate(10);

            $codes = DB::table('utilisateur_unspsc')
            ->join('code_unspsc', 'utilisateur_unspsc.unspsc_id', '=', 'code_unspsc.code_unspsc')
            ->where('utilisateur_unspsc.utilisateur_id',  $utilisateur->id)
            ->select('utilisateur_unspsc.unspsc_id', 'code_unspsc.nature_contrat', 'code_unspsc.desc_cat', 'code_unspsc.desc_det_unspsc')
            ->get();

        return view('ficheFournisseur', compact('utilisateur', 'contacts', 'coordonnees', 'codes', 'codeUNSPSCunite', 'documents','finances'))->with('message', "Votre compte est rendu inactif");
    }

    public function actif(Utilisateur $utilisateur)
    {
        //Comment on supprime / met inactif les comptes
        // Ajouter une confirmation email pour la désactivation/supression du compte
        $utilisateur->statut = 'Actif';
        $utilisateur->save();
        
        /*Reprence ce qu'il y a dans la page du fournisseur*/
        $utilisateur = Utilisateur::where( 'id', $utilisateur->id)->first();
        $contacts = Contacts::where('utilisateur_id',  $utilisateur->id)->get();
        $coordonnees = Coordonnees::where('utilisateur_id',  $utilisateur->id)->firstOrFail();
        $finances = Finance::where('utilisateur_id', $utilisateur->id)->first();
        $documents = Document::where('utilisateur_id', $utilisateur->id)->get();
        $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'desc_cat', 'code_unspsc', 'desc_det_unspsc')
            ->orderBy('code_unspsc', 'asc')
            ->paginate(10);

        $codes = DB::table('utilisateur_unspsc')
            ->join('code_unspsc', 'utilisateur_unspsc.unspsc_id', '=', 'code_unspsc.code_unspsc')
            ->where('utilisateur_unspsc.utilisateur_id',  $utilisateur->id)
            ->select('utilisateur_unspsc.unspsc_id', 'code_unspsc.nature_contrat', 'code_unspsc.desc_cat', 'code_unspsc.desc_det_unspsc')
            ->get();
        

        return view('ficheFournisseur', compact('utilisateur', 'contacts', 'coordonnees', 'codes', 'codeUNSPSCunite', 'documents','finances'))->with('message', "Votre compte est rendu actif");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function support()
    {
        return View('support');
    }

    public function afficherStatut(Utilisateur $utilisateur)
    {
        //$utilisateur = Utilisateur::where('id', $utilisateur->id)->firstOrFail();
        return View('statutDemande', compact('utilisateur'));
    }

    /*
    public function recherche(Request $request)
    {

        if($request->recherche == ""){
            $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'desc_cat', 'code_unspsc', 'desc_det_unspsc')
            ->orderBy('code_unspsc', 'asc')
            ->paginate(10);

            //Reprence ce qu'il y a dans la page du fournisseur
            $utilisateurId = $request->fiche_utilisateur_id;

            $coordonnees = Coordonnees::where('utilisateur_id', $request->fiche_utilisateur_id)->firstOrFail();
            $utilisateur = Utilisateur::where( 'id', $request->fiche_utilisateur_id)->first();
            $contacts = Contacts::where('utilisateur_id',  $request->fiche_utilisateur_id)->get();
            $documents = Document::where('utilisateur_id', $request->fiche_utilisateur_id)->get();
            $finances = Finance::where('utilisateur_id', $utilisateur->id)->first();

            $codes = DB::table('utilisateur_unspsc')
                ->join('code_unspsc', 'utilisateur_unspsc.unspsc_id', '=', 'code_unspsc.code_unspsc')
                ->where('utilisateur_unspsc.utilisateur_id',  $request->fiche_utilisateur_id)
                ->select('utilisateur_unspsc.unspsc_id', 'code_unspsc.nature_contrat', 'code_unspsc.desc_cat', 'code_unspsc.desc_det_unspsc')
                ->get();

            return view('ficheFournisseur', compact('utilisateur', 'contacts', 'coordonnees', 'codes', 'codeUNSPSCunite', 'documents','codeUNSPSCunite','finances'));
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
        else if($request->desc_cat == "on"){
            $query->whereAny(['desc_cat'], 'LIKE' , "%$recherche%");
        }
        else{
            $query->whereAny(['code_unspsc', 'desc_det_unspsc', 'nature_contrat' ,'desc_cat'], 'LIKE' , "%$recherche%");
        }

        $codeUNSPSCunite = $query->paginate(10);

        //Reprence ce qu'il y a dans la page du fournisseur
        $utilisateur = Utilisateur::where( 'id', $request->fiche_utilisateur_id)->first();
        $contacts = Contacts::where('utilisateur_id',  $request->fiche_utilisateur_id)->get();
        $coordonnees = Coordonnees::where('utilisateur_id',  $request->fiche_utilisateur_id)->firstOrFail();
        $documents = Document::where('utilisateur_id', $request->fiche_utilisateur_id)->get();
        $finances = Finance::where('utilisateur_id', $utilisateur->id)->first();

        $codes = DB::table('utilisateur_unspsc')
            ->join('code_unspsc', 'utilisateur_unspsc.unspsc_id', '=', 'code_unspsc.code_unspsc')
            ->where('utilisateur_unspsc.utilisateur_id',  $request->fiche_utilisateur_id)
            ->select('utilisateur_unspsc.unspsc_id', 'code_unspsc.nature_contrat', 'code_unspsc.desc_cat', 'code_unspsc.desc_det_unspsc')
            ->get();

        return view('ficheFournisseur', compact('utilisateur', 'contacts', 'coordonnees', 'codes', 'codeUNSPSCunite', 'documents','finances'));
    }
    */
    
    public function choisit(Request $request)
    {
        $selectedCodes = $request->code_unspsc_choisit;
        $utilisateurId = $request->fiche_utilisateur_id;
        
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

        //Reprence ce qu'il y a dans la page du fournisseur
        $utilisateur = Utilisateur::where( 'id', $request->fiche_utilisateur_id)->first();
        $contacts = Contacts::where('utilisateur_id',  $request->fiche_utilisateur_id)->get();
        $coordonnees = Coordonnees::where('utilisateur_id',  $request->fiche_utilisateur_id)->firstOrFail();
        $documents = Document::where('utilisateur_id', $request->fiche_utilisateur_id)->get();
        $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'desc_cat', 'code_unspsc', 'desc_det_unspsc')->paginate(10);
        $finances = Finance::where('utilisateur_id', $utilisateur->id)->first();
        
        $codes = DB::table('utilisateur_unspsc')
            ->join('code_unspsc', 'utilisateur_unspsc.unspsc_id', '=', 'code_unspsc.code_unspsc')
            ->where('utilisateur_unspsc.utilisateur_id',  $request->fiche_utilisateur_id)
            ->select('utilisateur_unspsc.unspsc_id', 'code_unspsc.nature_contrat', 'code_unspsc.desc_cat', 'code_unspsc.desc_det_unspsc')
            ->get();


        return view('ficheFournisseur', compact('utilisateur', 'contacts', 'coordonnees', 'codes', 'codeUNSPSCunite', 'documents','finances'));
    }

    public function supprimerCodeUnspsc(Request $request)
    {
        $unspscId = $request->unspsc_id;
        $utilisateurId = $request->utilisateur_id;

        if ($unspscId && $utilisateurId) {
            DB::table('utilisateur_unspsc')
                ->where('unspsc_id', $unspscId)
                ->where('utilisateur_id', $utilisateurId)
                ->delete();
        }

        return redirect()->back()->with('success', 'Code UNSPSC supprimé avec succès.');
    }

    
    public function supprimerContact(Request $request)
    {
        $contactId = $request->contact_id;
        $utilisateurId = $request->utilisateur_id;

        if ($contactId && $utilisateurId) {
            DB::table('contacts')
                ->where('id', $contactId)
                ->where('utilisateur_id', $utilisateurId)
                ->delete();
        }

        return redirect()->back()->with('success', 'Contact supprimé avec succès.');
    }

    /*
    Debug pour les codes unspsc
        <!-- Debugging Section -->
        <h4>Debugging Selected UNSPSC Codes:</h4>
        @foreach (request('code_unspsc_choisit', []) as $selectedCode)
            <input type="text" name="code_unspsc_choisit[]" value="{{ $selectedCode }}" />
        @endforeach
    */

    public function nouveauContact(Utilisateur $utilisateur)
    {
        return view('nouveauContact', compact('utilisateur'));
    }

    public function nouveauContactUpdate(Request $request, Utilisateur $utilisateur)
    {
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'email_contact' => 'required|email|max:255',
            'num_contact' => 'nullable|string|max:20',
        ]);
    
        try {
            // Create new contact
            $contact = new Contacts();
            $contact->prenom = ucfirst($validated['prenom']);
            $contact->nom = ucfirst($validated['nom']);
            $contact->fonction = $validated['fonction'];
            $contact->email_contact = $validated['email_contact'];
            $contact->num_contact = $validated['num_contact'];
            $contact->utilisateur_id = $utilisateur->id;
            $contact->save();
    
            return redirect()->route('Fournisseur.fiche', ['utilisateur' => $utilisateur->id])
                             ->with('success', 'Contact ajouté avec succès!');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->withErrors(['error' => 'Une erreur est survenue.']);
        }
    }
}
