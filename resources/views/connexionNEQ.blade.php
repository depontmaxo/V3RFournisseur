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
        <header>
            <div>
                <h5 class="compagny">Fournisseur</h5>
            </div>
            <nav class="sub-nav">                
                <a>Créer un compte</a>  
            </nav>    
        </header>
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
                <a>Oublier votre mot de passe?</a>
            </div> 
        </form>

    </body>
</html>
