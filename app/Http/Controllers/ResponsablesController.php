<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;
use App\Models\CandidatInscription;

class ResponsablesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //On va chercher tout les utilisateurs ayant le role fournisseur
        $utilisateurs = Utilisateur::where('role', 'fournisseur')->get();
        return View('responsable.pagePrincipaleResponsable', compact('utilisateurs'));
    }

    public function voirListeInscription()
    {
        $candidats = CandidatInscription::all();
        return view('responsable.listeRequeteInscription', compact('candidats'));
    }

    public function evaluerCandidat(CandidatInscription $candidat)
    {
        return View('responsable.formulaireCandidat', compact('candidat'));
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
}
