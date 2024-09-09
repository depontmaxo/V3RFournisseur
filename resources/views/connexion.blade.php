<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title", "Connexion")</title>
        <link rel="stylesheet" href="{{ asset('css/inscription.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
        </div>
    @endif
    @if(session('message'))
        <div class="alert alert-success">
            <p>{{ session('message') }}</p>
        </div>
    @endif
        <!--<header>
            <div>
                <h5 class="compagny">Fournisseur</h5>
            </div>
            <nav class="sub-nav">                
                <a href="{{route('Inscription.formulaireInscription')}}">Envoyer un formulaire d'inscription</a>  
            </nav>    
        </header>
        <div class="container-fluid text-center">
            <h1 class="titre2">Connexion</h1>
        </div>
        <form method="post" action="{{ route('Connexion.connexion') }}">
            @csrf
            <div class="d-flex row justify-content-center py-5">
                <div class="form-group">
                <label for="email" class="titre2">Email</label>
                <input type="email" class="form-control" id="email" placeholder="email" name="email">
                </div>
                <a href="{{route('Connexion.connexionNEQ')}}">Inscrit avec le NEQ, cliquez ici!</a> 
                <div class="d-flex row justify-content-center">
                    <div class="form-group">
                        <label for="password" class="titre2">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="password" name="password">
                    </div> 
                </div> 
                <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary">Connexion</button>
                </div> 
                <a>Oublier votre mot de passe?</a>
            </div> 
        </form>
        -->
        <div>
            <form method="post" action="{{ route('Connexion.connexion') }}">
                @csrf
                <div class="container">
                    <div>
                        <p class="col-12 text-center my-3 titre">Connexion au portail des fournisseurs</p>

                        <div class="mb-3 row">
                            <label for="email" class="col-3" >Courriel :</label>
                            <input type="text" class="col-9" id="email" placeholder="exemple@gmail.com" name="email">
                        </div>

                        <a href="{{route('Connexion.connexionNEQ')}}">Se connecter avec NEQ</a> 

                        <div class="mb-3 row">
                            <label for="password" class="col-3">Mot de passe :</label>
                            <input type="password" class="col-9" id="password" placeholder="Entrez votre mot de passe" name="password">
                        </div>

                        <div class="row d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary my-4 col-auto">Se connecter</button>
                            <p class="text-center"> Vous n'êtes pas inscrit? 
                                <a href="{{route('Inscription.formulaireInscription')}}">Formulaire inscription</a> 
                            </p>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
