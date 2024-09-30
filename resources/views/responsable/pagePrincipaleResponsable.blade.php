@extends('layouts.app')
 
@section('titre', 'Index Responsable')
  
@section('contenu')
<body>
    <a href="{{route('Fournisseur.index')}}">Return</a>
    <h1>Mode Responsable</h1>
    <br>
<<<<<<< HEAD
    <a href="{{route('Fournisseur.listeInscripton')}}">Liste demande inscription</a>

=======
    <br>
>>>>>>> main
    <h2>Liste des fournisseurs:</h2>
    
    <div class="row">
        <p class="col-sm">Nom Fournisseur</p>
        <p class="col-sm">Adresse du fournisseur</p>
        <p class="col-sm">Ouvrir la fiche fournisseur</p>
    </div>
    @if (count($utilisateurs))
        @foreach ($utilisateurs as $utilisateur)
            <div class="row listeFournisseur">
                <p class="col-sm">{{ $utilisateur->nomFournisseur }}</p>
                <p class="col-sm">{{ $utilisateur->adresse }}</p>
                <button type="button" onclick="window.location.href='{{ route('Fournisseur.fiche', [$utilisateur]) }}'" class="col-sm">Ouvrir</button>
            </div>

        @endforeach
    @else
        <p>404 Erreur<p>
    @endif

</body>
@endsection