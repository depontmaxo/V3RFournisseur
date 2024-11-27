<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title", "Accueil")</title>
    
    <link rel="stylesheet" href="{{ asset('css/fontStyle.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/pageAccueil.css') }}">
    @stack('styles')
    <title> @yield('titre') </title>
</head>
<body>
    <!-- Logo en haut à gauche entouré d'un carré blanc -->
    <div class="logo-container">
        <img src="{{ asset('images/v3r-logo-seul.svg') }}" alt="Logo V3R" width="80">
    </div>

    <!-- Boutons en haut à droite -->
    <div class="top-right">
        <button class="btn btn-custom2" onclick="openLoginForm()">Se connecter</button>
        <a class="btn btn-custom2" href="{{ route('Inscription.Identification') }}">Inscription</a>
    </div>

    
    <div class="welcome-message">
        @yield('contenu')
    </div>
    
    <script src="https://kit.fontawesome.com/b3e71547f0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
