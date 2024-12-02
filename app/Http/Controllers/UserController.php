<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\EmailTemplate;



class UserController extends Controller
{

    public function gestionUser()
    {
        $users = User::all();

        return view('admin.GestionUsers', compact ('users')) ;
    }

    

    // UserController.php
    public function destroy($id)
    {
        // Trouver l'utilisateur à supprimer
        $user = User::findOrFail($id);
    
        // Vérifier si l'utilisateur à supprimer est un admin
        if ($user->role == 'admin') {
            // Compter le nombre d'admins restants dans la base de données
            $adminCount = User::where('role', 'admin')->count();
    
            // Si il ne reste que 2 admins, empêcher la suppression
            if ($adminCount <= 2) {
                return response()->json(['success' => false, 'message' => 'Il doit y avoir au moins 2 administrateurs.'], 400);
            }
        }
    
        // Effectuer la suppression
        $user->delete();
    
        return response()->json(['success' => true, 'message' => 'Utilisateur supprimé avec succès.']);
    }
    

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:6',
        ]);
    
        // Création de l'utilisateur
        $user = User::create([
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);
    
        return response()->json(['success' => true, 'message' => 'Utilisateur ajouté avec succès']);
    }
    


    
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }


    ##Suppresion d'un utilisateur
    public function deleteUser($uid)
    {
        $user = User::find($uid);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    #Modification du role d'un utilisateur
    public function updateRoles(Request $request) {
        foreach ($request->roles as $roleUpdate) {
            $user = User::find($roleUpdate['id']);
            if ($user) {
                $user->role = $roleUpdate['role'];
                $user->save();
            }
        }
        
        return response()->json(['message' => 'Rôles mis à jour avec succès.']);
    }



    #Afficher la page de reglage systeme des admins
    public function adminReglageIndex() {

        return view('admin.parametreSystemeAdmin');
    }

    public function index(){

        return view('admin.acceuilAdmin');
    }

    public function GestionCourriel(){
        // Récupérer tous les modèles depuis la base de données
        $templates = EmailTemplate::all();

        // Passer la variable à la vue
        return view('admin.GestionCourrielAdmin', compact('templates'));

    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'email' => 'required|email',
            'role' => 'required|in:admin,commis,responsable',
            'password' => 'nullable|min:6',
        ]);

        // Récupérer l'utilisateur
        $user = User::findOrFail($id);

        // Mise à jour des informations
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save(); // Enregistrer dans la base de données

        return response()->json(['success' => true, 'message' => 'Utilisateur mis à jour avec succès']);
    }





        
}
