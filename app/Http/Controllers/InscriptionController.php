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
    }

    //Validation des **COORDONNÉES**
    public function verificationCoordonnees(InformationCoordonneeRequest $request)
    {
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

        //dd($validatedData);

        $this->storeInSession($request, $validatedData + ['region' => $regionNom] + ['code' => $regionCode]);
        return redirect()->route('Inscription.Contact');
    }

    //Validation des **CONTACTS**
    public function verificationContact(InformationContactsRequest $request)
    {
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
                        'stream' => $fileStream,
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
}