<!DOCTYPE html>
<html lang="fr-CA">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pagePrincipale.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title> @yield('titre') </title>
</head>


<body>
<!-- Mettre la NavBar et toutes les entêtes du site ici -->

    @if (auth()->user() !== null) 
        @yield('contenu')
    @else
        <p>Accès non authorisé</p>
        <a href="{{route('Connexion.connexionNEQ')}}">Retourner à la page de connexion</a>
    @endif

    <footer>
        </br>
        <p>Maxime Depont</p>
        <p>Isaac Béland-Desjardins</p>
        <p>Yohann Arnaud Nourredine Honliasso</p>
    </footer> 
</body>
</html>