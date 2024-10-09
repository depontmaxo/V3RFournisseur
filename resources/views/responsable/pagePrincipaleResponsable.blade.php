@extends('layouts.app')
 
@section('titre', 'Index Responsable')
  
@section('contenu')
<body>
    <a href="{{route('Fournisseur.index')}}">Return</a>
    <h1>Mode Responsable</h1>
    <br>
    <br>
    <br>
    <a href="{{route('Fournisseur.listeInscripton')}}">Liste demande inscription</a>

    <h2>Liste des fournisseurs:</h2>
    

    <form method="get" action="/reponsableIndex/" style="display-flex">
        @method('get')

        <input type="text" placeholder="Rechercher" name="search" value="{{ request()->get('search') }}"/>
        <button class="btn btn-primary no-border-button" type="submit">Rechercher</button>

    </form>


    <div class="row">
        <p class="col-sm">Nom Fournisseur</p>
        <p class="col-sm">Adresse du fournisseur</p>
        <p class="col-sm">Ouvrir la fiche fournisseur</p>
    </div>

    @forelse ($utilisateursRechercher as $utilisateur)
        <div class="row listeFournisseur">
            <p class="col-sm">{{ $utilisateur->nomFournisseur }}</p>
            <p class="col-sm">{{ $utilisateur->adresse }}</p>
            <button type="button" onclick="window.location.href='{{ route('Fournisseur.fiche', [$utilisateur]) }}'" class="col-sm">Ouvrir</button>
        </div>
    @empty
        <p>Aucun fournisseur trouver</p>
    @endforelse

</body>
@endsection