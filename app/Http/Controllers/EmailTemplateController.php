<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\User;
use App\Models\Utilisateur;


class EmailTemplateController extends Controller
{
    // Récupérer tous les modèles
    public function index()
    {
        // Récupérer tous les modèles depuis la base de données
        $templates = EmailTemplate::all();

        // Passer la variable à la vue
        return view('admin.GestionCourrielAdmin', compact('templates'));
    }

    // Ajouter un modèle
    public function store(Request $request)
    {
        $request->validate([
            'nom_Modele' => 'required|unique:email_templates,nom_Modele|max:255',
            'objet' => 'required|max:255',
            'message' => 'required',
        ]);

        $template = EmailTemplate::create([
            'nom_Modele' => $request->nom_Modele,
            'objet' => $request->objet,
            'message' => $request->message,
        ]);

        return redirect()->route('email.templates.index')->with('success', 'Modèle ajouté avec succès.');
    }

    public function destroy($id)
    {
        try {
            // Trouver le modèle de courriel avec l'id
            $template = EmailTemplate::findOrFail($id);
            $template->delete(); // Supprimer le modèle
    
            return redirect()->route('email.templates.index')->with('success', 'Modèle supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->route('email.templates.index')->with('error', 'Erreur lors de la suppression du modèle');
        }
    }
    
    
    
    
    public function show($id)
    {
        $template = EmailTemplate::findOrFail($id);
        return response()->json($template);
    }


    public function update(Request $request, $id)
    {
        $template = EmailTemplate::findOrFail($id);
        $template->update([
            'nom_Modele' => $request->input('nom_Modele'),
            'objet' => $request->input('objet'),
            'message' => $request->input('message'),
        ]);
    
        return redirect()->back()->with('success', 'Modèle mis à jour avec succès.');
    }
    

    public function EnvoiMailResponsable()
    {
        // Récupérer tous les utilisateurs et tous les modèles
        $utilisateurs = Utilisateur::all();
        $templates = EmailTemplate::all();

        // Passer les données à la vue
        return view('responsable.CourrielResponsable', compact('utilisateurs', 'templates'));
    }

}
