<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first(); // On récupère les paramètres
        return view('admin.ParametreSys', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
       
        // Valider les données
        $request->validate([
            'appro_email' => 'required|email',
            'revision_delai' => 'required|integer',
            'max_file_size' => 'required|integer',
            'email_finance' => 'required|email',
        ]);

        // Récupérer les paramètres existants
        $settings = Setting::first(); // On suppose qu'il y a une seule ligne dans la table

        // Mettre à jour les paramètres avec les nouvelles valeurs
        $settings->appro_email = $request->appro_email;
        $settings->revision_delai = $request->revision_delai;
        $settings->max_file_size = $request->max_file_size;
        $settings->email_finance = $request->email_finance;

        // Sauvegarder les modifications
        $settings->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Les paramètres ont été mis à jour avec succès !');
    }
}
