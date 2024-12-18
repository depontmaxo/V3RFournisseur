<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Utilisateur;
use App\Models\Document;
use App\Models\Coordonnees;
use App\Models\Contacts;
use App\Models\Ville;
use App\Models\RegionAdministrative;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\welcomeUserMail;
use App\Models\CodeUNSPSC;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\Inscription\InformationIdentificationRequest;
use App\Http\Requests\Inscription\InformationProduitsRequest;
use App\Http\Requests\Inscription\InformationCoordonneeRequest;
use App\Http\Requests\Inscription\InformationContactsRequest;
use App\Http\Requests\Inscription\InformationAutresRequest;


class InscriptionController extends Controller
{
    //==============Section contenant les chemins de chaque page==============
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
        $villes = Ville::all();
        return View('Inscription.inscriptionCoordonnees', compact('villes'));
    }

    public function produits()
    {
        $UNSPSC = CodeUNSPSC::all();
        return View('Inscription.inscriptionProduits', compact('UNSPSC'));
    }

    public function rbq()
    {
        return View('Inscription.inscriptionRBQ');
    }

    public function formComplet()
    {
        return View('Inscription.inscriptionComplet');
    }




    
    //==============Section qui s'occupe d'exécuter la validation et redirect vers la page suivante==============
    public function verificationIdentification(InformationIdentificationRequest $request)
    {
        // La validation est déjà effectuée avant d'entrer dans cette méthode
        $validatedData = $request->validated(); // Récupère les données validées

        /*Hashage mdp*/
        $hashedPassword = Hash::make($request->password);

        $this->storeInSession($request, $validatedData + ['password' => $hashedPassword]);

        return redirect()->route('Inscription.Produits');


        /*if ($request->has('neq')) {
            $request->merge([
                'neq' => str_replace('-', '', $request->input('neq'))
            ]);
        }

        $validatedData = $request->validate(
            $this->reglesValidationsIdentification(),
            $this->messagesValidationIdentification()
        );

        /Hashage mdp
        $hashedPassword = Hash::make($request->password);

        $this->storeInSession($request, $validatedData + ['password' => $hashedPassword]);

        return redirect()->route('Inscription.Produits');*/
    }


    //Validation des **UNSPS**
    public function verificationProduits(InformationProduitsRequest $request)
    {
        $validatedData = $request->validated();

        $selectedCodes = [];
        $selectedCodesArray = json_decode($request->input('selected_codes'), true);

        foreach ($selectedCodesArray as $code) {
            $selectedCodes[] = $code;  // This adds the code to the $selectedCodes array
        }

        $this->storeInSession($request, ['selectedCodes' => $selectedCodes]);
        return redirect()->route('Inscription.Coordonnees');

        //dd($request->all());
        /*$validatedData = $request->validate(
            $this->reglesValidationsProduits(),
            $this->messagesValidationProduits()
        );

        $selectedCodes = [];
        $selectedCodesArray = json_decode($request->input('selected_codes'), true);
        
        // Iterate over the $selectedCodesArray and add each code to $selectedCodes
        foreach ($selectedCodesArray as $code) {
            $selectedCodes[] = $code;  // This adds the code to the $selectedCodes array
        }
        

        //dd($selectedCodesArray);

        $this->storeInSession($request, ['selectedCodes' => $selectedCodes]);
        return redirect()->route('Inscription.Coordonnees');*/
    }

    //Validation des **COORDONNÉES**
    public function verificationCoordonnees(InformationCoordonneeRequest $request)
    {
        if ($request->has('numTel')) {
            $request->merge([
                'numTel' => str_replace('-', '', $request->input('numTel'))
            ]);
        }
        if ($request->input('province') === 'Québec') {
            $request->merge([
                'ville-autre' => $request->input('ville'),
            ]);
        } 
        else {
            $request->merge([
                'ville' => $request->input('ville-autre'),
            ]);
        }

        $validatedData = $request->validated();

        if ($request->input('province') === 'Québec'){
            $validatedData['ville'] = $request->input('ville');
            $validatedData['ville-autre'] = '';

            $ville = Ville::where('ville', $request->only('ville'))->firstOrFail();
            $region = RegionAdministrative::where('code', $ville->region_code)->firstOrFail();
            $regionNom = $region->region;
            $regionCode = $region->code;
        }
        else{
            $validatedData['ville'] = $request->input('ville-autre');
            $regionNom = null;
            $regionCode = null;
        }

        $this->storeInSession($request, $validatedData + ['region' => $regionNom] + ['code' => $regionCode]);
        return redirect()->route('Inscription.Contact');
    }

    //Validation des **CONTACTS**
    public function verificationContact(InformationContactsRequest $request)
    {
        
        /* enleve les tirets */
        if ($request->has('numContact')) {
            $request->merge([
                'numContact' => str_replace('-', '', $request->input('numContact'))
            ]);
        }

        $validatedData = $request->validated();
        $this->storeInSession($request, $validatedData);
        return redirect()->route('Inscription.RBQ');
    }

    //Validation des **DOCUMENTS**
    public function verificationRBQ(InformationAutresRequest $request)
    {
        //Si vous avez l'erreur "Content Too Large" de Laravel, il faut aller dans le fichier php.ini dans le composer et changer les valeurs des lignes :
        //post_max_size (mettre environ 250M) comme ca on évite l'erreur de Laravel
        //upload_max_filesize (mettre environ 250M) - Ensuite il faut redémarrer VSCode et le site
        if ($request->has('rbq')) {
            $request->merge([
                'rbq' => str_replace('-', '', $request->input('rbq'))
            ]);
        }

        $validatedData = $request->validated();

        // Récupérer les fichiers validés
        $uploadedFiles = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                if ($file->isValid()) {
                    $fileStream = base64_encode(file_get_contents($file->getRealPath()));
                    $uploadedFiles[] = [
                        'name' => $file->getClientOriginalName(),
                        'size' => $file->getSize(),
                        'type' => $file->getClientMimeType(),
                        'stream' => $fileStream, // Ouvrir le fichier en tant que flux
                        //'stream' => fopen($file->getRealPath(), 'rb'), // Ouvrir le fichier en tant que flux
                    ];
                }
            }
        }

        // Stocker les données dans la session
        $this->storeInSession($request, $request->only('rbq') + ['documents' => $uploadedFiles]);
        return redirect()->route('Inscription.Complet');
    }


    //==============Gestion envoie de formulaire==============
    public function envoyerFormulaire(Request $request)
    {
        //FAIT UNE DERNIERE VERIFICATION DES DONNÉES ICI POUR EVITER DES BUGS
        // Récupérer les données de la session
        $data = session('user_data', []);
        //dd($data);
        $uuid = (string) Str::uuid();

        // Créer l'utilisateur
        $utilisateur = Utilisateur::create([
            'id' => $uuid,
            'nom_entreprise' => $data['entreprise'],
            'neq' => $data['neq'],
            'email' => $data['courrielConnexion'],
            'password' => $data['password'],
            'statut' => 'En attente',
            'rbq' => $data['rbq']
        ]);

        // Récupérer les fichiers de la session
        $documents = $data['documents'] ?? [];
        
        if (!empty($documents)) {
            foreach ($documents as $file) {
                // Enregistrer chaque fichier dans la table 'documents'
                $utilisateur->documents()->create([
                    'file_name' => $file['name'],
                    'file_size' => $file['size'],
                    'file_type' => $file['type'],
                    'file_stream' => $file['stream'],
                    // 'utilisateurs_id' => $formulaire->id, // Cette ligne est gérée automatiquement par Eloquent
                ]);
            }
        }

        $utilisateur->coordonnees()->create([
            'num_civique' => $data['Ncivique'],
            'rue' => $data['rue'],
            'bureau' => $data['bureau'],
            'ville' => $data['ville'],
            'region_administrative' => $data['region'],
            'code_region' => $data['code'],
            'province' => $data['province'],
            'code_postal' => Str::upper($data['codePostal']),
            'num_telephone' => $data['numTel'],
            'poste' => $data['posteTel'],
            'type_contact' => $data['typeContact'],
            'siteweb' => $data['site'],
        ]);


        $utilisateur->contacts()->create([
            /*'utilisateur_id' => $uuid,*/
            'prenom' => $data['prenom'],
            'nom' => $data['nom'],
            'fonction' => $data['fonction'],
            'email_contact' => $data['courrielContact'],
            'num_contact' => $data['numContact'],
            'poste_tel' => $data['posteTelContact'],
            'type_contact' => $data['typeTelContact'],
        ]);


        $selectedCodes = $data['selectedCodes'] ?? [];
        if ($uuid && !empty($selectedCodes)) {
            foreach ($selectedCodes as $unspscId) {
                // Regarde si il existe déjà
                $exists = DB::table('utilisateur_unspsc')
                    ->where('utilisateur_id', $uuid)
                    ->where('unspsc_id', $unspscId)
                    ->exists();
        
                // Insertion
                if (!$exists) {
                    DB::table('utilisateur_unspsc')->insert([
                        'utilisateur_id' => $uuid,
                        'unspsc_id' => $unspscId,
                    ]);
                }
                else{
                    //Mettre un message d'erreur
                    //dd($exists);
                }
            }
        }

        // Effacer les données de la session
        session()->forget('user_data');

        //Mail::to($utilisateur->email)->send(new welcomeUserMail());

        // Redirection après l'envoi
        return redirect()->route('Connexion.pageConnexion')->with('success', 'Inscription réussie !');
    }



    //==============Fonctions pour storer les données==============
    protected function storeInSession(Request $request, $stepData)
    {
        $data = session('user_data', []);
        $data = array_merge($data, $stepData);
        session(['user_data' => $data]);
    }

    

    //==============RÈGLES DE VALIDATION==============
    protected function reglesValidationsIdentification()
    {
        return [
            'entreprise' => [
                'required', 
                'min:5', 
                'max:75', 
                'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/', //Vérifie qu'il n'y a plusieurs espaces un après l'autre
                'unique:utilisateur,nom_entreprise'
            ],

            'neq' => [
                'nullable',
                'required_without:courrielConnexion', // La valeur est obligatoire.
                'string',   // La valeur doit être une chaîne de caractères.
                'unique:utilisateur,neq',
                
                function ($attribute, $value, $fail) {
                    // Suppression des espaces pour valider le contenu réel
                    $cleanedValue = preg_replace('/\s+/', '', $value);
        
                    // Vérification : le champ est-il bien de 10 chiffres, commence-t-il par 11, 22, 33 ou 88 ?
                    if (!preg_match('/^(11|22|33|88)\d{8}$/', $cleanedValue)) {
                        if (!preg_match('/^\d+$/', $cleanedValue)) {
                            $fail('Le champ NEQ ne doit contenir que des caractères numériques.');
                        } elseif (strlen($cleanedValue) !== 10) {
                            $fail('Le champ NEQ doit être composé exactement de 10 caractères numériques.');
                        } elseif (!preg_match('/^(11|22|33|88)/', $cleanedValue)) {
                            $fail('Le champ NEQ doit commencer par 11, 22, 33 ou 88.');
                        } else {
                            $fail('Le champ NEQ n’est pas conforme.');
                        }
                    }
                },
            ],

            'courrielConnexion' => [
                'nullable',
                'required_without:neq',
                'email',
                'max:64', 
                'regex:/^[^\s\-\.](?!.*\.\.)(?!.*--)(?!.*\.\-|-\.).*[^-\.\s]$/u', // Empêche doubles points, tirets mal placés
                'regex:/^[^@\s]+@[^@\s]+\.[a-zA-Z]{2,}$/', // S'assure que le courriel a une extension valide
                'regex:/^[^-@]+@[^-@]+$/', // Empêche un tiret juste avant ou après le @
                'unique:utilisateur,email'
            ],
            'password' => [
                'required', 
                'string',
                'min:7', 
                'max:12', 
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{7,12}$/',
                'confirmed',
                'regex:/^[^\s]*$/' //Vérifie qu'il ne contient aucun espace dans le string
                ]
        ];
    }

    protected function reglesValidationsProduits()
    {
        return [
            /*'unspsc_codes' => [
                'required', 
                'array'
            ],*/

                'selected_codes' => [
                'required',        // Ensure it’s provided
                'json',            // Ensure it’s a valid JSON string
                function ($attribute, $value, $fail) {  // Custom validation to decode and check if the value is an array
                    $decoded = json_decode($value, true);
                    if (!is_array($decoded)) {
                        $fail("The $attribute must be a valid JSON array.");
                    }
                },
            ],
        ];
    }

    
    protected function reglesValidationsCoordonnees()
    {
        return [
            'Ncivique' => [
                'required',
                'max:8',
                'alpha_num',
            ], 

            'rue' => [
                'required',
                'max:64',
                'regex:/^[a-zA-Z0-9\s\-.,;:!()&]*$/', // Alphanumérique et certains caractères spéciaux
            ], 

            'bureau' => [
                'nullable', 
                'max:8',
                'alpha_num',
            ], 

            'ville' => [
                'required_without:ville-autre',
                'regex:/^[A-Za-zÀ-ÿ0-9]+(?:[- ][A-Za-zÀ-ÿ0-9]+)*$/', // Acceptation des lettres accentuées
                'max:64',
                'required_if:province,Québec'
            ], 

            'ville-autre' => [
                'required_without:ville', 
                'regex:/^[A-Za-zÀ-ÿ0-9]+(?:[- ][A-Za-zÀ-ÿ0-9]+)*$/', // Acceptation des lettres accentuées
                'max:64',
                'required_if:province,!Québec'
            ], 

            'province' => [
                'required', 
                'min:3', 
                'max:25', 
                'regex:/^[A-Za-zÀ-ÿ0-9\s\-]*$/' // Acceptation des lettres accentuées, espaces et tirets
            ], 

            'codePostal' => [
                'required', 
                'regex:/^[A-Za-z]\d[A-Za-z]\s?\d[A-Za-z]\d$/'
            ],

            'site' => [
                'nullable', 
                'url'
            ],

            'numTel' => [
                'required', 
                'digits:10', 
                'integer'
            ],

            'posteTel' => [
                'nullable', 
                'digits_between:1,6'
            ],

            'typeContact' => [
                'required', 
            ],


        ];
    }

    protected function reglesValidationsContacts()
    {
        return [
            'prenom' => [
                'required', 
                'regex:/^[A-Za-zÀ-ÿ,\'\- ]*$/', 
                'max:32'
            ],

            'nom' => [
                'required', 
                'regex:/^[A-Za-zÀ-ÿ,\'\- ]*$/',  
                'max:32'
            ],

            'fonction' => [
                'nullable', 
                'regex:/^[A-Za-zÀ-ÿ\W_]*$/', 
                'max:32'
            ],

            'courrielContact' => [
                'required', 
                'email',
                'max:64', 
                'regex:/^[^\s\-\.](?!.*\.\.)(?!.*--)(?!.*\.\-|-\.).*[^-\.\s]$/u', // Empêche doubles points, tirets mal placés
                'regex:/^[^@\s]+@[^@\s]+\.[a-zA-Z]{2,}$/', // S'assure que le courriel a une extension valide
                'regex:/^[^-@]+@[^-@]+$/', // Empêche un tiret juste avant ou après le @
                'unique:contacts,email_contact'
            ],

            'numContact' => [
                'required', 
                'digits:10', 
                'integer'
            ],

            'posteTelContact' => [
                'nullable', 
                'digits_between:1,6'
            ],

            'typeTelContact' => [
                'required',
            ],
        ];
    }

    protected function reglesValidationsRBQ()
    {
        return [
            'rbq' => [
                'nullable',
                'digits:10',
            ],

            'documents' => [
                'nullable', 
                'array'
            ],

            'documents.*' => [
                'file', 
                'mimes:docx,doc,pdf,jpg,jpeg,xls,xlsx', 
                'max:75000'
            ],
        ];
    }

    //==============Messages personnalisés==============
    protected function messagesValidationIdentification()
    {
        return [
            'entreprise.required' => 'Ce champ est obligatoire.',
            'entreprise.min' => 'Le champ entreprise doit contenir au moins :min caractères.',
            'entreprise.max' => 'Le champ entreprise ne peut pas dépasser :max caractères.',
            'entreprise.regex' => 'Le champ entreprise ne doit pas contenir d\'espaces consécutifs.',
            'entreprise.unique' => 'Ce nom d\'entreprise est déjà utilisé.',
    
            'neq.required_without' => 'Le champ NEQ est obligatoire si le champ courriel n\'est pas renseigné.',
            'neq.unique' => 'Ce code NEQ est déjà utilisé.',
            'neq.regex' => 'Le code NEQ doit être composé de 10 caractères numériques et commencer par 11, 22, 33 ou 88.',
            'neq.numeric' => 'Le code NEQ ne doit contenir que des chiffres.',
            'neq.invalid_format' => 'Le code NEQ n’est pas valide. Assurez-vous qu’il est au bon format et sans caractères spéciaux.',
            'neq.no_spaces' => 'Le code NEQ ne doit pas contenir d’espaces inutiles.',
            'neq.invalid_prefix' => 'Le code NEQ doit commencer par 11, 22, 33 ou 88.',
            'neq.length' => 'Le code NEQ doit être exactement composé de 10 caractères.',
    
            'courrielConnexion.required_without' => 'L’adresse courriel est obligatoire si le champ NEQ n\'est pas renseigné.',
            'courrielConnexion.email' => 'L’adresse courriel est invalide. Assurez-vous qu’elle respecte les règles.',
            'courrielConnexion.max' => 'L’adresse courriel ne peut pas dépasser :max caractères.',
            'courrielConnexion.regex' => 'L’adresse courriel est invalide. Assurez-vous qu’elle respecte les règles.',
            'courrielConnexion.unique' => 'L’adresse courriel est déjà utilisé.',
    
            'password.required' => 'Ce champ est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.max' => 'Le mot de passe ne peut pas dépasser :max caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.regex' => 'Le mot de passe n’est pas valide.',
        ];
    }

    protected function messagesValidationProduits()
    {
        //return [
            //'unspsc_codes.required' => 'Vous devez fournir au moins 1 code UNSPSC.'
        //];

        return [
            'selected_codes.required' => 'Vous devez sélectionner au moins un code.',
            'selected_codes.json' => 'Le format des codes sélectionnés est invalide.',
        ];
    }

    protected function messagesValidationCoordonnees()
    {
        return [
            'rue.required' => 'Ce champ est obligatoire.',
            'rue.max' => 'Le nom de la rue ne peut pas dépasser 64 caractères.',
            'rue.regex' => 'Le nom de la rue peut contenir uniquement des lettres, des chiffres, des espaces et certains caractères spéciaux (comme - . , ; : ! () &).',

            'Ncivique.required' => 'Ce champ est obligatoire.',
            'Ncivique.max' => 'Le numéro civique ne peut pas dépasser 8 caractères.',
            'Ncivique.alpha_num' => 'Le numéro civique doit contenir uniquement des lettres et des chiffres.',
    
            'bureau.regex' => 'Le format du bureau est invalide.',
            'bureau.max' => 'Le bureau ne peut pas dépasser :max caractères.',
    
            'ville.required_without' => 'Ce champ est obligatoire.',
            'ville.regex' => 'Le format de la ville est invalide.',
            'ville.min' => 'La ville doit contenir au moins :min caractères.',
            'ville.max' => 'La ville ne peut pas dépasser :max caractères.',

            'ville-autre.required_without' => 'Ce champ est obligatoire.',
            'ville-autre.regex' => 'Le format de la ville est invalide.',
            'ville-autre.min' => 'La ville doit contenir au moins :min caractères.',
            'ville-autre.max' => 'La ville ne peut pas dépasser :max caractères.',
    
            'province.required' => 'Ce champ est obligatoire.',
            'province.min' => 'La province doit contenir au moins :min caractères.',
            'province.max' => 'La province ne peut pas dépasser :max caractères.',
            'province.regex' => 'Le format de la province est invalide.',
    
            'codePostal.required' => 'Ce champ est obligatoire.',
            'codePostal.regex' => 'Le format du code postal est invalide.',
    
            'site.url' => 'Le champ site doit être une URL valide.',
    
            'numTel.required' => 'Ce champ est obligatoire.',
            'numTel.digits' => 'Le numéro de téléphone doit contenir exactement :digits chiffres.',
            'numTel.integer' => 'Le numéro de téléphone doit être un entier.',

            'posteTel.digits_between' => 'Le numéro de poste doit contenir uniquement des chiffres (entre 1 et 6 chiffres).',
            //'posteTel.max' => 'Le poste ne peut pas dépasser :max caractères.',

            'typeContact.required' => 'Ce champ est obligatoire.',
        ];
    }

    protected function messagesValidationContacts()
    {
        return [
            'prenom.required' => 'Ce champ est obligatoire.',
            'prenom.regex' => 'Le prénom ne doit pas contenir d\'espaces.',
            'prenom.min' => 'Le prénom doit contenir au moins :min caractères.',
            'prenom.max' => 'Le prénom ne peut pas dépasser :max caractères.',
    
            'nom.required' => 'Ce champ est obligatoire.',
            'nom.regex' => 'Le nom ne doit pas contenir d\'espaces.',
            'nom.min' => 'Le nom doit contenir au moins :min caractères.',
            'nom.max' => 'Le nom ne peut pas dépasser :max caractères.',
    
            'fonction.required' => 'Ce champ est obligatoire.',
            'fonction.regex' => 'Le format du poste est invalide.',
            'fonction.min' => 'Le poste doit contenir au moins :min caractères.',
            'fonction.max' => 'Le poste ne peut pas dépasser :max caractères.',
    
            'courrielContact.required' => 'Ce champ est obligatoire.',
            'courrielContact.min' => 'Le courriel doit contenir au moins :min caractères.',
            'courrielContact.max' => 'Le courriel ne peut pas dépasser :max caractères.',
            'courrielContact.regex' => 'Le courriel ne doit pas contenir d\'espaces.',
            'courrielContact.unique' => 'Ce courriel est déjà utilisé',
    
            'numContact.required' => 'Ce champ est obligatoire.',
            'numContact.digits' => 'Le numéro de contact doit contenir exactement :digits chiffres.',
            'numContact.integer' => 'Le numéro de contact doit être un entier.',

            'typeTelContact.required' => 'Ce champ est obligatoire.',

            'posteTelContact.digits_between' => 'Le numéro de poste doit contenir uniquement des chiffres (entre 1 et 6 chiffres).',
            //'posteTelContact.digits_between' => 'Le poste ne peut pas dépasser :max caractères.',
        ];
    }

    protected function messagesValidationRBQ()
    {
        return [
            'rbq.digits' => 'La licence RBQ doit contenir exactement 10 chiffres.',
            
            'documents.required' => 'Veuillez fournir au moins 1 document pour prouver l\'existence de votre entreprise.',
            'documents.array' => 'Les documents doivent être un tableau.',
    
            'documents.*.file' => 'Chaque document doit être un fichier valide.',
            'documents.*.mimes' => 'Chaque document doit être de type :values.',
            'documents.*.max' => 'Chaque document ne peut pas dépasser :max Ko.',
        ];
    }

}