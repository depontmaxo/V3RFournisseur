@extends('layouts.app')
 
@section('titre', 'Page information')
  
@section('contenu')
@if (Auth::guard('user')->check() && (Auth::guard('user')->user()->role == 'responsable' || Auth::guard('user')->user()->role == 'commis'))
    <body>
        <h1>{{ $candidat->nom_entreprise ?? 'Non Disponible' }}</h1>
        @if (isset( $candidat))
            <p>NEQ : {{ $candidat->neq ?? 'Non Disponible' }}</p>
            <p>Email: {{ $candidat->email ?? 'Non Disponible' }}</p>
            <p>Adresse: {{ $coordonnees->num_civique ?? 'Non Disponible' }} {{ $coordonnees->rue ?? 'Non Disponible' }}, {{ $coordonnees->ville ?? 'Non Disponible' }}</p>
            <p>Numero de téléphone: {{ $coordonnees->num_telephone ?? 'Non Disponible' }}</p>
            <p>Personne ressource: {{ $contacts->prenom ?? 'Non Disponible' }} {{ $contacts->nom ?? 'Non Disponible' }}</p>
            <p>Email de personne ressource: {{ $contacts->email_contact ?? 'Non Disponible' }}</p>
            <p>LicenceRBQ: {{ $candidat->rbq ?? 'Non Disponible' }}</p>
            <p>Poste occupé: {{ $contacts->poste ?? 'Non Disponible' }}</p>
            <p>Site web de votre entreprise: {{ $coordonnees->siteweb ?? 'Non Disponible' }}</p>
            <p>Services et/ou produits offerts : informations à venir</p>
            <p>Statut de la demande : {{ $candidat->statut ?? 'Non Disponible' }}</p>
        @else
            <p>404 Erreur<p>
        @endif

        @if (Auth::guard('user')->user()->role == 'responsable')
        <br>
        <a href="{{route('Fournisseur.modification', $candidat->id)}}">Modifier sa fiche fournisseur</a>
        <br>

        <a onclick="return confirm('Êtes-vous sûr de vouloir accepter ce candidat?')" href="{{ route('Candidat.Accepte', $candidat->id) }}">Accepter</a>

        <a onclick="return confirm('Êtes-vous sûr de voulour refuser ce candidat?')" href="{{ route('Candidat.Refuse', $candidat->id) }}">Refuser</a>
        @endif

    </body>
@else
    <script>
        window.location.href = '{{ route("RefusAccess") }}';
    </script>
@endif  
@endsection