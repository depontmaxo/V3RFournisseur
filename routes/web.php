<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\FournisseursController;

/*Route::get('/', function () {
    return view('welcome');
});*/

/*
Route::get('/', function () {
    return view('connexion');
});*/

Route::get('/', function () {
    return view('inscription');
});

#################################Connexion#########################################
Route::GET('/connexionEmail',
[UtilisateursController::class,'index'])->name('Connexion.connexionEmail');

Route::GET('/',
[UtilisateursController::class,'indexNEQ'])->name('Connexion.connexionNEQ');


Route::POST('/',
[UtilisateursController::class,'login'])->name('Connexion.connexion');

Route::GET('/motPasseOublie',
[UtilisateursController::class,'ShowMotPasseOublieForm'])->name('ShowMotPasseOublie');

//Route::POST('/',
//[UtilisateursController::class,'indexMotPasseOublie'])->name('Connexion.MotPasseoublie');


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

Route::GET('/modificationFicheUtilisateur/{utilisateur}/',
[FournisseursController::class,'inactif'])->name('Fournisseur.inactif');

##################################################################################
