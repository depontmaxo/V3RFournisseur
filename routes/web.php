<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\ResponsablesController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\ClearSessionMiddleware;
use App\Http\Controllers\AuthController;

require __DIR__.'/auth.php';


Route::GET('/',
[UtilisateursController::class,'index'])->middleware(ClearSessionMiddleware::class);

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
[UtilisateursController::class,'pageConnexion'])->name('Connexion.connexionEmail')->middleware(ClearSessionMiddleware::class);


Route::POST('/',
[UtilisateursController::class,'login'])->name('Connexion.connexion');

Route::GET('/motPasseOublie',
[UtilisateursController::class,'ShowMotPasseOublieForm'])->name('ShowMotPasseOublie');

//Route::POST('/',
//[UtilisateursController::class,'indexMotPasseOublie'])->name('Connexion.MotPasseoublie');


##################################################################################


#################################Déconnexion#########################################
Route::POST('/logout', [UtilisateursController::class, 'logout'])->middleware('auth')->name('logout');
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

Route::GET('/ficheUtilisateur/{utilisateur}/',
[FournisseursController::class,'show'])->name('Fournisseur.fiche');

Route::GET('/modificationFicheUtilisateur/{utilisateur}/',
[FournisseursController::class,'edit'])->name('Fournisseur.modification');

Route::PATCH('/modificationFicheUtilisateur/{utilisateur}/',
[FournisseursController::class,'update'])->name('Fournisseur.modification');

##################################################################################

Route::GET('/inactif/{utilisateur}/',
[FournisseursController::class,'inactif'])->name('Fournisseur.inactif');

Route::GET('/actif/{utilisateur}/',
[FournisseursController::class,'actif'])->name('Fournisseur.actif');


#################################Responsable#########################################
Route::GET('/reponsableIndex',
[ResponsablesController::class,'index'])->name('Responsable.index')->middleware(CheckRole::class.':responsable');

Route::GET('/responsableIndex/listeInscription',
[ResponsablesController::class,'voirListeInscription'])->name('Fournisseur.listeInscripton');

Route::GET('/reponsableIndex',
[ResponsablesController::class,'index'])->name('Responsable.index');

Route::GET('/responsableIndex/listeInscription/{candidat}',
[ResponsablesController::class,'evaluerCandidat'])->name('Fournisseur.visualiserCandidat');

#################################Admin#########################################
use App\Http\Controllers\UserController;

Route::get('/admin', [AuthController::class, 'index'])->name('admin.index');


Route::get('/gestion-users', [UserController::class, 'gestionUser'])->name('gestion.userAdmin');

//Page acceuil avec tableau de bord
Route::get('/acceuilAdmin', [UserController::class, 'acceuilAdmin'])->name('acceuilAdmin.index');

//Supprimer un utilisateur
Route::delete('/users/{id}', [UserController::class, 'deleteUser']);

//Modifier le role d'un utilisateur
Route::post('/users/update-roles', [UserController::class, 'updateRoles']); 

//Connexion de l'admin
// Route pour afficher la page de connexion
Route::get('/loginAdmin', [AuthController::class, 'showAdminLoginForm'])->name('loginAdmin');

// Route pour traiter la connexion
Route::post('/loginAdmin', [AuthController::class, 'adminLogin'])->name('adminLogin');



