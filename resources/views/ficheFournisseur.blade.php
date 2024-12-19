@extends('layouts.app')
 
@section('titre', 'Votre fiche')
  
@section('contenu')

@if (Auth::guard('web')->check() || (Auth::guard('user')->check() && (Auth::guard('user')->user()->role == 'responsable' || Auth::guard('user')->user()->role == 'commis')))

    <link rel="stylesheet" href="{{ asset('css/ficheFournisseur.css') }}">

    <body>
        @if (Auth::guard('web')->check())
        <h1>Votre fiche fournisseur - {{ $utilisateur->nom_entreprise }}</h1>
        @else
        <h1>La fiche du fournisseur - {{ $utilisateur->nom_entreprise }}</h1>
        @endif

        @if (isset( $utilisateur))
            <div class="sections pt-3">Information de votre compte</div>
            <p><span class="soustitre-bold">NEQ: </span>{{ $utilisateur->neq ?? 'Non Disponible' }}</p>
            <p><span class="soustitre-bold">Email: </span>{{ $utilisateur->email ?? 'Non Disponible' }}</p>
            <p><span class="soustitre-bold">Licence RBQ: </span>{{ $utilisateur->rbq ?? 'Pas définie' }}</p>
            <p><span class="soustitre-bold">Services et/ou produits offerts: </span>informations à venir</p>
            <p><span class="soustitre-bold">Statut de votre demande d'inscription: </span>{{ $utilisateur->statut ?? 'Non Disponible' }}</p>
    
            <div class="sections pt-3">Coordonnées de votre entreprise</div>
            <p><span class="soustitre-bold">Bureau/suite: </span>{{ $coordonnees->bureau ?? 'Non Disponible' }}</p>
            <p><span class="soustitre-bold">Adresse: </span>{{ $coordonnees->num_civique ?? 'Non Disponible' }} {{ $coordonnees->rue ?? 'Non Disponible' }}</p>
            <p><span class="soustitre-bold">Ville: </span>{{ $coordonnees->ville ?? 'Non Disponible' }}</p>
            @if ($coordonnees->province == 'Québec')
                <p><span class="soustitre-bold">Région: </span> {{ $coordonnees->region_administrative ?? 'Non Disponible' }} </p> 
            @endif
            <p><span class="soustitre-bold">Province: </span>{{ $coordonnees->province ?? 'Non Disponible' }}</p>
            <p><span class="soustitre-bold">Code postal: </span>{{ $coordonnees->code_postal ?? 'Non Disponible' }}</p>
            <p><span class="soustitre-bold">Numero de téléphone: </span>{{ $coordonnees->num_telephone ?? 'Non Disponible' }}</p>
            <p><span class="soustitre-bold">Poste: </span>{{ $coordonnees->poste ?? 'Non Disponible' }}</p>
            <p><span class="soustitre-bold">Type de contact: </span>{{ $coordonnees->type_contact ?? 'Non Disponible' }}</p>
            <p><span class="soustitre-bold">Site web de votre entreprise: </span>{{ $coordonnees->siteweb ?? 'Pas définie' }}</p>
            <div class="sections pt-3">Finance de votre entreprise</div>
            <p><span class="soustitre-bold">Numéro TPS: </span>{{ $finances->numeroTPS ?? 'Pas définie' }}</p>
            <p><span class="soustitre-bold">Numéro TVQ: </span>{{ $finances->numeroTVQ ?? 'Pas définie' }}</p>
            <p><span class="soustitre-bold">Condition de paiement: </span>{{ $finances->conditionPaiement ?? 'Pas définie' }}</p>
            <p><span class="soustitre-bold">Devise: </span>{{ $finances->devise ?? 'Pas définie' }}</p>
            <p><span class="soustitre-bold">Mode de communication: </span>{{ $finances->modeCommunication ?? 'Pas définie' }}</p>
            <div class="sections pt-3">Information contact(s)</div>
            @foreach ($contacts as $index => $contact)
                <div class="contact">
                    <h5>Contact {{$index + 1}}</h5>                
                    @if (count($contacts) >= 2)
                    
                        <form action="{{ route('Fournisseurs.supprimerContacts') }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                            <input type="hidden" name="utilisateur_id" value="{{ $utilisateur->id }}">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    @endif
                </div>
                <p><span class="soustitre-bold">Nom complet: </span>{{ $contact->prenom }} {{ $contact->nom ?? 'Non Disponible' }}  </p>
                <p><span class="soustitre-bold">Fonction: </span>{{ $contact->fonction ?? 'Non Disponible' }}</p>
                <p><span class="soustitre-bold">Courriel: </span>{{ $contact->email_contact ?? 'Non Disponible' }}</p>
                <p><span class="soustitre-bold">Numéro rejoignable: </span>{{ $contact->num_contact ?? 'Non Disponible' }}</p>


                
                <!--<i class="fa-solid fa-file-excel fa-4x"></i>
                <i class="fa-solid fa-file-word fa-4x"></i>
                <i class="fa-solid fa-file-image fa-4x"></i>-->
                
            @endforeach

            @if (Auth::guard('web')->check() || (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'responsable'))
            <a href="{{route('Fournisseur.nouveauContact', [$utilisateur])}}" class="btn btn-success my-3">Ajouter contact</a>
            @endif

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
            <div class="sections pt-3">Modification de la fiche</div>
            <a href="{{route('Fournisseur.modification', [$utilisateur])}}" class="btn btn-success my-3">Modifier</a>
            @endif

        @else
            <p>404 Erreur<p>
        @endif


        <h2 id="Recherche">Liste des codes UNSPSC </h2>
        
        @if ($codes && $codes->count() > 0)
            <ul>
                @foreach ($codes as $code)
                    <li class="UNSPSC_list">
                        {{ $code->nature_contrat }} / {{ $code->desc_cat }} / {{ $code->unspsc_id }} / {{ $code->desc_det_unspsc }} 
                        <!-- Remove Code Form -->
                        <form action="{{ route('Fournisseurs.supprimerUNSPSC') }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="unspsc_id" value="{{ $code->unspsc_id }}">
                            <input type="hidden" name="utilisateur_id" value="{{ $utilisateur->id }}">
                            <button type="submit" class="btn btn-sm btn-danger UNSPSC_delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce code ?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Il n'y a pas de codes associés</p>
        @endif

        @if (Auth::guard('web')->check() || (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'responsable'))
            <button class="btn btn-outline-primary" onclick="toggleDiv()">Ajouter un code UNSPSC</button>
        @endif

        <!-- Caché par défaut -->
        <div class="rechercheUNSPSC hidden">
            <!-- Search Form -->
            <form method="get" action="/unspsc/recherche#Recherche" style="display: display-flex;">
                @csrf
                <label for="nature_contrat">Nature :</label>
                <input type="checkbox" id="nature_contrat" name="nature_contrat" {{ request()->has('nature_contrat') ? 'checked' : '' }} />
                
                <label for="desc_cat">Catégorie :</label>
                <input type="checkbox" id="desc_cat" name="desc_cat" {{ request()->has('desc_cat') ? 'checked' : '' }} />

                <label for="code_unspsc">Code UNSPSC :</label>
                <input type="checkbox" id="code_unspsc" name="code_unspsc" {{ request()->has('code_unspsc') ? 'checked' : '' }} />
                
                <label for="desc_det_unspsc">Description :</label>
                <input type="checkbox" id="desc_det_unspsc" name="desc_det_unspsc" {{ request()->has('desc_det_unspsc') ? 'checked' : '' }} />

                <input type="hidden" name="fiche_utilisateur_id" value="{{ $utilisateur->id }}">

                <input type="text" placeholder="Rechercher" id="recherche" name="recherche" value="{{ request('recherche') }}" />
                <button class="btn btn-primary no-border-button" type="submit">Rechercher</button>
            </form>

            <!-- Selection Form -->
            <form method="get" action="/unspsc/choisit" style="display: display-flex;" class="insideForm">
                @csrf
                <p>Nature | Catégorie | Code UNSPSC | Description</p>

                <!-- Display the List of UNSPSC Codes with Their Selection State Preserved -->
                @foreach ($codeUNSPSCunite as $unspsc)
                    <div class="decisionUNSPSC" >
                        <input type="checkbox" 
                            id="code_unspsc_choisit_{{ $unspsc->code_unspsc }}" 
                            name="code_unspsc_choisit[]" 
                            value="{{ $unspsc->code_unspsc }}"> 
                        <p class="pUNSPSC">{{ $unspsc->nature_contrat }} | {{ $unspsc->desc_cat }} | {{ $unspsc->code_unspsc }} | {{ $unspsc->desc_det_unspsc }}</p>
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

        <script src="{{ asset('js/unspscToggle.js') }}"></script>

    </body>

@else
    <script>
        window.location.href = '{{ route("RefusAccess") }}';
    </script>
@endif

@endsection