<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->is_admin ?? false,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
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
    public function deleteUser($id)
    {
        $user = User::find($id);
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
}
