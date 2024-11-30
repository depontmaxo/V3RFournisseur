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
        $contacts = Contacts::where('utilisateur_id', $utilisateur->id)->get();
        $coordonnees = Coordonnees::where('utilisateur_id', $utilisateur->id)->firstOrFail();
        $finances = Finance::where('utilisateur_id', $utilisateur->id)->first();
        return View('modificationFicheFournisseur', compact('utilisateur', 'contacts', 'coordonnees','finances'));
    }

    /**
     * Updater le compte avec les nouvelles informations
     */

    public function update(Request $request, Utilisateur $utilisateur)
    {   
        if($request->neq == null){
            $request->request->add(['neq' => $utilisateur->neq]);
        }
        if($request->siteweb == null){
            $request->request->add(['siteweb' => $utilisateur->siteweb]);
        }

        
        $validated = $request->validate(
            array_merge(
                $this->reglesValidationsIdentification($utilisateur),
                $this->reglesValidationsCoordonnees($utilisateur),
                //$this->reglesValidationsContacts($utilisateur)
            ),
            array_merge(
                $this->messagesValidationIdentification(),
                $this->messagesValidationCoordonnees(),
                $this->messagesValidationFinances()
                //$this->messagesValidationContacts(),
            )
        );

        $contacts = Contacts::where('utilisateur_id', $utilisateur->id)->get();
        $coordonnees = Coordonnees::where('utilisateur_id', $utilisateur->id)->firstOrFail();
        $finances = Finance::where('utilisateur_id', $utilisateur->id)->first();

        //Vérification modifs?
        $utilisateur->nom_entreprise = $request->nom_entreprise;
        $utilisateur->neq = $request->neq;
        $utilisateur->email = $request->email;
        $utilisateur->rbq = $request->rbq;

        $coordonnees->bureau = $request->bureau;
        $coordonnees->num_civique = $request->num_civique;
        $coordonnees->rue = $request->rue;
        $coordonnees->ville = $request->ville;
        $coordonnees->code_region = $request->code_region;
        $coordonnees->region_administrative = $request->region_administrative;
        $coordonnees->province = $request->province;
        $coordonnees->code_postal = $request->code_postal;
        $coordonnees->num_telephone = $request->num_telephone;
        $coordonnees->poste = $request->poste;
        $coordonnees->type_contact = $request->type_contact;
        $coordonnees->siteweb = $request->siteweb;
        
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

        /* Pour le changer, delete et en refaire un autre
        foreach ($contacts as $index => $contact) {
            $contact->prenom = $request->input("prenom.{$index}");
            $contact->nom = $request->input("nom.{$index}");
            $contact->poste = $request->input("poste.{$index}");
            $contact->email_contact = $request->input("email_contact.{$index}");
            $contact->num_contact = $request->input("num_contact.{$index}");
            $contact->save();
        }
        */
        
        $utilisateur->save();
        $coordonnees->save();
        $finances->save();
        return redirect()->route('Fournisseur.fiche', [$utilisateur])->with('message', "Modification de " . $utilisateur->nom . " réussi!");
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

    public function recherche(Request $request)
    {

        if($request->recherche == ""){
            $codeUNSPSCunite = CodeUNSPSC::select('nature_contrat', 'desc_cat', 'code_unspsc', 'desc_det_unspsc')
            ->orderBy('code_unspsc', 'asc')
            ->paginate(10);

            /*Reprence ce qu'il y a dans la page du fournisseur*/
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

        /*Reprence ce qu'il y a dans la page du fournisseur*/
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

    
    public function choisit(Request $request)
    {
        
        //dd($request->code_unspsc_choisit);
        //dd($request->fiche_utilisateur_id);
        
        $selectedCodes = $request->code_unspsc_choisit;
        $utilisateurId = $request->fiche_utilisateur_id;
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

        /*Reprence ce qu'il y a dans la page du fournisseur*/
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

    //////////////////////////////////////
    //RÈGLES VALIDATION POUR LES UPDATES//
    //////////////////////////////////////
    protected function reglesValidationsIdentification(Utilisateur $utilisateur)
    {
        return [
            'nom_entreprise' => [
                'required', 
                'min:5', 
                'max:75', 
                'regex:/^(?! )[A-Za-z0-9.-]+( [A-Za-z0-9.-]+)*(?<! )$/', // Autorise les points et traits d'union et vérifie qu'il n'y a plusieurs espaces un après l'autre
                'unique:utilisateur,nom_entreprise,' . $utilisateur->id
            ],
            'neq' => [
                'nullable',
                /*
                'digits:14', 
                'regex:/^(11|22|33|88)[4-9][0-9]{7}$/', // Structure spécifique du NEQ
                */
                'unique:utilisateur,neq,' . $utilisateur->id
            ],
            'email' => [
                'required', 
                'min:5', 
                'max:75', 
                'regex:/^[^\s]*$/', 
                'unique:utilisateur,email,' . $utilisateur->id
            ],

            /*'password' => [
                'required', 
                'min:3', 
                'max:15', 
                'confirmed',
                'regex:/^[^\s]*$/' //Vérifie qu'il ne contient aucun espace dans le string
                ]
            'password' => [
                'required', 
                'min:8', 
                'max:15', 
                'regex:/[!@#$%^&*(),.?":{}|<>]/', // au moins un caractère spécial
                'regex:/.*\d.*\d.*$/', // au moins deux chiffres
                'confirmed',
                'regex:/^[^\s]*$/' //Vérifie qu'il ne contient aucun espace dans le string
                ]*/
        ];
    }
    
    protected function reglesValidationsCoordonnees(Utilisateur $utilisateur)
    {
        return [
            /////////////////////////
            'num_civique' => [
                'required',
                'max:8',
                'alpha_num',
            ], 

            'rue' => [
                'required',
                'max:64',
                'regex:/^[a-zA-Z0-9\s\-.,;:!()&]*$/', // Alphanumérique et certains caractères spéciaux
            ], 

            'code_region' => [
                'required', 
            ], 
            
            'region_administrative' => [
                'required', 
            ], 

            'poste' => [
                'nullable', 
                'max:6',
                'integer'
            ],

            'type_contact' => [
                'required', 
            ],

            //////////////////////////
            'bureau' => [
                'nullable', 
                'max:8',
                'alpha_num',
            ], 

            'ville' => [
                'required', 
                'regex:/^[A-Za-zÀ-ÿ0-9]+(?:[- ][A-Za-zÀ-ÿ0-9]+)*$/', // Acceptation des lettres accentuées
                'min:3', 
                'max:30'
            ], 

            'province' => [
                'required', 
                'min:3', 
                'max:25', 
                'regex:/^[A-Za-zÀ-ÿ0-9\s\-]*$/' // Acceptation des lettres accentuées, espaces et tirets
            ], 

            'code_postal' => [
                'required', 
                'regex:/^[A-Za-z]\d[A-Za-z]\s?\d[A-Za-z]\d$/'
            ],

            'siteweb' => [
                'nullable', 
                'url'
            ],

            'num_telephone' => [
                'required', 
                'digits:10', 
                'integer'
            ],
        ];
    }

    protected function reglesValidationsContacts(Utilisateur $utilisateur)
    {
        return [
            'prenom.*' => [
                'required', 
                'regex:/^[^\s]*$/', 
                'min:3', 
                'max:20'
            ],

            'nom.*' => [
                'required', 
                'regex:/^[^\s]*$/', 
                'min:3', 
                'max:50'
            ],

            'poste.*' => [
                'required', 
                'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/', 
                'min:3', 
                'max:30'
            ],

            'email_contact.*' => [
                'required', 
                'min:5', 
                'max:75', 
                'regex:/^[^\s]*$/',
                'unique:contacts,email_contact,' . $utilisateur->id. ',utilisateur_id' //cette logique permet que 2 utilisateurs utilise le meme email, mais il ne peuvent pas avoir le email d'un contact avec un utilisateur différent
            ],

            'num_contact.*' => [
                'required', 
                'digits:10', 
                'integer'
            ],
        ];
    }

    /*protected function reglesValidationsRBQ()
    {
        return [
            'rbq' => [
                'nullable'
            ],

            'documents' => [
                'required', 
                'array'
            ],

            'documents.*' => [
                'file', 
                'mimes:docx,doc,pdf,jpg,jpeg,xls,xlsx', 
                'max:75000'
            ],
        ];
    }*/

    //==============Messages personnalisés==============
    protected function messagesValidationIdentification()
    {
        return [
            'nom_entreprise.required' => 'Ce champ est obligatoire',
            'nom_entreprise.min' => 'Le champ entreprise doit contenir au moins :min caractères.',
            'nom_entreprise.max' => 'Le champ entreprise ne peut pas dépasser :max caractères.',
            'nom_entreprise.regex' => 'Le champ entreprise ne doit pas contenir d\'espaces consécutifs.',
            'nom_entreprise.unique' => 'Ce nom d\'entreprise est déjà utilisé',
    
            'neq.required' => 'Ce champ est obligatoire',
            'neq.digits' => 'Le champ neq doit contenir exactement :digits chiffres.',
            'neq.integer' => 'Le champ neq doit contenir uniquement des chiffres entiers.',
            'neq.unique' => 'Ce code NEQ est déjà utilisé',
    
            'email.required' => 'Ce champ est obligatoire',
            'email.min' => 'Le champ courriel doit contenir au moins :min caractères.',
            'email.max' => 'Le champ courriel ne peut pas dépasser :max caractères.',
            'email.regex' => 'Le champ courriel ne doit pas contenir d\'espaces.',
            'email.unique' => 'Ce courriel est déjà utilisé',
    
            /*'password.required' => 'Ce champ est obligatoire',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.max' => 'Le mot de passe ne peut pas dépasser :max caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.regex' => 'Le mot de passe ne doit pas contenir d\'espaces.',*/
        ];
    }

    protected function messagesValidationCoordonnees()
    {
        return [
            'adresse.required' => 'Ce champ est obligatoire.',
            'adresse.regex' => 'Le format de l\'adresse est invalide.',
            'adresse.min' => 'L\'adresse doit contenir au moins :min caractères.',
            'adresse.max' => 'L\'adresse ne peut pas dépasser :max caractères.',
    
            'bureau.regex' => 'Le format du bureau est invalide.',
            'bureau.max' => 'Le bureau ne peut pas dépasser :max caractères.',
    
            'ville.required' => 'Ce champ est obligatoire.',
            'ville.regex' => 'Le format de la ville est invalide.',
            'ville.min' => 'La ville doit contenir au moins :min caractères.',
            'ville.max' => 'La ville ne peut pas dépasser :max caractères.',
    
            'province.required' => 'Ce champ est obligatoire.',
            'province.min' => 'La province doit contenir au moins :min caractères.',
            'province.max' => 'La province ne peut pas dépasser :max caractères.',
            'province.regex' => 'Le format de la province est invalide.',
    
            'code_postal.required' => 'Ce champ est obligatoire.',
            'code_postal.regex' => 'Le format du code postal est invalide.',
    
            'pays.required' => 'Ce champ est obligatoire.',
            'pays.regex' => 'Le format du pays est invalide.',
            'pays.min' => 'Le pays doit contenir au moins :min caractères.',
            'pays.max' => 'Le pays ne peut pas dépasser :max caractères.',
    
            'siteweb.url' => 'Le champ site doit être une URL valide.',
    
            'num_telephone.required' => 'Ce champ est obligatoire.',
            'num_telephone.digits' => 'Le numéro de téléphone doit contenir exactement :digits chiffres.',
            'num_telephone.integer' => 'Le numéro de téléphone doit être un entier.',
        ];
    }

    protected function messagesValidationContacts()
    {
        return [
            'prenom.*.required' => 'Ce champ est obligatoire.',
            'prenom.*.regex' => 'Le prénom ne doit pas contenir d\'espaces.',
            'prenom.*.min' => 'Le prénom doit contenir au moins :min caractères.',
            'prenom.*.max' => 'Le prénom ne peut pas dépasser :max caractères.',
    
            'nom.*.required' => 'Ce champ est obligatoire.',
            'nom.*.regex' => 'Le nom ne doit pas contenir d\'espaces.',
            'nom.*.min' => 'Le nom doit contenir au moins :min caractères.',
            'nom.*.max' => 'Le nom ne peut pas dépasser :max caractères.',
    
            'poste.*.required' => 'Ce champ est obligatoire.',
            'poste.*.regex' => 'Le format du poste est invalide.',
            'poste.*.min' => 'Le poste doit contenir au moins :min caractères.',
            'poste.*.max' => 'Le poste ne peut pas dépasser :max caractères.',
    
            'email_contact.*.required' => 'Ce champ est obligatoire.',
            'email_contact.*.min' => 'Le courriel doit contenir au moins :min caractères.',
            'email_contact.*.max' => 'Le courriel ne peut pas dépasser :max caractères.',
            'email_contact.*.regex' => 'Le courriel ne doit pas contenir d\'espaces.',
            'email_contact.*.unique' => 'Ce courriel est déjà utilisé',
    
            'num_contact.*.required' => 'Ce champ est obligatoire.',
            'num_contact.*.digits' => 'Le numéro de contact doit contenir exactement :digits chiffres.',
            'num_contact.*.integer' => 'Le numéro de contact doit être un entier.',
        ];
    }

    /*Validation pour Finances*/
    protected function messagesValidationFinances()
    {
        return [
            'numeroTPS .*.required' => 'Ce champ est obligatoire.',
            'numeroTPS.*.regex' => 'Le prénom ne doit pas contenir d\'espaces.',
            'numeroTPS.*.min' => 'Le prénom doit contenir au moins :min caractères.',
            'numeroTPS.*.max' => 'Le prénom ne peut pas dépasser :max caractères.',
    
            'numeroTVQ .*.required' => 'Ce champ est obligatoire.',
            'numeroTVQ .*.regex' => 'Le nom ne doit pas contenir d\'espaces.',
            'numeroTVQ.*.min' => 'Le nom doit contenir au moins :min caractères.',
            'numeroTVQ.*.max' => 'Le nom ne peut pas dépasser :max caractères.',
    
            'conditionPaiement.*.required' => 'Ce champ est obligatoire.',
            'conditionPaiement.*.regex' => 'Le format du poste est invalide.',
            'conditionPaiement.*.min' => 'Le poste doit contenir au moins :min caractères.',
            'conditionPaiement.*.max' => 'Le poste ne peut pas dépasser :max caractères.',
    
            'devise.*.required' => 'Ce champ est obligatoire.',
            'devise.*.min' => 'Le courriel doit contenir au moins :min caractères.',
            'devise.*.max' => 'Le courriel ne peut pas dépasser :max caractères.',
            'devise.*.regex' => 'Le courriel ne doit pas contenir d\'espaces.',
    
            'modeCommunication.*.required' => 'Ce champ est obligatoire.',
            'modeCommunication.*.min' => 'Le courriel doit contenir au moins :min caractères.',
            'modeCommunication.*.max' => 'Le courriel ne peut pas dépasser :max caractères.',
            'modeCommunication.*.regex' => 'Le courriel ne doit pas contenir d\'espaces.',
        ];
    }

    protected function messagesValidationRBQ()
    {
        return [
            'rbq.nullable' => 'Le champ RBQ est facultatif.',
            
            /*'documents.required' => 'Veuillez fournir au moins 1 document pour prouver l\'existence de votre entreprise.',
            'documents.array' => 'Les documents doivent être un tableau.',
    
            'documents.*.file' => 'Chaque document doit être un fichier valide.',
            'documents.*.mimes' => 'Chaque document doit être de type :values.',
            'documents.*.max' => 'Chaque document ne peut pas dépasser :max Ko.',*/
        ];
    }
    
}
