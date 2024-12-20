<!-- responsable/CourrielResponsable.blade.php -->

@extends('layouts.app') 

@section('content')
<div class="container mt-5">
    <h2>Envoyer un Courriel au Responsable</h2>

    <!-- Formulaire d'envoi d'email -->
    <form action="" method="POST">    
        @csrf

        <!-- Sélection de l'utilisateur -->
        <div class="mb-3">
            <label for="utilisateur" class="form-label">Choisir un Utilisateur</label>
            <select id="utilisateur" name="utilisateur_id" class="form-select" required>
                <option value="" disabled selected>Choisir un utilisateur</option>
                @foreach ($utilisateurs as $utilisateur)
                    <option value="{{ $utilisateur->id }}">{{ $utilisateur->email }}</option>
                @endforeach
            </select>
        </div>

        <!-- Sélection du modèle -->
        <div class="mb-3">
            <label for="template" class="form-label">Choisir un Modèle de Courriel</label>
            <select id="template" name="template_id" class="form-select" required>
                <option value="" disabled selected>Choisir un modèle</option>
                @foreach ($templates as $template)
                    <option value="{{ $template->id }}">{{ $template->nom_Modele }} - {{ $template->objet }}</option>
                @endforeach
            </select>
        </div>

        <!-- Bouton d'envoi -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Envoyer le Courriel</button>
        </div>
    </form>
</div>
@endsection
