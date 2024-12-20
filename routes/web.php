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
use App\Http\Controllers\SettingController;


require __DIR__.'/auth.php';


Route::GET('/accueil',
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

/* Quel est l'utilite de ceci??? -Max*/
/*Route::POST('/login', [UtilisateursController::class,'login'])->name('Connexion.connexion');*/

Route::GET('/',
[UtilisateursController::class,'pageConnexion'])->name('Connexion.pageConnexion')->middleware(ClearSessionMiddleware::class);


Route::GET('/motPasseOublie',
[UtilisateursController::class,'ShowMotPasseOublieForm'])->name('ShowMotPasseOublie');

//Route::POST('/',
//[UtilisateursController::class,'indexMotPasseOublie'])->name('Connexion.MotPasseoublie');


##########################################Connexion Employé##########################
Route::get('/connexionEmploye', [LoginController::class, 'index'])->name('connexionUser.index'); ##LoginPage pour employé
Route::post('/employeConnecte', [LoginController::class, 'loginEmploye'])->name('employeConnecte'); ##Methode Post du log employe


#################################Déconnexion#########################################
Route::POST('/logout', [UtilisateursController::class, 'logout'])->name('logout');
Route::GET('/logout', [UtilisateursController::class, 'logout'])->name('logout.link');
##################################################################################


#################################Inscription#########################################
Route::GET('/formulaire/inscription',
[InscriptionController::class,'identification'])->name('Inscription.Identification'); //Partie 1 inscription

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
[FournisseursController::class,'index'])->name('Fournisseur.index');

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

//Code UNSPSC
Route::GET('/ficheUtilisateur/{utilisateur}/UNSPSC',
[FournisseursController::class,'editUNSPSC'])->name('Fournisseur.UNSPSC');

Route::POST('/ficheUtilisateur/{utilisateur}/UNSPSC',
[FournisseursController::class,'updateUNSPSC'])->name('Fournisseur.appliqueUNSPSC');
//


Route::GET('/ficheUtilisateur/document/{id}/download',
[DocumentController::class,'telechargerDocument'])->name('Document.download');

Route::GET('/ficheUtilisateur/{utilisateur}/statut',
[FournisseursController::class,'afficherStatut'])->name('Fournisseur.statut');

/*
Route::GET('/unspsc/recherche',
[FournisseursController::class,'recherche'])->name('Fournisseurs.recherche');
*/

Route::GET('/unspsc/choisit',
[FournisseursController::class,'choisit'])->name('Fournisseurs.choisit');

Route::DELETE('/unspsc/supprimerUNSPSC',
[FournisseursController::class, 'supprimerCodeUnspsc'])->name('Fournisseurs.supprimerUNSPSC');

Route::DELETE('/unspsc/supprimerContact',
[FournisseursController::class, 'supprimerContact'])->name('Fournisseurs.supprimerContacts');

Route::GET('/ficheUtilisateur/{utilisateur}/nouveau_contact',
[FournisseursController::class,'nouveauContact'])->name('Fournisseur.nouveauContact');

Route::POST('/ficheUtilisateur/{utilisateur}/nouveau_contact/save', 
[FournisseursController::class, 'nouveauContactUpdate'])->name('Fournisseur.nouveauContact.update');


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
[ResponsablesController::class,'rechercheFournisseur'])->name('Responsable.rechercheFournisseur');

Route::GET('/responsable/rechercheCandidat',
[ResponsablesController::class,'rechercheCandidat'])->name('Responsable.rechercheCandidat')->middleware(CheckRole::class.':responsable');
#################################Responsable#########################################
Route::GET('/reponsableIndex',
[ResponsablesController::class,'index'])->name('Responsable.index');

Route::GET('/responsable/recherche',
[ResponsablesController::class,'recherche'])->name('Responsable.recherche');


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
use App\Http\Controllers\EmailTemplateController;

Route::get('/admin', [UserController::class, 'index'])->name('admin.index');

Route::get('/adminGestionCourriel', [UserController::class, 'GestionCourriel'])->name('GestionCourriel');

Route::get('/gestion-users', [UserController::class, 'gestionUser'])->name('gestion.userAdmin');

Route::post('/users', [UserController::class, 'store'])->name('users.store');

//Supprimer un utilisateur
Route::delete('/users/{id}', [UserController::class, 'destroy']);

//Modifier le role d'un utilisateur
//Route::post('/users/update-roles', [UserController::class, 'updateRoles']); 

Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');


//Connexion de l'admin
//Route pour afficher la page de connexion
#Route::get('/loginAdmin', [AuthController::class, 'showAdminLoginForm'])->name('loginAdmin');

// Route pour traiter la connexion
#Route::post('/loginAdmin', [AuthController::class, 'adminLogin'])->name('adminLogin');

######################REFUS ACCESS##########################################################

// Route pour traiter la connexion
Route::get('/RefusAccess', [UtilisateursController::class, 'RefusAccess'])->name('RefusAccess');

//Parametre gestion de courriel admin
Route::get('/admin/email-templates', [EmailTemplateController::class, 'index'])->name('email.templates.index');
Route::post('/email-templates', [EmailTemplateController::class, 'store'])->name('email.templates.store'); // Ajouter un modèle
Route::delete('/email-templates/{id}', [EmailTemplateController::class, 'destroy'])->name('email.templates.destroy'); // Supprimer un modèle
Route::put('/email/templates/{id}/update', [EmailTemplateController::class, 'update'])->name('email.templates.update');



Route::post('/users', [UserController::class, 'store']);

//Settings admin
Route::get('/ParametreAdmin', [SettingController::class, 'index'])->name('settings.index');
Route::post('/update', [SettingController::class, 'updateSettings'])->name('settings.update');



#######################EMAIL#################################################################################

// Route pour afficher le formulaire de récupération de mot de passe (GET)
Route::get('/forgot_password', [LoginController::class, 'forgotPassword'])->name('app_forgotpassword');

// Route pour traiter la soumission du formulaire de récupération de mot de passe (POST)
Route::post('/forgot_password', [LoginController::class, 'forgotPassword'])->name('app_forgotpassword1');

// Route pour afficher le formulaire (GET)
Route::get('/changePassword/{token}', [LoginController::class, 'changePassword'])->name('app_changepassword');

// Route pour soumettre le formulaire (POST)
Route::post('/changePassword/{token}', [LoginController::class, 'changePassword'])->name('app_changepassword.submit');


#######################Support#################################################################################
// Route pour traiter la soumission du formulaire de récupération de mot de passe (POST)
Route::get('/support', [FournisseursController::class, 'support'])->name('support');

