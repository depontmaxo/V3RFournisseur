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

    <h2>Liste des codes UNSPSC</h2>
    <button class="btn btn-outline-primary" onclick="toggleDiv()">Ajouter un code UNSPSC</button>
    
    <!-- Caché par défaut -->
    <div class="rechercheUNSPSC hidden">
        <!-- Search Form -->
        <form method="get" action="/index/unspsc/recherche" style="display-flex">
            @csrf
            <label for="nature_contrat">Nature :</label>
            <input type="checkbox" id="nature_contrat" name="nature_contrat" {{ request()->has('nature_contrat') ? 'checked' : '' }} />
            
            <label for="code_unspsc">Code UNSPSC :</label>
            <input type="checkbox" id="code_unspsc" name="code_unspsc" {{ request()->has('code_unspsc') ? 'checked' : '' }} />
            
            <label for="desc_det_unspsc">Description :</label>
            <input type="checkbox" id="desc_det_unspsc" name="desc_det_unspsc" {{ request()->has('desc_det_unspsc') ? 'checked' : '' }} />

            <input type="text" placeholder="Rechercher" id="recherche" name="recherche" value="{{ request('recherche') }}" />
            <button class="btn btn-primary no-border-button" type="submit">Rechercher</button>
        </form>

        <!-- Selection Form -->
        <form method="get" action="/index/unspsc/choisit" style="display-flex">
            @csrf
            <p>Nature / Code UNSPSC / Description</p>

            <!-- Display the List of UNSPSC Codes with Their Selection State Preserved -->
            @foreach ($codeUNSPSCunite as $unscpsc)
                <div class="decisionUNSPSC">
                    <input type="checkbox" 
                        id="code_unspsc_choisit_{{ $unscpsc->code_unspsc }}" 
                        name="code_unspsc_choisit[]" 
                        value="{{ $unscpsc->code_unspsc }}"> 
                    <p class="pUNSPSC">{{ $unscpsc->nature_contrat }} / {{ $unscpsc->code_unspsc }} / {{ $unscpsc->desc_det_unspsc }}</p>
                </div>
            @endforeach

            <!-- Pagination Links -->
            <div class="d-flex justify-content-between custom-pagination">
                {{ $codeUNSPSCunite->withQueryString()->links('pagination::bootstrap-4') }}
            </div>

            <button class="btn btn-primary no-border-button" type="submit">Complété sélection de mes codes UNSPSC</button>
        </form>
    </div>

    @if ($codes && $codes->count() > 0)
        <ul>
        @foreach ($codes as $code)
            <li class="UNSPSC_list">{{ $code->unspsc_id }} - {{ $code->desc_det_unspsc }}</li>
        @endforeach
        </ul>
    @else
        <p>Il n'y a pas de codes associés</p>
    @endif

    <script src="{{ asset('js/unspscToggle.js') }}"></script>
</body>

@endsection