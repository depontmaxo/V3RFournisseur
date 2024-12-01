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
            background-color: #0B2341; /* Couleur de fond */
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container-cadre {
            background-color: #0B2341; /* Même couleur que le fond */
            padding: 40px;
            border: 3px solid #007bff; /* Bordure bleue */
            border-radius: 0px; /* Coins carrés */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 500px;
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
        }

        .btn-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .icon {
            margin-right: 10px;
        }

        .txtMaj {
            font-family: 'AlumniSans-ExtraBold', sans-serif;
            color: white; 
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container-cadre">
        <h2 class="txtMaj">Bienvenue Admin!</h2>

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
        
        <a class="no-style-link" href="{{ route('logout')}}"><i class="fa fa-sign-out-alt"></i> Déconnexion</a>
    </div>

    <!-- Import Bootstrap Bundle avec JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
