<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title", "Page accueil")</title>
        <link rel="stylesheet" href="{{ asset('css/pageAccueil.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontStyle.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
        </style>
    </head>
    <body>
        <div class="parallelogram">
            <div class="container">
                <h1 class="titre-extrabold message d-flex justify-content-center">Portail fournisseur de Trois-Rivières</h1>
                <p class="texte info d-flex justify-content-center">Pour vous connecter ou envoyer un formulaire d'inscription, veuillez choisir l'une des options suivantes</p>
                <div class="py-4 d-flex justify-content-center">
                    <a class="btn btn-primary mb-3 col-3 precedent" href="{{ route('Connexion.connexionEmail') }}">Se connecter</a>
                    <a class="btn btn-primary mb-3 col-3 offset-2 precedent" href="{{ route('Inscription.Identification') }}">Inscription</a>
                </div>
            </div>
        </div>

        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
