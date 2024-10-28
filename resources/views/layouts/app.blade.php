<!DOCTYPE html>
<html lang="fr-CA">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pagePrincipale.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontStyle.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title> @yield('titre') </title>
</head>


<body>
    @if (auth()->user() !== null) 
    <div class="header">
        <div class="side-nav">
            <!--<div class="user">
                <img class="logo" src="../images/logoVilleTR.png" alt="logo-ville-TR">
            </div>-->
            <ul>
            @if (Auth::user()->role == 'responsable')
                <li class="soustitre"><a class="no-style-link" href="{{ route('Responsable.index') }}">Accueil</a></li>
                <li class="soustitre"><a class="no-style-link" href="{{route('Responsable.index')}}">Fournisseur actif</a></li>
                <li class="soustitre"><a class="no-style-link" href="{{route('Fournisseur.listeInscripton')}}">Demandes inscriptions</a></li>
            @elseif (Auth::user()->role == 'commis')
                <li class="soustitre"><a class="no-style-link" href="{{ route('Responsable.index') }}">Accueil</a></li>
                <li class="soustitre"><a class="no-style-link" href="{{route('Responsable.index')}}">Fournisseur actif</a></li>
                <li class="soustitre"><a class="no-style-link" href="{{route('Fournisseur.listeInscripton')}}">Demandes inscriptions</a></li>
            @elseif (Auth::user()->role == 'fournisseur')
                <li class="soustitre"><a class="no-style-link" href="{{ route('Fournisseur.index') }}">Accueil</a></li>
                <li class="soustitre"><a class="no-style-link" href="{{route('Fournisseur.fiche', [auth()->user()->id])}}">Ma fiche</a></li>
                <li class="soustitre"><a class="no-style-link">Contact support</a></li>
            @endif
            </ul>

            <ul>
                <li class="soustitre">
                    <a class="no-style-link" href="{{ route('logout.link')}}">Déconnexion</a>
                </li>
            </ul>
        </div>

        <div class="contenu">
            @yield('contenu')
        </div>
        
    </div>

    @else
        <p>Accès non authorisé</p>
        <a href="{{route('Connexion.connexionNEQ')}}">Retourner à la page de connexion</a>
    @endif
    <!--<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        @if (Auth::user()->role == 'responsable') 
            <a class="navbar-brand" href="{{ route('Responsable.index') }}">Navbar</a>
        @elseif (Auth::user()->role == 'admin')
            <a class="navbar-brand" href="{{ route('Responsable.index') }}">Navbar</a>
        @else
            <a class="navbar-brand" href="{{ route('Fournisseur.index') }}">Navbar</a>
        @endif

        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">

            @if (Auth::user()->role == 'responsable') 
                <a class="nav-link active" aria-current="page" href="{{ route('Responsable.index') }}">Home</a>
            @elseif (Auth::user()->role == 'admin')
                <a class="nav-link active" aria-current="page" href="{{ route('Responsable.index') }}">Home</a>
            @else
                <a class="nav-link active" aria-current="page" href="{{ route('Fournisseur.index') }}">Home</a>
            @endif

            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>-->

    <footer>
        </br>
        <p>Maxime Depont</p>
        <p>Isaac Béland-Desjardins</p>
        <p>Yohann Arnaud Nourredine Honliasso</p>
    </footer> 
</body>
</html>