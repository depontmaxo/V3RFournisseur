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
    <!--
        <div class="container-fluid text-center">
            <h1 class="titre2">Connexion</h1>
        </div>
        <form method="post" action="{{ route('Connexion.connexion') }}">
            @csrf
            <div class="d-flex row justify-content-center py-5">
                <div class="form-group">
                <label for="neq" class="titre2">NEQ</label>
                <input type="text" class="form-control" id="neq" placeholder="00000000000" name="neq">
                </div>
                <a href="{{route('Connexion.connexionEmail')}}">Pas de NEQ, cliquez ici pour vous connecter avec un email!</a> 
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
                <a href="­{{route('ShowMotPasseOublie')}}">Mot De passe oublie?</a>
            </div> 
        </form>
    -->

    <form method="post" action="{{ route('Connexion.connexion') }}">
        @csrf
        <div class="container">
            <div>
                <p class="col-12 text-center my-3 titre">Connexion par NEQ</p>

                <div class="mb-3 row">
                    <label for="neq" class="col-3" >NEQ :</label>
                    <input type="text" class="col-9" id="neq" placeholder="12345678910" name="neq">
                </div>

                <div class="mb-3 row">
                    <label for="password" class="col-3">Mot de passe :</label>
                    <input type="password" class="col-9" id="password" placeholder="Entrez votre mot de passe" name="password">
                </div>

                <div class="row d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary my-4 col-auto">Se connecter</button>
                    <p class="text-center"> Vous n'êtes pas inscrit? 
                        <a href="{{route('Inscription.formulaireInscription')}}">Formulaire inscription</a> 
                    </p>

                    <p class="text-center">Pas de code NEQ pour la connexion? 
                        <a href="{{route('Connexion.connexionEmail')}}">Se connecter par courriel</a> 
                    </p>
                </div>
            </div>
        </div>
    </form>

    </body>
</html>