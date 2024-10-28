@extends('layouts.app')
 
@section('titre', 'Page information')
  
@section('contenu')
<body>
    <h1>{{ $utilisateur->nom_entreprise }}</h1>
    @if (isset( $utilisateur))
        <p>NEQ : {{ $utilisateur->neq }}</p>
        <p>Email: {{ $utilisateur->email }}</p>
        <p>Adresse: {{ $coordonnees->adresse }}</p>
        <p>Numero de téléphone: {{ $coordonnees->noTelephone }}</p>
        <p>Personne ressource: {{ $contacts->prenom }} {{ $contacts->nom }}</p>
        <p>Email de personne ressource: {{ $contacts->email_contact }}</p>
        <p>LicenceRBQ: {{ $utilisateur->rbq }}</p>
        <p>Poste occupé: {{ $contacts->poste }}</p>
        <p>Site web de votre entreprise: {{ $coordonnees->siteweb }}</p>
        <p>Services et/ou produits offerts : informations à venir</p>
        <p>Statut de votre demande d'inscription : {{ $utilisateur->statut }}</p>
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