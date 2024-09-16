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
##################################################################################

#################################Inscription#########################################
Route::GET('/formulaireInscription',
[InscriptionController::class,'index'])->name('Inscription.envoyerFormulaireInscription');

Route::POST('/inscrire',
[InscriptionController::class,'store'])->name('Inscription.store');
##################################################################################


#################################Utilisation fournisseur#########################################
Route::GET('/index',
[FournisseursController::class,'index'])->name('Fournisseur.index');

Route::GET('/modificationFiche/{id}/',
[FournisseursController::class,'show'])->name('Fournisseur.modification');


##################################################################################
