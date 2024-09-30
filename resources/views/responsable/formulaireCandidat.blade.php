@extends('layouts.app')
 
@section('titre', 'Formulaire inscription candidat')
  
@section('contenu')
<body>
    @if (isset( $candidat))
        <p>Voici les information de votre compte</p>
        <br>
        <p>Entreprise : {{ $candidat->entreprise }}</p>
        <p>NEQ : {{ $candidat->neq }}</p>
        <p>Email: {{ $candidat->courrielConnexion }}</p>
        <p>Service: {{ $candidat->services }}</p>
        <p>Adresse: {{ $candidat->adresse }}</p>
        <p>Bureau: {{ $candidat->bureau }}</p>
        <p>Ville: {{ $candidat->ville }}</p>
        <p>Province: {{ $candidat->province }}</p>
        <p>Code Postal: {{ $candidat->codePostal }}</p>
        <p>Site web de votre entreprise: {{ $candidat->site }}</p>
        <p>Numéro de téléphone: {{ $candidat->numTel }}</p>
        <p>Prénom: {{ $candidat->prenom }}</p>
        <p>Nom: {{ $candidat->nom }}</p>
        <p>Poste: {{ $candidat->poste }}</p>
        <p>Courriel contact: {{ $candidat->courrielContact }}</p>
        <p>Numéro de contact: {{ $candidat->numContact }}</p>
        <p>RBQ: {{ $candidat->rbq }}</p>
    @else
        <p>404 Erreur<p>
    @endif
</body>

@endsection