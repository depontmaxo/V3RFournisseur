<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pagePrincipale.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Index</title>
</head>
<body>
    <h1>Page Index Fournisseur</h1>

    
    <a href="{{route('Fournisseur.modification', [auth()->user()->id])}}">Modifier sa fiche fournisseur</a>
    </br>
    <a>Retirer sa fiche fournisseur</a>
    </br> 
    <a>Liste des contrats disponible (afficher sur la page)</a>
    </br>
    <a>Historique de mes contracts</a>
    </br>
    <a>Contact support</a>

</body>
</html>