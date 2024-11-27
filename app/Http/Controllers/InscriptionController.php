<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Utilisateur;
use App\Models\Document;
use App\Models\Coordonnees;
use App\Models\Contacts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\welcomeUserMail;


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




    
    //==============Section qui s'occupe d'exécuter la validation et redirect vers la page suivante==============
    public function verificationIdentification(Request $request)
    {
        $validatedData = $request->validate(
            $this->reglesValidationsIdentification(),
            $this->messagesValidationIdentification()
        );

        /*Hashage mdp*/
        $hashedPassword = Hash::make($request->password);

        $this->storeInSession($request, $validatedData + ['password' => $hashedPassword]);

        return redirect()->route('Inscription.Produits');
    }


    //Validation des **UNSPS**
    public function verificationProduits(Request $request)
    {
        $validatedData = $request->validate(
            $this->reglesValidationsProduits(),
            $this->messagesValidationProduits()
        );


        $this->storeInSession($request, $validatedData);
        return redirect()->route('Inscription.Coordonnees');
    }

    //Validation des **COORDONNÉES**
    public function verificationCoordonnees(Request $request)
    {
        $validatedData = $request->validate(
            $this->reglesValidationsCoordonnees(),
            $this->messagesValidationCoordonnees()
        );

        $this->storeInSession($request, $validatedData);
        return redirect()->route('Inscription.Contact');
    }

    //Validation des **CONTACTS**
    public function verificationContact(Request $request)
    {
        $validatedData = $request->validate(
            $this->reglesValidationsContacts(),
            $this->messagesValidationContacts()
        );

        $this->storeInSession($request, $validatedData);
    
        return redirect()->route('Inscription.RBQ');
    }

    //Validation des **DOCUMENTS**
    public function verificationRBQ(Request $request)
    {
        //Si vous avez l'erreur "Content Too Large" de Laravel, il faut aller dans le fichier php.ini dans le composer et changer les valeurs des lignes :
        //post_max_size (mettre environ 250M) comme ca on évite l'erreur de Laravel
        //upload_max_filesize (mettre environ 250M) - Ensuite il faut redémarrer VSCode et le site

        $request->validate(
            $this->reglesValidationsRBQ(),
            $this->messagesValidationRBQ()
        );
        $rbq = $request->only('rbq');

        // Récupérer les fichiers validés
        $uploadedFiles = [];
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


        // Stocker les données dans la session
        $this->storeInSession($request, $rbq + ['documents' => $uploadedFiles]);

        return redirect()->route('Inscription.Complet');
    }


    //==============Gestion envoie de formulaire==============
    public function envoyerFormulaire(Request $request)
    {
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
            'role' => 'fournisseur',
            'statut' => 'En attente',
            'rbq' => $data['rbq']
        ]);

        // Récupérer les fichiers de la session
        $documents = $data['documents'] ?? [];
        
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

        $utilisateur->coordonnees()->create([
            'adresse' => $data['adresse'],
            'bureau' => $data['bureau'],
            'ville' => $data['ville'],
            'province' => $data['province'],
            'code_postal' => $data['codePostal'],
            'pays' => $data['pays'],
            'siteweb' => $data['site'],
            'num_telephone' => $data['numTel'],
        ]);


        $utilisateur->contacts()->create([
            /*'utilisateur_id' => $uuid,*/
            'prenom' => $data['prenom'],
            'nom' => $data['nom'],
            'poste' => $data['poste'],
            'email_contact' => $data['courrielContact'],
            'num_contact' => $data['numContact'],
        ]);


        // Effacer les données de la session
        session()->forget('user_data');


        Mail::to($utilisateur->email)->send(new welcomeUserMail());
 

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
                'required', 
                'digits:10', 
                'integer', 
                'unique:utilisateur,neq'
            ],

            'courrielConnexion' => [
                'required', 
                'min:5', 
                'max:75', 
                'regex:/^[^\s]*$/', 
                'unique:utilisateur,email'
            ],

            'password' => [
                'required', 
                'min:3', 
                'max:15', 
                'confirmed',
                'regex:/^[^\s]*$/' //Vérifie qu'il ne contient aucun espace dans le string
                ]
            /*'password' => [
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

    protected function reglesValidationsProduits()
    {
        return [
            'services' => [
                'required', 
                'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/'
                ]
        ];
    }

    
    protected function reglesValidationsCoordonnees()
    {
        return [
            'adresse' => [
                'required', 
                'regex:/^\d+\s+[A-Za-zÀ-ÿ0-9\s\-]+/', // Acceptation des lettres accentuées et des espaces
                'min:5', 
                'max:50'
            ], 

            'bureau' => [
                'nullable', 
                'regex:/^(?! )[A-Za-z0-9\s\-]+( [A-Za-z0-9\s\-]+)*(?<! )$/', // Acceptation des espaces et tirets
                'max:15'
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

            'codePostal' => [
                'required', 
                'regex:/^[A-Za-z]\d[A-Za-z]\s?\d[A-Za-z]\d$/'
            ],

            'pays' => [
                'required', 
                'regex:/^[A-Za-zÀ-ÿ0-9\s\-]*$/', // Acceptation des lettres accentuées, espaces et tirets
                'min:3', 
                'max:35'
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
        ];
    }

    protected function reglesValidationsContacts()
    {
        return [
            'prenom' => [
                'required', 
                'regex:/^[^\s]*$/', 
                'min:3', 
                'max:20'
            ],

            'nom' => [
                'required', 
                'regex:/^[^\s]*$/', 
                'min:3', 
                'max:50'
            ],

            'poste' => [
                'required', 
                'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/', 
                'min:3', 
                'max:30'
            ],

            'courrielContact' => [
                'required', 
                'min:5', 
                'max:75', 
                'regex:/^[^\s]*$/',
                'unique:contacts,email_contact'
            ],

            'numContact' => [
                'required', 
                'digits:10', 
                'integer'
            ],
        ];
    }

    protected function reglesValidationsRBQ()
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
    }

    //==============Messages personnalisés==============
    protected function messagesValidationIdentification()
    {
        return [
            'entreprise.required' => 'Ce champ est obligatoire',
            'entreprise.min' => 'Le champ entreprise doit contenir au moins :min caractères.',
            'entreprise.max' => 'Le champ entreprise ne peut pas dépasser :max caractères.',
            'entreprise.regex' => 'Le champ entreprise ne doit pas contenir d\'espaces consécutifs.',
            'entreprise.unique' => 'Ce nom d\'entreprise est déjà utilisé',
    
            'neq.required' => 'Ce champ est obligatoire',
            'neq.digits' => 'Le champ neq doit contenir exactement :digits chiffres.',
            'neq.integer' => 'Le champ neq doit contenir uniquement des chiffres entiers.',
            'neq.unique' => 'Ce code NEQ est déjà utilisé',
    
            'courrielConnexion.required' => 'Ce champ est obligatoire',
            'courrielConnexion.min' => 'Le champ courriel doit contenir au moins :min caractères.',
            'courrielConnexion.max' => 'Le champ courriel ne peut pas dépasser :max caractères.',
            'courrielConnexion.regex' => 'Le champ courriel ne doit pas contenir d\'espaces.',
            'courrielConnexion.unique' => 'Ce courriel est déjà utilisé',
    
            'password.required' => 'Ce champ est obligatoire',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.max' => 'Le mot de passe ne peut pas dépasser :max caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.regex' => 'Le mot de passe ne doit pas contenir d\'espaces.',
        ];
    }

    protected function messagesValidationProduits()
    {
        return [
            'services.required' => 'Ce champ est obligatoire.',
            'services.regex' => 'Le champ produits/services ne doit pas contenir d\'espaces consécutifs.'
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
    
            'codePostal.required' => 'Ce champ est obligatoire.',
            'codePostal.regex' => 'Le format du code postal est invalide.',
    
            'pays.required' => 'Ce champ est obligatoire.',
            'pays.regex' => 'Le format du pays est invalide.',
            'pays.min' => 'Le pays doit contenir au moins :min caractères.',
            'pays.max' => 'Le pays ne peut pas dépasser :max caractères.',
    
            'site.url' => 'Le champ site doit être une URL valide.',
    
            'numTel.required' => 'Ce champ est obligatoire.',
            'numTel.digits' => 'Le numéro de téléphone doit contenir exactement :digits chiffres.',
            'numTel.integer' => 'Le numéro de téléphone doit être un entier.',
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
    
            'poste.required' => 'Ce champ est obligatoire.',
            'poste.regex' => 'Le format du poste est invalide.',
            'poste.min' => 'Le poste doit contenir au moins :min caractères.',
            'poste.max' => 'Le poste ne peut pas dépasser :max caractères.',
    
            'courrielContact.required' => 'Ce champ est obligatoire.',
            'courrielContact.min' => 'Le courriel doit contenir au moins :min caractères.',
            'courrielContact.max' => 'Le courriel ne peut pas dépasser :max caractères.',
            'courrielContact.regex' => 'Le courriel ne doit pas contenir d\'espaces.',
            'courrielContact.unique' => 'Ce courriel est déjà utilisé',
    
            'numContact.required' => 'Ce champ est obligatoire.',
            'numContact.digits' => 'Le numéro de contact doit contenir exactement :digits chiffres.',
            'numContact.integer' => 'Le numéro de contact doit être un entier.',
        ];
    }

    protected function messagesValidationRBQ()
    {
        return [
            'rbq.nullable' => 'Le champ RBQ est facultatif.',
            
            'documents.required' => 'Veuillez fournir au moins 1 document pour prouver l\'existence de votre entreprise.',
            'documents.array' => 'Les documents doivent être un tableau.',
    
            'documents.*.file' => 'Chaque document doit être un fichier valide.',
            'documents.*.mimes' => 'Chaque document doit être de type :values.',
            'documents.*.max' => 'Chaque document ne peut pas dépasser :max Ko.',
        ];
    }

}