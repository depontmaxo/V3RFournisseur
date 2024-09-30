<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;
use App\Http\Requests\ConnexionRequest;

class UtilisateursController extends Controller
{
    /**
     * Index de connection avec un email
     */
    public function index()
    {
        return View('connexion');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
    * Fonction qui login l'utilisateur qui a des information valide
    * Ne pas laisser passer un individu qui a des informations invalides
    */
    public function login(ConnexionRequest $request)
    {
        /*
        Models Utilisateur
        Email et NEQ sont pas required, devrait l'être.
        Remettre après déboguage
        */
        //dd($request);
        

        if($request->neq == null){
            $reussi = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            if($reussi){
                $testNEQ = Utilisateur::where('email', $request->email)->firstOrFail();
                if($testNEQ->neq !== null)
                {
                    return redirect()->route('Connexion.connexion')->withErrors(['Connectez-vous avec votre NEQ']);
                }
                $usager = Utilisateur::where('email', $request->email)->firstOrFail();
                return redirect()->route('Fournisseur.index');
    
            }
            else{
                return redirect()->route('Connexion.connexion')->withErrors(['Informations invalides']); 
            }
        }
        if($request->email == null){
            $reussi = Auth::attempt(['neq' => $request->neq, 'password' => $request->password]);
            if($reussi){
                $usager = Utilisateur::where('neq', $request->neq)->firstOrFail();
                return redirect()->route('Fournisseur.index');
            }
            else{
                return redirect()->route('Connexion.connexion')->withErrors(['Informations invalides']); 
            }
        }
        else{
            return redirect()->route('Connexion.connexion')->withErrors(['Informations invalides']); 
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('Connexion.connexion');
    }


    public function ShowMotPasseOublieForm(){
        return view('MotPasseOublie');
    }
}
