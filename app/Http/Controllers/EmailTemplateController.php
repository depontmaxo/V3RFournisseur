<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;

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
            $user = User::findOrFail($id); // Trouver l'utilisateur ou échouer
            $user->delete(); // Supprimer l'utilisateur
    
            return response()->json(['success' => true, 'message' => 'Utilisateur supprimé avec succès']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erreur lors de la suppression de l\'utilisateur'], 500);
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
    
}
