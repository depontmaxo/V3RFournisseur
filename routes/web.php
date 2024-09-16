<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateursController;
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
Route::GET('/formulaireInscription',
[UtilisateursController::class,'pageInscription'])->name('Inscription.formulaireInscription');
##################################################################################


#################################Utilisation fournisseur#########################################
Route::GET('/index',
[FournisseursController::class,'index'])->name('Fournisseur.index');

Route::GET('/modificationFiche/{id}/',
[FournisseursController::class,'show'])->name('Fournisseur.modification');


##################################################################################
