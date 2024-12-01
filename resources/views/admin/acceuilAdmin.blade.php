<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil Admin</title>
    <!-- Import Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Import Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/fontStyle.css') }}">
    <style>
        body {
            background-color: #1E492D; /* Couleur de fond */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Disposer les éléments en colonne */
            height: 100vh; /* Prendre toute la hauteur de la fenêtre */
        }

        .navbar-custom {
            background-color: #1E492D; /* Couleur sombre */
            padding: 10px 0; /* Hauteur réduite de la navbar */
        }

    .navFont{
        font-family: 'Poppins-Light';
    }
        .navbar-brand {
            /**font-family: 'Poppins-Light';*/
            color: #fff;
            font-size: 24px;
        }

        .navbar-nav .nav-link {
            color: #fff;
            margin-right: 15px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #68B545;
        }

        /* Le conteneur principal pour centrer le contenu */
        .main-content {
            flex: 1; /* Prendre l'espace restant */
            display: flex;
            justify-content: center; /* Centrer horizontalement */
            align-items: center; /* Centrer verticalement */
            margin-top: 20px; /* Espacement entre la navbar et le contenu */
        }

        .container-cadre {
            background-color: #1E492D; /* Même couleur que le fond */
            padding: 40px;
            border: 0.01px solid gray; /* Bordure bleue */
            border-radius: 0px; /* Coins carrés */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px; /* Largeur maximale */
            text-align: center;
        }

        .btn-custom {
    width: 100%;
    font-family: 'Poppins-Light', sans-serif;
    margin: 15px 0;
    padding: 15px;
    font-size: 18px;
    border-radius: 0px; /* Coins carrés */
    transition: all 0.3s ease;
    background-color: transparent; /* Bouton transparent */
    color: white; /* Couleur du texte */
    border: 0.1px solid gray; /* Optionnel : bordure pour différencier */
}

.btn-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); /* Optionnel : effet au survol */
    background-color: rgba(255, 255, 255, 0.1); /* Légère couleur de fond au survol */
    border-color: transparent; /* Assure que la bordure ne change pas */
}



        .icon {
            margin-right: 10px;
        }

        .txtMaj {
            font-family: 'AlumniSans-ExtraBold', sans-serif;
            color: white;
            margin-bottom: 30px;
        }

        /* Media Queries pour les petits écrans */
        @media (max-width: 768px) {
            .navbar-custom {
                padding: 10px 0;
            }

            .navbar-nav .nav-link {
                font-size: 14px;
                margin-right: 10px;
            }

            .container-cadre {
                padding: 30px;
                max-width: 90%; /* Réduire la largeur sur les petits écrans */
            }

            .btn-custom {
                font-size: 16px;
                padding: 12px;
            }

            .txtMaj {
                margin-bottom: 20px;
                font-family: 'AlumniSans-ExtraBold';
                font-size: 32px;
            }
        }

        @media (max-width: 480px) {
            .navbar-brand {
                font-size: 20px; /* Réduire la taille du texte du brand */
            }

            .container-cadre {
                padding: 20px;
                max-width: 90%; /* Réduire encore plus la largeur sur les très petits écrans */
            }

            .btn-custom {
                font-size: 15px;
                padding: 10px;
            }

            .txtMaj {
                font-size: 18px;
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="color: white;"></span>
            </button>
            <div class="collapse navbar-collapse navFont" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class="fas fa-home"></i>Accueil</a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="main-content">
        <div class="container-cadre">
            <h2 class="txtMaj">Admin</h2>

            <!-- Bouton pour Gérer les modèles de courriel -->
            <a href="{{ route('GestionCourriel') }}" class="btn btn-primary btn-custom">
                <i class="fas fa-envelope icon"></i> Gérer les modèles de courriel
            </a>

            <!-- Bouton pour Ajouter, modifier ou supprimer un utilisateur -->
            <a href="{{ route('gestion.userAdmin') }}" class="btn btn-success btn-custom">
                <i class="fas fa-users-cog icon"></i> Ajouter, modifier ou supprimer un utilisateur
            </a>

            <!-- Bouton pour Gérer les paramètres du système -->
            <a href="{{ route('settings.index') }}" class="btn btn-warning btn-custom">
                <i class="fas fa-cogs icon"></i> Gérer les paramètres du système
            </a>
        </div>
    </div>

    <!-- Import Bootstrap Bundle avec JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
