<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateursController;

/*Route::get('/', function () {
    return view('welcome');
});*/

/*
Route::get('/', function () {
    return view('connexion');
});
*/

#################################Connexion#########################################
Route::GET('/connexionEmail',
[UtilisateursController::class,'index'])->name('Connexion.connexionEmail');

Route::GET('/',
[UtilisateursController::class,'indexNEQ'])->name('Connexion.connexionNEQ');

Route::POST('/',
[UtilisateursController::class,'login'])->name('Connexion.connexion');

Route::GET('/loggedin',
[UtilisateursController::class,'indextemp'])->name('Connexion.temp');
##################################################################################
