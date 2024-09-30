@extends('layouts.app')
 
@section('titre', 'Page information')
  
@section('contenu')
<body>
    @if (Auth::user()->role == 'responsable')
        <a href="{{route('Responsable.index')}}">Retourner à la page de responsable</a>
    @endif

    <h1>Voici votre fiche</h1>

    @if (isset( $utilisateur))
        <p>Voici les information de votre compte</p>
        <br>
        <p>NEQ : {{ $utilisateur->neq }}</p>
        <p>Email: {{ $utilisateur->email }}</p>
        <p>Nom fournisseur: {{ $utilisateur->nomFournisseur }}</p>
        <p>Adresse: {{ $utilisateur->adresse }}</p>
        <p>Numero de téléphone: {{ $utilisateur->noTelephone }}</p>
        <p>Personne ressource: {{ $utilisateur->personneRessource }}</p>
        <p>Email de personne ressource: {{ $utilisateur->emailPersonneRessource }}</p>
        <p>LicenceRBQ: {{ $utilisateur->licenceRBQ }}</p>
        <p>Poste occupé: {{ $utilisateur->posteOccupeEntreprise }}</p>
        <p>Site web de votre entreprise: {{ $utilisateur->siteWeb }}</p>
        <p>Produit ou Service: {{ $utilisateur->produitOuService }}</p>
    @else
        <p>404 Erreur<p>
    @endif
    <br>
    <a href="{{route('Fournisseur.modification', [auth()->user()->id])}}">Modifier sa fiche fournisseur</a>
    <br>
    <a onclick="return confirm('Êtes-vous sûr de rendre votre compte inactif?')" href="{{ route('Fournisseur.inactif', [auth()->user()->id]) }}">Rendre le compte inactif</a>
</body>
@endsection