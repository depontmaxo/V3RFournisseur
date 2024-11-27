@extends('layouts.app')
 
@section('titre', 'Page principale')

@push('styles')
    <!-- Page-specific CSS file -->
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
@endpush
  
@section('contenu')

@if (Auth::guard('web')->check())

    <body>
        <h1>Ajout d'un contact - {{ $utilisateur->nom_entreprise }}</h1>

        <form method="POST" action="{{ route('Fournisseur.nouveauContact.update', ['utilisateur' => $utilisateur->id]) }}" style="display: display-flex;" class="insideForm">
            @csrf
            <!-- Input fields -->
            <div class="form-group pt-2">
                <label for="prenom">Prénom du contact :</label>
                <input type="text" class="form-control" id="prenom" placeholder="Jane" name="prenom">
            </div>

            <div class="form-group pt-2">
                <label for="nom">Nom du contact :</label>
                <input type="text" class="form-control" id="nom" placeholder="Doe" name="nom">
            </div>

            <div class="form-group pt-2">
                <label for="poste">Poste occupé :</label>
                <input type="text" class="form-control" id="poste" placeholder="Développeur" name="poste">
            </div>

            <div class="form-group pt-2">
                <label for="email_contact">Courriel du contact :</label>
                <input type="email" class="form-control" id="email_contact" placeholder="JaneDoe@email.com" name="email_contact">
            </div>

            <div class="form-group pt-2">
                <label for="num_contact">Numéro de téléphone du contact :</label>
                <input type="text" class="form-control" id="num_contact" placeholder="(819)123-4567" name="num_contact">
            </div>
            
            <div class="form-group pt-2">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <button type="button" onclick="window.location.href='{{ route('Fournisseur.fiche', ['utilisateur' => $utilisateur->id]) }}'" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </body>
@else
    <script>
        window.location.href = '{{ route("RefusAccess") }}';
    </script>
@endif
@endsection