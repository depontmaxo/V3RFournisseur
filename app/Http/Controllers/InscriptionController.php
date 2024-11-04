<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Utilisateur;
use App\Models\Document;
use App\Models\Coordonnees;
use App\Models\Contacts;
use Illuminate\Support\Facades\Hash;

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
            'entreprise' => [
                'required', 
            'min:5', 
            'max:75', 
            'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/' //Vérifie qu'il n'y a plusieurs espaces un après l'autre
            ],

            'neq' => ['required', 'digits:10', 'integer'],
            'courrielConnexion' => ['required', 'min:5', 'max:75', 'regex:/^[^\s]*$/'],
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
        ]);

        /*Pour hasher/encrypter le mdp*/
        $hashedPassword = Hash::make($request->password);

        $this->storeInSession($request, $request->only('entreprise', 'neq', 'courrielConnexion') + ['password' => $hashedPassword]);

        return redirect()->route('Inscription.Produits');
    }


    public function verificationProduits(Request $request)
    {
        $request->validate([
            'services' => ['required', 'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/'],
        ]);

        $this->storeInSession($request, $request->only('services'));
        return redirect()->route('Inscription.Coordonnees');
    }

    public function verificationCoordonnees(Request $request)
    {
        $request->validate([
            'adresse' => ['required', 'regex:/^\d+\s+[a-zA-Z]+/', 'min:5', 'max:50'], // Vérifier le format avec chiffres et lettres
            'bureau' => ['required', 'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/', 'max:15'],
            'ville' => ['required', 'regex:/^[A-Za-z0-9]+(?:[- ][A-Za-z0-9]+)*$/', 'min:3', 'max:30'],
            'province' => ['required', 'min:3', 'max:25', 'regex:/^[^\s]*$/'],
            'codePostal' => [
                'required', 
                'regex:/^[A-Za-z]\d[A-Za-z]\s?\d[A-Za-z]\d$/'], 
            'pays' => ['required', 'regex:/^[^\s]*$/', 'min:3', 'max:35'],
            'site' => ['required', 'regex:/^[^\s]*$/'],
            'numTel' => ['required', 'digits:10', 'integer'],
        ]);

        $this->storeInSession($request, $request->only('adresse', 'bureau', 'ville', 'province', 'codePostal', 'pays', 'site', 'numTel'));
        return redirect()->route('Inscription.Contact');
    }

    public function verificationContact(Request $request)
    {
        $request->validate([
            'prenom' => ['required', 'regex:/^[^\s]*$/', 'min:3', 'max:20'],
            'nom' => ['required', 'regex:/^[^\s]*$/', 'min:3', 'max:50'],
            'poste' => ['required', 'regex:/^(?! )[A-Za-z0-9]+( [A-Za-z0-9]+)*(?<! )$/', 'min:3', 'max:30'],
            'courrielContact' => ['required', 'min:5', 'max:75', 'regex:/^[^\s]*$/'],
            'numContact' => ['required', 'digits:10', 'integer'],
        ]);
    
        // Récupérer les contacts
        /*$contacts = [];
        foreach ($request->only('prenom') as $index => $prenom) {
            $contacts[] = [
                'prenom' => $request->prenom[$index],
                'nom' => $request->nom[$index],
                'poste' => $request->poste[$index],
                'courrielContact' => $request->courrielContact[$index],
                'numContact' => $request->numContact[$index],
            ];
        }*/
    
        
        // Stocker les contacts dans la session
        //$this->storeInSession($request, ['contacts' => $contacts]);
        $this->storeInSession($request, $request->only('prenom', 'nom', 'poste', 'courrielContact', 'numContact'));
    
        return redirect()->route('Inscription.RBQ');
    }


    public function verificationRBQ(Request $request)
    {
        //Si vous avez l'erreur "Content Too Large" de Laravel, il faut aller dans le fichier php.ini dans le composer et changer les valeurs des lignes :
        //post_max_size (mettre 75M)
        //upload_max_filesize (mettre environ 40M) - Ensuite il faut redémarrer VSCode et le site

        // Validation des fichiers et de rbq
        $request->validate([
            'rbq' => ['required'],
            'documents' => ['required', 'array'],
            'documents.*' => ['file', 'mimes:docx,doc,pdf,jpg,jpeg,xls,xlsx', 'max:75000'],
        ]);
    
        // Récupérer les fichiers validés
        $uploadedFiles = [];
        foreach ($request->file('documents') as $file) {
            $uploadedFiles[] = [
                'name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'type' => $file->getClientMimeType(),
                'stream' => fopen($file->getRealPath(), 'rb'), // Ouvrir le fichier en tant que flux
            ];
        }


        // Stocker les données dans la session
        $this->storeInSession($request, $request->only('rbq') + ['documents' => $uploadedFiles]);
        /*$stepData = $request->only('rbq'); // Inclure seulement rbq
        $stepData['documents'] = $uploadedFiles; // Ajouter les fichiers au tableau de données
        $this->storeInSession($request, $stepData);*/
    
        // Redirection vers la page de confirmation
        return redirect()->route('Inscription.Complet'); // Remplacez par votre route de confirmation
    }

    //VA CHERCHER INFO ET CRÉE CANDIDAT
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

        // Redirection après l'envoi
        return redirect()->route('Connexion.pageConnexion')->with('success', 'Inscription réussie !');
    }

    //Fonctions pour storer les données
    protected function storeInSession(Request $request, $stepData)
    {
        $data = session('user_data', []);
        $data = array_merge($data, $stepData);
        session(['user_data' => $data]);
    }
}