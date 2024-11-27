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
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }



    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,responsable,commis',
            'password' => 'required|min:8', // Optionnel : validation du mot de passe
        ]);
    
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hachage du mot de passe
            'role' => $request->role,
            'is_admin' => $request->role === 'admin', // Détermine automatiquement is_admin
        ]);
    
        return response()->json(['success' => true, 'id' => $user->id], 201);
    }
    


    
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
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

        
}
