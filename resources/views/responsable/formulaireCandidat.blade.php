@extends('layouts.app')
 
@section('titre', 'Page information')
  
@section('contenu')
@if (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'responsable')
    <body>
        <h1>{{ $candidat->nom_entreprise }}</h1>
        @if (isset( $candidat))
            <p>NEQ : {{ $candidat->neq }}</p>
            <p>Email: {{ $candidat->email }}</p>
            <p>Adresse: {{ $coordonnees->adresse }}</p>
            <p>Numero de téléphone: {{ $coordonnees->noTelephone }}</p>
            <p>Personne ressource: {{ $contacts->prenom }} {{ $contacts->nom }}</p>
            <p>Email de personne ressource: {{ $contacts->email_contact }}</p>
            <p>LicenceRBQ: {{ $candidat->rbq }}</p>
            <p>Poste occupé: {{ $contacts->poste }}</p>
            <p>Site web de votre entreprise: {{ $coordonnees->siteweb }}</p>
            <p>Services et/ou produits offerts : informations à venir</p>
            <p>Statut de votre demande d'inscription : {{ $candidat->statut }}</p>
        @else
            <p>404 Erreur<p>
        @endif
        <br>
        <a href="{{route('Fournisseur.modification', $candidat->id)}}">Modifier sa fiche fournisseur</a>
        <br>

        <a onclick="return confirm('Êtes-vous sûr de vouloir accepter ce candidat?')" href="{{ route('Candidat.Accepte', $candidat->id) }}">Accepter</a>

        <a onclick="return confirm('Êtes-vous sûr de voulour refuser ce candidat?')" href="{{ route('Candidat.Refuse', $candidat->id) }}">Refuser</a>

    </body>
@else
    <script>
        window.location.href = '{{ route("RefusAccess") }}';
    </script>
@endif  
@endsection