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
    @if (auth()->user() != null) 
    <div class="header">
        <div class="side-nav">
            <!--<div class="user">
                <img class="logo" src="../images/logoVilleTR.png" alt="logo-ville-TR">
            </div>-->
            <ul>
            @if (Auth::user()->role == 'responsable')
                <li class="soustitre"><a class="no-style-link" href="{{ route('Fournisseur.index') }}">Accueil</a></li>
                <li class="soustitre"><a class="no-style-link" href="{{route('Responsable.listeFournisseur')}}">Fournisseur actif</a></li>
                <li class="soustitre"><a class="no-style-link" href="{{route('Fournisseur.listeInscripton')}}">Demandes inscriptions</a></li>
            @elseif (Auth::user()->role == 'commis')
                <li class="soustitre"><a class="no-style-link" href="{{ route('Fournisseur.index') }}">Accueil</a></li>
                <li class="soustitre"><a class="no-style-link" href="{{route('Responsable.listeFournisseur')}}">Fournisseur actif</a></li>
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
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Redirige vers la route Laravel
            window.location.href = "{{ route('Connexion.connexion') }}";
        });
        </script>
    @endif
    

    <footer>
        </br>
        <p>Maxime Depont</p>
        <p>Isaac Béland-Desjardins</p>
        <p>Yohann Arnaud Nourredine Honliasso</p>
    </footer> 

</body>
</html>