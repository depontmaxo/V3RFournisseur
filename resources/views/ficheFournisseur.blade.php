@extends('layouts.app')
 
@section('titre', 'Votre fiche')
  
@section('contenu')

@if (Auth::guard('web')->check() || (Auth::guard('user')->check() && (Auth::guard('user')->user()->role == 'responsable' || Auth::guard('user')->user()->role == 'commis')))

    <body>
        @if (Auth::guard('web')->check())
        <h1>Votre fiche fournisseur - {{ $utilisateur->nom_entreprise }}</h1>
        @else
        <h1>La fiche du fournisseur - {{ $utilisateur->nom_entreprise }}</h1>
        @endif

        @if (isset( $utilisateur))
            <div class="sections pt-3">Information de votre compte</div>
            <p><span class="soustitre-bold">NEQ: </span>{{ $utilisateur->neq }}</p>
            <p><span class="soustitre-bold">Email: </span>{{ $utilisateur->email }}</p>
            <p><span class="soustitre-bold">Licence RBQ: </span>{{ $utilisateur->rbq }}</p>
            <p><span class="soustitre-bold">Services et/ou produits offerts: </span>informations à venir</p>
            <p><span class="soustitre-bold">Statut de votre demande d'inscription: </span>{{ $utilisateur->statut }}</p>
    
            <div class="sections pt-3">Coordonnées de votre entreprise</div>
            <p><span class="soustitre-bold">Adresse: </span>{{ $coordonnees->adresse }}</p>
            <p><span class="soustitre-bold">Bureau/suite: </span>{{ $coordonnees->bureau }}</p>
            <p><span class="soustitre-bold">Pays: </span>{{ $coordonnees->pays }}</p>
            <p><span class="soustitre-bold">Province: </span>{{ $coordonnees->province }}</p>
            <p><span class="soustitre-bold">Ville: </span>{{ $coordonnees->ville }}</p>
            <p><span class="soustitre-bold">Code postal: </span>{{ $coordonnees->code_postal }}</p>
            <p><span class="soustitre-bold">Numero de téléphone: </span>{{ $coordonnees->num_telephone }}</p>
            <p><span class="soustitre-bold">Site web de votre entreprise: </span>{{ $coordonnees->siteweb }}</p>
            
            <div class="sections pt-3">Information contact(s)</div>
            @foreach ($contacts as $index => $contact)
                <h5>Contact {{$index + 1}}</h5>
                <p><span class="soustitre-bold">Nom complet: </span>{{ $contact->prenom }} {{ $contact->nom }}</p>
                <p><span class="soustitre-bold">Poste occupé: </span>{{ $contact->poste }}</p>
                <p><span class="soustitre-bold">Courriel: </span>{{ $contact->email_contact }}</p>
                <p><span class="soustitre-bold">Numéro rejoignable: </span>{{ $contact->num_contact }}</p>
                <!--<i class="fa-solid fa-file-excel fa-4x"></i>
                <i class="fa-solid fa-file-word fa-4x"></i>
                <i class="fa-solid fa-file-image fa-4x"></i>-->
                
            @endforeach

            @if (count($documents) != 0)
                <div class="sections pt-3">Vos fichier(s) joint(s)</div>
                @foreach ($documents as $index => $document)
                    <div class="">
                        <a href="{{ route('Document.download', $document->id) }}" style="text-decoration: none; color: inherit;">
                            <i class="fa-solid fa-file fa-4x"></i>
                            <p>{{ $document->file_name }}</p>
                        </a>
                    </div>
                @endforeach
            @endif

            @if (Auth::guard('web')->check() || (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'responsable'))
            <a href="{{route('Fournisseur.modification', [$utilisateur])}}" class="btn btn-success my-3">Modifier</a>
            @endif

        @else
            <p>404 Erreur<p>
        @endif


        <h2>Liste des codes UNSPSC</h2>
        <button class="btn btn-outline-primary" onclick="toggleDiv()">Ajouter un code UNSPSC</button>
        
        <!-- Caché par défaut -->
        <div class="rechercheUNSPSC hidden">
            <!-- Search Form -->
            <form method="get" action="/index/unspsc/recherche" style="display: display-flex;">
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
            <form method="get" action="/index/unspsc/choisit" style="display: display-flex;">
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

                <input type="hidden" name="fiche_utilisateur_id" value="{{ $utilisateur->id }}">

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

@else
    <script>
        window.location.href = '{{ route("RefusAccess") }}';
    </script>
@endif

@endsection