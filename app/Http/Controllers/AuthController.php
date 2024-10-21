<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    
    public function index()
    {
        return view('admin.index');  // Renvoie la vue d'index pour l'admin
    }

    // Gère la connexion
    public function adminLogin(Request $request)
    {
        // Valide les entrées
        $request->validate([
            'email' => 'required|email',
            'role' => 'required',
        ]);

        // Vérifie si l'utilisateur existe avec l'email et le rôle
        $user = User::where('email', $request->email)
                     ->where('role', $request->role)
                     ->first();

        if ($user) {
            // Connecte l'utilisateur et redirige vers la page d'accueil admin
            Auth::login($user);
            return redirect()->route('acceuilAdmin.index');
        } else {
            // Redirige avec un message d'erreur si l'utilisateur n'existe pas
            return back()->withErrors(['email' => 'Les informations de connexion sont incorrectes.']);
        }
    }
}


