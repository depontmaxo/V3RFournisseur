@extends('layouts.app')
 
@section('titre', 'Modification fiche fournisseur')
  
@section('contenu')
@if (auth()->user() !== null) 
    <!-- tout le site ici -->
    @if (Auth::user()->role == 'responsable' || Auth::user()->role == 'commis')
       <h1>Modifier fiche fournisseur</h1>
    @elseif (Auth::user()->role == 'fournisseur')
        <h1>Modifier information de votre profile</h1>
    @endif
@endif

<body>
    @if (isset($utilisateur))
    <form method="POST" action="{{route('Fournisseur.appliqueModification', [$utilisateur]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="container-fluid">
        
        <!--SECTIONS UTILISATEUR-->
        <span class="sections">Information de votre profile</span>
            <div class="form-group pt-2">
                <label for="nom_entreprise">Nom de l'entreprise :</label>
                <input type="text" class="form-control" id="nom_entreprise" placeholder="Nom de votre entreprise" name="nom_entreprise" value="{{ old('nom_entreprise', $utilisateur->nom_entreprise) }}">
                @error('nom_entreprise')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group pt-2">
                <label for="NEQ">NEQ :</label>
                <input type="text" class="form-control" id="neq" placeholder="NEQ (10 chiffres)" name="neq" value="{{$utilisateur->neq}}">
            </div>

            <div class="form-group pt-2">
                <label for="Email">Email :</label>
                <input type="text" class="form-control" id="email" placeholder="email@email.com" name="email" value="{{ $utilisateur->email }}">
            </div>
            <div class="form-group pt-2">
                <label for="rbq">Licence(s) RBQ :</label>
                <input type="text" class="form-control" id="rbq" placeholder="Licence(s) RBQ" name="rbq" value="{{ $utilisateur->rbq }}">
            </div>

            <!--SECTIONS COORDONNÉES-->
            </br>
            <span class="sections">Coordonnées de l'entreprise :</span>
            <div class="form-group pt-2">
                <label for="adresse">Adresse :</label>
                <input type="text" class="form-control" id="adresse" placeholder="adresse" name="adresse" value="{{$coordonnees->adresse}}">
            </div>
            <div class="form-group pt-2">
                <label for="bureau">Numéro de bureau/suite :</label>
                <input type="text" class="form-control" id="bureau" placeholder="# suite" name="bureau" value="{{$coordonnees->bureau}}">
            </div>
            <div class="form-group pt-2">
                <label for="ville">Ville :</label>
                <input type="text" class="form-control" id="ville" placeholder="Montréal" name="ville" value="{{$coordonnees->ville}}">
            </div>
            <div class="form-group pt-2">
                <label for="province">Province :</label>
                <input type="text" class="form-control" id="province" placeholder="Québec" name="province" value="{{$coordonnees->province}}">
            </div>
            <div class="form-group pt-2">
                <label for="code_postal">Code postal :</label>
                <input type="text" class="form-control" id="code_postal" placeholder="A1A 1A1" name="code_postal" value="{{$coordonnees->code_postal}}">
            </div>
            <div class="form-group pt-2">
                <label for="pays">Pays :</label>
                <input type="text" class="form-control" id="pays" placeholder="Canada" name="pays" value="{{$coordonnees->pays}}">
            </div>
            <div class="form-group pt-2">
                <label for="siteweb">Site web :</label>
                <input type="text" class="form-control" id="siteweb" placeholder="https://www.votresite.ca/" name="siteweb" value="{{$coordonnees->siteweb}}">
            </div>

            <div class="form-group pt-2">
                <label for="num_telephone">Numéro de téléphone :</label>
                <input type="text" class="form-control" id="num_telephone" placeholder="(514)123-4567" name="num_telephone" value="{{$coordonnees->num_telephone}}">
            </div>

            

            <!--SECTIONS CONTACTS-->
            <?php
                $nbFournisseur = 1;
            ?>
            </br>
            <span class="sections">Information contact(s)</span>

            @foreach ($contacts as $index => $contact)
                <h6>Contact {{ $index + 1 }}</h6>
                <div class="form-group pt-2">
                    <label for="prenom_{{ $index }}">Prénom du contact :</label>
                    <input type="text" class="form-control" id="prenom_{{ $index }}" placeholder="Jane" name="prenom[{{ $index }}]" value="{{ $contact->prenom }}">
                </div>
                <div class="form-group pt-2">
                    <label for="nom_{{ $index }}">Nom du contact :</label>
                    <input type="text" class="form-control" id="nom_{{ $index }}" placeholder="Doe" name="nom[{{ $index }}]" value="{{ $contact->nom }}">
                </div>
                <div class="form-group pt-2">
                    <label for="poste_{{ $index }}">Poste occupé :</label>
                    <input type="text" class="form-control" id="poste_{{ $index }}" placeholder="Développeur" name="poste[{{ $index }}]" value="{{ $contact->poste }}">
                </div>
                <div class="form-group pt-2">
                    <label for="email_contact_{{ $index }}">Courriel du contact :</label>
                    <input type="text" class="form-control" id="email_contact_{{ $index }}" placeholder="JaneDoe@email.com" name="email_contact[{{ $index }}]" value="{{ $contact->email_contact }}">
                </div>
                <div class="form-group pt-2">
                    <label for="num_contact_{{ $index }}">Numéro de téléphone du contact :</label>
                    <input type="text" class="form-control" id="num_contact_{{ $index }}" placeholder="(819)123-4567" name="num_contact[{{ $index }}]" value="{{ $contact->num_contact }}">
                </div>
                </br>
            @endforeach

            <div class="form-group pt-2">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div> 
        </div>

        <!--SECTIONS DOCUMENTS-->
    </form>
    @else
        <div>Une erreur est survenue, veuiller réessayer plus tard!</div>
    @endif
</body>

@endsection



