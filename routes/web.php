<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
=======
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\FournisseursController;
>>>>>>> ff240fb663915634d6d59e24b3c887c5c5204a42

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

<<<<<<< HEAD
require __DIR__.'/auth.php';
=======

Route::POST('/',
[UtilisateursController::class,'login'])->name('Connexion.connexion');
>>>>>>> ff240fb663915634d6d59e24b3c887c5c5204a42

Auth::routes();

<<<<<<< HEAD
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
=======
//Route::POST('/',
//[UtilisateursController::class,'indexMotPasseOublie'])->name('Connexion.MotPasseoublie');


##################################################################################


#################################Déconnexion#########################################
Route::POST('/logout',
[UtilisateursController::class,'logout'])->name('Connexion.logout');
##################################################################################


#################################Inscription#########################################
Route::GET('/formulaire/inscription',
[InscriptionController::class,'identification'])->name('Inscription.Identification'); //Partie 1 inscription

Route::GET('/formulaire/inscription/produis',
[InscriptionController::class,'produits'])->name('Inscription.Produits'); //Partie 2 inscription

Route::GET('/formulaireInscription/inscription/produis/coordonnees',
[InscriptionController::class,'coordonnees'])->name('Inscription.Coordonnees'); //Partie 3 inscription

Route::GET('/formulaireInscription/inscription/produis/coordonnees/contact',
[InscriptionController::class,'contact'])->name('Inscription.Contact'); //Partie 4 inscription

Route::GET('/formulaireInscription/inscription/produis/coordonnees/contact/rbq',
[InscriptionController::class,'rbq'])->name('Inscription.RBQ'); //Partie 5 inscription

Route::GET('/formulaireInscription/inscription/produis/coordonnees/contact/rbq/envoyer',
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


#################################Utilisation fournisseur#########################################
Route::GET('/index',
[FournisseursController::class,'index'])->name('Fournisseur.index');

Route::GET('/ficheUtilisateur/{utilisateur}/',
[FournisseursController::class,'show'])->name('Fournisseur.fiche');

Route::GET('/modificationFicheUtilisateur/{utilisateur}/',
[FournisseursController::class,'edit'])->name('Fournisseur.modification');

Route::PATCH('/modificationFicheUtilisateur/{utilisateur}/',
[FournisseursController::class,'update'])->name('Fournisseur.modification');

Route::GET('/inactif/{utilisateur}/',
[FournisseursController::class,'inactif'])->name('Fournisseur.inactif');

##################################################################################
>>>>>>> ff240fb663915634d6d59e24b3c887c5c5204a42

Route::GET('/reponsableIndex',
[ResponsablesController::class,'index'])->name('Responsable.index');