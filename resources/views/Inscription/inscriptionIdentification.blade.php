<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title", "Inscription")</title>
        <link rel="stylesheet" href="{{ asset('css/inscription.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
            <form method="post" action="{{ route('Inscription.Produits') }}">
                @csrf
                <div class="container-fluid">
                    
                        <p class="col-12 text-center my-3 titre">Information de votre entreprise</p>
                        
                        <span class="sousTitres">Identification</span>                     
                        
                        <div class="mb-3 row">
                            <label for="entreprise" class="col-3" >Nom de l'entreprise :</label>
                            <input type="text" class="col-9" id="entreprise" placeholder="12345678910" name="entreprise" value="{{ old('entreprise') }}">
                        
                            @error('entreprise')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 row">
                            <label for="neq" class="col-3" >Numéro d'entreprise (NEQ) :</label>
                            <input type="text" class="col-9" id="neq" placeholder="12345678910" name="neq" value="{{ old('neq') }}">
                        
                            @error('neq')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                 
                        <span class="sousTitres">Authentification pour connexion</span> 
                        <div class="mb-3 row">
                            <label for="courrielConnexion" class="col-3" >Adresse courriel :</label>
                            <input type="text" class="col-9" id="courrielConnexion" placeholder="12345678910" name="courrielConnexion" value="{{ old('courrielConnexion') }}">
                        
                            @error('courrielConnexion')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 row">
                            <label for="mdp" class="col-3" >Choisir un mot de passe :</label>
                            <input type="text" class="col-9" id="mdp" placeholder="12345678910" name="mdp" value="{{ old('mdp') }}">
                        
                            @error('mdp')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 row">
                            <label for="mdpConf" class="col-3" >Confirmer mot de passe :</label>
                            <input type="text" class="col-9" id="mdpConf" placeholder="12345678910" name="mdpConf" value="{{ old('mdpConf') }}">
                        
                            @error('mdpConf')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="row d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mb-3 col-auto">Suivant</button>

                            <p class="text-center"> Vous êtes déjà inscrit? 
                                <a href="{{ route('Connexion.connexionEmail') }}">Se connecter</a> 
                            </p>
                        </div>
                    
                </div>
            </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
