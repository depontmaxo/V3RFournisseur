<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\ResponsablesController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\ClearSessionMiddleware;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DocumentController;


require __DIR__.'/auth.php';


Route::GET('/',
[UtilisateursController::class,'index'])->name('page.Accueil')/*->middleware('role:admin,commis,responsable');*/;
Route::POST('/', [UtilisateursController::class,'login'])->name('Connexion.connexion');


#################################Connexion#########################################
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::GET('/connexionEmail',
[UtilisateursController::class,'pageConnexion'])->name('Connexion.pageConnexion')->middleware(ClearSessionMiddleware::class);


Route::GET('/motPasseOublie',
[UtilisateursController::class,'ShowMotPasseOublieForm'])->name('ShowMotPasseOublie');

//Route::POST('/',
//[UtilisateursController::class,'indexMotPasseOublie'])->name('Connexion.MotPasseoublie');


##########################################Connexion Employé##########################
Route::get('/connexionEmploye', [LoginController::class, 'index'])->name('connexionUser.index'); ##LoginPage pour employé
Route::post('/employeConnecte', [LoginController::class, 'loginEmploye'])->name('employeConnecte'); ##Methode Post du log employe


#################################Déconnexion#########################################
Route::POST('/logout', [UtilisateursController::class, 'logout'])->middleware('auth')->name('logout');
Route::GET('/logout', [UtilisateursController::class, 'logout'])->middleware('auth')->name('logout.link');
##################################################################################


#################################Inscription#########################################
Route::GET('/formulaire/inscription',
[InscriptionController::class,'identification'])->name('Inscription.Identification')->middleware(ClearSessionMiddleware::class); //Partie 1 inscription

Route::GET('/formulaire/inscription/produits',
[InscriptionController::class,'produits'])->name('Inscription.Produits'); //Partie 2 inscription

Route::GET('/formulaireInscription/inscription/produits/coordonnees',
[InscriptionController::class,'coordonnees'])->name('Inscription.Coordonnees'); //Partie 3 inscription

Route::GET('/formulaireInscription/inscription/produits/coordonnees/contact',
[InscriptionController::class,'contact'])->name('Inscription.Contact'); //Partie 4 inscription

Route::GET('/formulaireInscription/inscription/produits/coordonnees/contact/rbq',
[InscriptionController::class,'rbq'])->name('Inscription.RBQ'); //Partie 5 inscription

Route::GET('/formulaireInscription/inscription/produits/coordonnees/contact/rbq/envoyer',
[InscriptionController::class,'formComplet'])->name('Inscription.Complet'); //Partie 6 inscription (page envoie)


Route::POST('/validation/identification',
[InscriptionController::class,'verificationIdentification'])->name('Inscription.verificationIdentification');

Route::POST('/validation/produits',
[InscriptionController::class,'verificationProduits'])->name('Inscription.verificationProduits');

Route::POST('/validation/coordonnees',
[InscriptionController::class,'verificationCoordonnees'])->name('Inscription.verificationCoordonnees');

Route::POST('/validation/contact',
[InscriptionController::class,'verificationContact'])->name('Inscription.verificationContact');

Route::POST('/validation/rbq',
[InscriptionController::class,'verificationRBQ'])->name('Inscription.verificationRBQ');

Route::POST('/envoyer',
[InscriptionController::class,'envoyerFormulaire'])->name('Inscription.verificationComplet');
##################################################################################


#################################Fournisseur#########################################
Route::GET('/index',
[FournisseursController::class,'index'])->name('Fournisseur.index')->middleware(CheckRole::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::GET('/ficheUtilisateur/{utilisateur}',
[FournisseursController::class,'show'])->name('Fournisseur.fiche');

Route::GET('/ficheUtilisateur/{utilisateur}/modifier',
[FournisseursController::class,'edit'])->name('Fournisseur.modification');

Route::PATCH('/ficheUtilisateur/{utilisateur}/modifier',
[FournisseursController::class,'update'])->name('Fournisseur.appliqueModification');

Route::GET('/ficheUtilisateur/document/{id}/download',
[DocumentController::class,'telechargerDocument'])->name('Document.download');

Route::GET('/ficheUtilisateur/{utilisateur}/statut',
[FournisseursController::class,'afficherStatut'])->name('Fournisseur.statut');

##################################################################################




#################################Responsable#########################################
//Rendre compte actif/inactif
Route::GET('/inactif/{utilisateur}/',
[FournisseursController::class,'inactif'])->name('Fournisseur.inactif');

Route::GET('/actif/{utilisateur}/',
[FournisseursController::class,'actif'])->name('Fournisseur.actif');

//Accepté ou refusé candidat
Route::GET('/accepte/{candidat}/',
[ResponsablesController::class,'candidatAccepte'])->name('Candidat.Accepte');

Route::GET('/refuser/{candidat}/',
[ResponsablesController::class,'candidatRefuse'])->name('Candidat.Refuse');


//Faire la recherche de fournisseur et candidat
Route::GET('/responsable/rechercheFournisseur',
[ResponsablesController::class,'rechercheFournisseur'])->name('Responsable.rechercheFournisseur')->middleware(CheckRole::class.':responsable');

Route::GET('/responsable/rechercheCandidat',
[ResponsablesController::class,'rechercheCandidat'])->name('Responsable.rechercheCandidat')->middleware(CheckRole::class.':responsable');
#################################Responsable#########################################
Route::GET('/reponsableIndex',
[ResponsablesController::class,'index'])->name('Responsable.index');

Route::GET('/responsable/recherche',
[ResponsablesController::class,'recherche'])->name('Responsable.recherche');

Route::GET('/index/unspsc/recherche',
[FournisseursController::class,'recherche'])->name('Fournisseurs.recherche')->middleware(CheckRole::class.':responsable');

Route::GET('/index/unspsc/choisit',
[FournisseursController::class,'choisit'])->name('Fournisseurs.choisit')->middleware(CheckRole::class.':responsable');

//Liste fournisseur et inscription
Route::GET('/responsable/listeInscription',
[ResponsablesController::class,'voirListeInscription'])->name('Responsable.listeInscripton');

Route::GET('/responsable/listeFournisseur',
[ResponsablesController::class,'listeFournisseur'])->name('Responsable.listeFournisseur')->middleware(CheckRole::class.':responsable');

/*Route::GET('/reponsableIndex',
[ResponsablesController::class,'index'])->name('Responsable.index');*/

Route::GET('/responsableIndex/listeInscription/{candidat}',
[ResponsablesController::class,'evaluerCandidat'])->name('Responsable.visualiserCandidat');



#################################Admin#########################################
use App\Http\Controllers\UserController;

Route::get('/admin', [UserController::class, 'index'])->name('admin.index');


Route::get('/gestion-users', [UserController::class, 'gestionUser'])->name('gestion.userAdmin');

//Supprimer un utilisateur
Route::delete('/users/{id}', [UserController::class, 'deleteUser']);

//Modifier le role d'un utilisateur
Route::post('/users/update-roles', [UserController::class, 'updateRoles']); 

//Connexion de l'admin
//Route pour afficher la page de connexion
Route::get('/loginAdmin', [AuthController::class, 'showAdminLoginForm'])->name('loginAdmin');

// Route pour traiter la connexion
Route::post('/loginAdmin', [AuthController::class, 'adminLogin'])->name('adminLogin');

######################REFUS ACCESS##########################################################

// Route pour traiter la connexion
Route::get('/RefusAccess', [UtilisateursController::class, 'RefusAccess'])->name('RefusAccess');

#######################EMAIL#################################################################################

// Route pour afficher le formulaire de récupération de mot de passe (GET)
Route::get('/forgot_password', [LoginController::class, 'forgotPassword'])->name('app_forgotpassword');

// Route pour traiter la soumission du formulaire de récupération de mot de passe (POST)
Route::post('/forgot_password', [LoginController::class, 'forgotPassword'])->name('app_forgotpassword1');

#######################Support#################################################################################
// Route pour traiter la soumission du formulaire de récupération de mot de passe (POST)
Route::get('/support', [FournisseursController::class, 'support'])->name('support');

