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
    <a href="{{route('Fournisseur.modification', $utilisateur->id)}}">Modifier sa fiche fournisseur</a>
    <br>
    @if ($utilisateur->statut == 'actif')
    <a onclick="return confirm('Êtes-vous sûr de rendre votre compte inactif?')" href="{{ route('Fournisseur.inactif', $utilisateur->id) }}">Rendre le compte inactif</a>
    @else
    <a onclick="return confirm('Êtes-vous sûr de rendre votre compte actif?')" href="{{ route('Fournisseur.actif', $utilisateur->id) }}">Rendre le compte actif</a>
    @endif
</body>
@endsection