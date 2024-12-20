<!DOCTYPE html>
<html lang="fr-CA">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="{{ asset('css/pagePrincipale.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/statutDemande.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    <!-- Page-specific styles -->
    @stack('styles')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title> @yield('titre') </title>
</head>


<body>
    @if (auth()->user() != null || auth()->guard('user')->user() != null) 

    
    @if(session('message'))
        <div class="alert alert-success message">
            {{ session('message') }}
        </div>
    @endif

    <div class="header">
        <!-- Sidebar Menu (default for large screens) -->
        <div class="side-nav" id="sideNav">
            <ul class="menuList">
                @if (Auth::guard('web')->check())
                    <li class="soustitre"><a class="no-style-link" href="{{ route('Fournisseur.index') }}"><i class="fa fa-home"></i> Accueil</a></li>
                    <li class="soustitre"><a class="no-style-link" href="{{route('Fournisseur.fiche', [auth()->user()->id])}}"><i class="fa fa-id-card"></i> Ma fiche</a></li>
                    <li class="soustitre"><a class="no-style-link" href="{{route('Fournisseur.statut', [auth()->user()->id])}}"><i class="fa fa-check-circle"></i> Statut demande</a></li>
                    <li class="soustitre"><a class="no-style-link" href="https://www.v3r.net/nous-joindre"><i class="fa fa-headset"></i> Contacter support</a></li>
                @elseif (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'responsable')
                    <li class="soustitre"><a class="no-style-link" href="{{ route('Responsable.index') }}"><i class="fa fa-home"></i> Accueil</a></li>
                    <!--Redondance qui n'est plus utiliser-->
                    <!--<li class="soustitre"><a class="no-style-link" href="{{route('Responsable.listeFournisseur')}}"><i class="fa fa-warehouse"></i> Fournisseur actif</a></li>-->
                    <li class="soustitre"><a class="no-style-link" href="{{route('Responsable.listeInscripton')}}"><i class="fa fa-user-check"></i> Demandes inscriptions</a></li>
                    <li class="soustitre"><a class="no-style-link" href="{{route('EnvoiMailResp')}}"><i class="fa fa-envelope"></i> Envoyer une réponse</a></li>
                @elseif (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'commis')
                    <li class="soustitre"><a class="no-style-link" href="{{ route('Responsable.index') }}"><i class="fa fa-home"></i> Accueil</a></li>
                    <li class="soustitre"><a class="no-style-link" href="{{route('Responsable.listeFournisseur')}}"><i class="fa fa-warehouse"></i> Fournisseur actif</a></li>
                @endif
            </ul>

            <ul class="menuList">
                <li class="soustitre">
                    <a class="no-style-link" href="{{ route('logout')}}"><i class="fa fa-sign-out-alt"></i> Déconnexion</a>
                </li>
            </ul>
        </div>

        <!-- Horizontal Menu for Small Screens (Mobile View) -->
        <div class="mobile-nav">
            <ul class="menuList">
                @if (Auth::guard('web')->check())
                    <li><a class="no-style-link" href="{{ route('Fournisseur.index') }}"><i class="fa fa-home"></i></a></li>
                    <li><a class="no-style-link" href="{{route('Fournisseur.fiche', [auth()->user()->id])}}"><i class="fa fa-id-card"></i></a></li>
                    <li><a class="no-style-link" href="{{route('Fournisseur.statut', [auth()->user()->id])}}"><i class="fa fa-check-circle"></i></a></li>
                    <li><a class="no-style-link" href="https://www.v3r.net/nous-joindre"><i class="fa fa-headset"></i></a></li>
                @elseif (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'responsable')
                    <li><a class="no-style-link" href="{{ route('Fournisseur.index') }}"><i class="fa fa-home"></i></a></li>
                    <li><a class="no-style-link" href="{{route('Responsable.listeFournisseur')}}"><i class="fa fa-warehouse"></i></a></li>
                    <li><a class="no-style-link" href="{{route('Responsable.listeInscripton')}}"><i class="fa fa-user-check"></i></a></li>
                @elseif (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'commis')
                    <li><a class="no-style-link" href="{{ route('Fournisseur.index') }}"><i class="fa fa-home"></i></a></li>
                    <li><a class="no-style-link" href="{{route('Responsable.listeFournisseur')}}"><i class="fa fa-warehouse"></i></a></li>
                @endif
                <li><a class="no-style-link" href="{{ route('logout.link')}}"><i class="fa fa-sign-out-alt"></i></a></li>
            </ul>
        </div>

        <!-- Main content area -->
        <div class="contenu">
            @yield('contenu')
        </div>
    </div>




        <div class="contenu">
            <footer class="footer">
                <div class="footer-container">
                    <!-- Left Column - Contact Info and Logo -->
                    <div class="footer-column left-column">
                        <div class="logo">
                            <img src="{{ asset('images/v3r-logo-seul.svg') }}" alt="Ville de Trois-Rivières Logo">
                        </div>
                        <div class="contact-info">
                            <p class="texte"><strong>Ville de Trois-Rivières</strong></p>
                            <p class="texte">1325, place de l'Hôtel-de-Ville, C.P. 368</p>
                            <a class="texte no-color-link" href="https://www.google.ca/maps/place/H%C3%B4tel+de+ville/@46.3430042,-72.545511,17z/data=!4m12!1m6!3m5!1s0x41aa0c6a9ae1712b:0xc5f7bf52c7282858!2sH%C3%B4tel+de+ville!8m2!3d46.3430005!4d-72.5433223!3m4!1s0x41aa0c6a9ae1712b:0xc5f7bf52c7282858!8m2!3d46.3430005!4d-72.5433223">Trois-Rivières, QC G9A 5H3</a>
                            <p class="texte">Téléphone : 311 ou 819 374-2002</p>
                            <p class="texte">Canada ou États-Unis : 1 833 374-2002</p>
                            <p class="texte">Courriel : <a href="mailto:311@v3r.net">311@v3r.net</a></p>
                        </div>
                    </div>
                    
                    <!-- Center Column - Useful Links -->
                    <div class="footer-column center-column">
                        <ul>
                            <li><a class="texte" href="https://www.v3r.net/nous-joindre">> Nous joindre</a></li>
                            <li><a class="texte" href="#">> Guide d'utilisation</a></li>
                        </ul>
                    </div>
                    
                    <!-- Right Column - Copyright -->
                    <div class="footer-column right-column">
                        <p class="texte">© Ville de Trois-Rivières. Tous droits réservés.</p>
                    </div>
                </div>
            </footer>
        </div>
        
    @else
        <p>Accès non authorisé</p>
        <script>
            window.location.href = '{{ route("page.Accueil") }}'; // Redirect to a specific route
        </script>
    @endif
    
    <script>
        function toggleSidebar() {
            const sideNav = document.getElementById('sideNav');
            sideNav.classList.toggle('collapsed');
        }
    </script>
    <script src="https://kit.fontawesome.com/b3e71547f0.js" crossorigin="anonymous"></script>
</body>
</html>