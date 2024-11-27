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

    // Supprimer un modèle
    public function destroy($id)
    {
        $template = EmailTemplate::findOrFail($id);
        $template->delete();

        return response()->json(['message' => 'Modèle supprimé avec succès']);
    }

    public function show($id)
    {
        $template = EmailTemplate::findOrFail($id);
        return response()->json($template);
    }


    public function update(Request $request, $id)
    {
        // Logique pour mettre à jour un modèle d'e-mail
        // Exemple :
        $template = EmailTemplate::findOrFail($id); // Assurez-vous d'avoir le modèle EmailTemplate
        $template->update($request->only(['objet', 'message']));
        return response()->json(['message' => 'Modèle mis à jour avec succès.']);
    }
}
