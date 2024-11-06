@extends('layouts.app')
 
@section('titre', 'Index Responsable')
  
@section('contenu')
<body>
    <h1>Mode Responsable</h1>
    <br>

    <h2>Liste des fournisseurs:</h2>
    

    <form method="get" action="/responsable/recherche" style="display-flex">
        @csrf
        <label for="nom">Nom :</label>
        <input type="checkbox" id="nom" name="nom"/>
        <label for="adresse">Adresse :</label>
        <input type="checkbox" id="adresse" name="adresse"/>


        <input type="text" placeholder="Rechercher" id="recherche" name="recherche"/>
        <button class="btn btn-primary no-border-button" type="submit">Rechercher</button>
    </form>




    <div class="row">
        <p class="col-sm">Nom Fournisseur</p>
        <p class="col-sm">Adresse du fournisseur</p>
        <p class="col-sm">Ouvrir la fiche fournisseur</p>
    </div>

    @foreach ($utilisateurs as $utilisateur)
        <div class="row listeFournisseur">
            <p class="col-sm">{{ $utilisateur->nomFournisseur }}</p>
            <p class="col-sm">{{ $utilisateur->adresse }}</p>
            <button type="button" onclick="window.location.href='{{ route('Fournisseur.fiche', [$utilisateur]) }}'" class="col-sm">Ouvrir</button>
        </div>
    @empty
        <p>Aucun fournisseur trouver</p>
    @endforeach

</body>
@endsection