<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<!--Vérifier modification?-->

<body>
    <h1>Modification</h1>
    <form method="POST" action="{{route('Fournisseur.modification', [$utilisateur]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="container-fluid" >
            <div class="form-group">
                <label for="NEQ">NEQ</label>
                <input type="text" class="form-control" id="neq" placeholder="NEQ" name="neq" value="{{$utilisateur->neq}}">
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" class="form-control" id="email" placeholder="email@email.com" name="email" value="{{ $utilisateur->email }}">
            </div>
            <div class="form-group">
                <label for="NomFournisseur">Nom Fournisseur</label>
                <input type="text" class="form-control" id="nomFournisseur" placeholder="nomFournisseur" name="nomFournisseur" value="{{ $utilisateur->nomFournisseur }}">
            </div>
            <div class="form-group">
                <label for="Adresse">Adresse</label>
                <input type="text" class="form-control" id="adresse" placeholder="adresse" name="adresse" value="{{$utilisateur->adresse}}">
            </div>
            <div class="form-group">
                <label for="noTelephone">Numéro de téléphone</label>
                <input type="text" class="form-control" id="noTelephone" placeholder="000-000-0000" name="noTelephone" value="{{$utilisateur->noTelephone}}">
            </div>
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
    </form>


</body>
</html>

