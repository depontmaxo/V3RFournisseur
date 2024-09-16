<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;
use App\Http\Requests\ConnexionRequest;

class UtilisateursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('connexion');
    }

    /**
    * Display a listing of the resource.
    */
    public function indexNEQ()
    {
        return View('connexionNEQ');
    }

    
    public function pageInscription()
    {
        return View('inscription');
    }

    /**
     * Display a listing of the resource.
    */
    public function indextemp()
    {
        return View('welcome');
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
                $usager = Utilisateur::where('email', $request->email)->firstOrFail();
                return redirect()->route('Connexion.temp');
    
            }
            else{
                return redirect()->route('Connexion.connexionEmail')->withErrors(['Informations invalides']); 
            }
        }
        if($request->email == null){
            $reussi = Auth::attempt(['neq' => $request->neq, 'password' => $request->password]);
            if($reussi){
                $usager = Utilisateur::where('neq', $request->neq)->firstOrFail();
                return redirect()->route('Connexion.temp');
            }
            else{
                return redirect()->route('Connexion.connexionNEQ')->withErrors(['Informations invalides']); 
            }
        }
        else{
            return redirect()->route('Connexion.connexionNEQ')->withErrors(['Informations invalides']); 
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('Tutorat.index_login');
    }


    public function ShowMotPasseOublieForm(){
        return view('MotPasseOublie');
    }
}
