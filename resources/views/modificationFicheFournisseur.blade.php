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
    <form method="POST" action="{{route('Fournisseur.modification', [$utilisateur, $contacts, $coordonnees]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="container-fluid">
        
        <!--SECTIONS UTILISATEUR-->
        <span class="sections">Information de votre profile</span>
            <div class="form-group">
                <label for="nom_entreprise">Nom de l'entreprise :</label>
                <input type="text" class="form-control" id="nom_entreprise" placeholder="Nom de votre entreprise" name="nom_entreprise" value="{{$utilisateur->nom_entreprise}}">
            </div>

            <div class="form-group">
                <label for="NEQ">NEQ :</label>
                <input type="text" class="form-control" id="neq" placeholder="NEQ (10 chiffres)" name="neq" value="{{$utilisateur->neq}}">
            </div>

            <div class="form-group">
                <label for="Email">Email :</label>
                <input type="text" class="form-control" id="email" placeholder="email@email.com" name="email" value="{{ $utilisateur->email }}">
            </div>
            <div class="form-group">
                <label for="rbq">Licence(s) RBQ :</label>
                <input type="text" class="form-control" id="rbq" placeholder="Licence(s) RBQ" name="rbq" value="{{ $utilisateur->rbq }}">
            </div>

            <!--SECTIONS COORDONNÉES-->
            </br>
            <span class="sections">Coordonnées de l'entreprise :</span>
            <div class="form-group">
                <label for="adresse">Adresse :</label>
                <input type="text" class="form-control" id="adresse" placeholder="adresse" name="adresse" value="{{$coordonnees->adresse}}">
            </div>
            <div class="form-group">
                <label for="bureau">Numéro de bureau/suite :</label>
                <input type="text" class="form-control" id="bureau" placeholder="# suite" name="bureau" value="{{$coordonnees->bureau}}">
            </div>
            <div class="form-group">
                <label for="ville">Ville :</label>
                <input type="text" class="form-control" id="ville" placeholder="Montréal" name="ville" value="{{$coordonnees->ville}}">
            </div>
            <div class="form-group">
                <label for="province">Province :</label>
                <input type="text" class="form-control" id="province" placeholder="Québec" name="province" value="{{$coordonnees->province}}">
            </div>
            <div class="form-group">
                <label for="code_postal">Code postal :</label>
                <input type="text" class="form-control" id="code_postal" placeholder="A1A 1A1" name="code_postal" value="{{$coordonnees->code_postal}}">
            </div>
            <div class="form-group">
                <label for="pays">Pays :</label>
                <input type="text" class="form-control" id="pays" placeholder="Canada" name="pays" value="{{$coordonnees->pays}}">
            </div>
            <div class="form-group">
                <label for="siteweb">Site web :</label>
                <input type="text" class="form-control" id="siteweb" placeholder="https://www.votresite.ca/" name="siteweb" value="{{$coordonnees->siteweb}}">
            </div>

            <div class="form-group">
                <label for="num_telephone">Numéro de téléphone :</label>
                <input type="text" class="form-control" id="num_telephone" placeholder="(514)123-4567" name="num_telephone" value="{{$coordonnees->num_telephone}}">
            </div>

            

            <!--SECTIONS CONTACTS-->
            </br>
            <span class="sections">Information contact(s)</span>
            @foreach ($contacts as $contact)
            
            @endforeach
            <div class="form-group">
                <label for="personneRessource">Personne ressource:</label>
                <input type="text" class="form-control" id="personneRessource" placeholder="Jane Doe" name="personneRessource" value="{{ $utilisateur->personneRessource }}">
            </div>
            <div class="form-group">
                <label for="emailPersonneRessource">Email de personne ressource</label>
                <input type="text" class="form-control" id="emailPersonneRessource" placeholder="JaneDoe@email.com" name="emailPersonneRessource" value="{{ $utilisateur->emailPersonneRessource }}">
            </div>
            <div class="form-group">
                <label for="licenceRBQ">Licence RBQ</label>
                <input type="text" class="form-control" id="licenceRBQ" placeholder="12345-67891" name="licenceRBQ" value="{{ $utilisateur->licenceRBQ }}">
            </div>
            <div class="form-group">
                <label for="posteOccupeEntreprise">Poste occupé: </label>
                <input type="text" class="form-control" id="posteOccupeEntreprise" placeholder="testeur" name="posteOccupeEntreprise" value="{{ $utilisateur->posteOccupeEntreprise }}">
            </div>
            <div class="form-group">
                <label for="siteWeb">Site web de votre entreprise:</label>
                <input type="text" class="form-control" id="siteWeb" placeholder="site.web" name="siteWeb" value="{{ $utilisateur->siteWeb }}">
            </div>
            <div class="form-group">
                <label for="produitOuService">Produit ou Service: </label>
                <input type="text" class="form-control" id="produitOuService" placeholder="Produit" name="produitOuService" value="{{ $utilisateur->produitOuService }}">
            </div>
            <div class="form-group">
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



