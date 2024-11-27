<!DOCTYPE html>
<html lang="fr-CA">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/fontStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inscription.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    @stack('styles')  <!-- Pour les styles spécifiques de la page -->
    <title> @yield('titre') </title>
</head>
<body>
    <!-- Logo et boutons -->
    <div class="header">
        <div class="logo-container">
            <img src="{{ asset('images/v3r-logo-seul.svg') }}" alt="Logo V3R" width="80">
        </div>

        <div class="top-right">
            <a class="btn btn-custom" href="{{ route('Connexion.pageConnexion') }}">Accueil</a>
            <a class="btn btn-custom" href="{{ route('Connexion.pageConnexion') }}">Se connecter</a>
            <a class="btn btn-custom" href="{{ route('Inscription.Identification') }}">Contacter support</a>
        </div>

        <!-- Contenu de la page -->
        <div class="contenu">
            @yield('contenu')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column left-column">
                <div class="logo">
                    <img src="{{ asset('images/v3r-logo-seul.svg') }}" alt="Ville de Trois-Rivières Logo">
                </div>
                <div class="contact-info">
                    <p><strong>Ville de Trois-Rivières</strong></p>
                    <p>1325, place de l'Hôtel-de-Ville, C.P. 368</p>
                    <a href="https://www.google.ca/maps/place/H%C3%B4tel+de+ville/">Trois-Rivières, QC G9A 5H3</a>
                    <p>Téléphone : 311 ou 819 374-2002</p>
                    <p>Canada ou États-Unis : 1 833 374-2002</p>
                    <p>Courriel : <a href="mailto:311@v3r.net">311@v3r.net</a></p>
                </div>
            </div>
            <div class="footer-column center-column">
                <ul>
                    <li><a href="https://www.v3r.net/nous-joindre">Nous joindre</a></li>
                    <li><a href="#">Guide d'utilisation</a></li>
                </ul>
            </div>
            <div class="footer-column right-column">
                <p>© Ville de Trois-Rivières. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b3e71547f0.js" crossorigin="anonymous"></script>
</body>
</html>
