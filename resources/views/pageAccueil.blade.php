<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title", "Accueil")</title>
    <link rel="stylesheet" href="{{ asset('css/pageAccueil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontStyle.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        /* Style des boutons personnalisés */
        .btn-custom {
            background-color: #0B2341;
            color: white;
            font-family: 'TT Hoves Light', sans-serif;
            border: none;
            border-radius: 0;
            padding: 10px 20px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            border: 2px solid white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3); /* Ombre légère */
        }
        .btn-custom:hover {
            background-color: #78C6E0;
            color: white;
            transform: translateY(-2px); /* Légère remontée au survol */
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.5); /* Ombre plus marquée */
        }

        /* Positionnement du logo en haut à gauche avec un carré blanc autour */
        .logo-container {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: white; /* Fond blanc */
            padding: 10px; /* Espace autour du logo */
            border-radius: 5px; /* Coins légèrement arrondis */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Légère ombre pour le relief */
        }

        /* Positionnement des boutons en haut à droite */
        .top-right {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
        }

        /* Centrage du texte en haut de la page */
        .header-center {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-family: 'TT Hoves Light', sans-serif;
            color: #0B2341;
        }

        body{
        background-color:  #0B2341;
       }

       .welcome-message {
            position: absolute;
            top: 50%; /* Centre verticalement */
            left: 50%; /* Centre horizontalement */
            transform: translate(-50%, -50%); /* Ajuste la position */
            font-family: 'AlumniSans-ExtraBold', sans-serif;
            font-size: 2rem; /* Taille de la police */
            color: white; /* Couleur du texte */
            text-align: center; /* Centre le texte */
        }

    </style>
</head>
<body>
    <!-- Logo en haut à gauche entouré d'un carré blanc -->
    <div class="logo-container">
        <img src="{{ asset('images/v3r-logo-seul.svg') }}" alt="Logo V3R" width="80">
    </div>

    <!-- Boutons en haut à droite -->
    <div class="top-right">
        <a class="btn btn-custom" href="{{ route('Connexion.pageConnexion') }}">Se connecter</a>
        <a class="btn btn-custom" href="{{ route('Inscription.Identification') }}">Inscription</a>
    </div>

   
    <div class="welcome-message">
        <h2>Portail fournisseur V3R</h2>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
