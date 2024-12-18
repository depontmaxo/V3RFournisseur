<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des paramètres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/fontStyle.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- Import de FontAwesome -->
    <style>
        body {
            background-color: #1E492D; /* Couleur de fond douce */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }
        .card {
            border: 2px solid #343a40; /* Bordures carrées sombres */
            border-radius: 0; /* Pas d'arrondi */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre discrète */
            max-width: 500px; /* Taille maximale de la carte */
            width: 100%; /* S'adapte à la taille de l'écran */
        }
        .card-header {
            background-color: #68B545; /* Couleur d'en-tête sombre */
            color: #ffffff; /* Texte blanc */
            text-transform: uppercase; /* Texte en majuscules */
            font-weight: bold;
        }
        .btn-primary {
            background-color: #68B545; /* Couleur du bouton */
            border: none;
        }
        .btn-primary:hover {
            background-color: #1E492D; /* Couleur au survol */
        }
        .titre {
            font-family: 'AlumniSans-ExtraBold';
            font-size: 32px;
        }

        .txtcourant {
            font-family: 'Poppins-Medium'; 
        }

        .txtcourant1 {
            font-family: 'Poppins-Light';
            color: #1E492D;
        }

        .btn-with-icon {
            display: block;  /* Assure que le bouton est un élément de bloc */
            margin: 20px auto; /* Centrer le bouton horizontalement avec un espace autour */
            background-color: #68B545;
            color: white;
            border: none;
            padding: 12px 24px;  /* Réduit l'espace interne pour un bouton plus petit */
            font-size: 20px; /* Taille du texte plus petite */
            width: auto;  /* Ajuste la largeur du bouton à son contenu */
            border-radius: 0;  /* Bordure carrée */
            transition: background-color 0.3s ease;
            font-family: 'AlumniSans-ExtraBold'; /* Police identique au titre */
        }

        .btn-with-icon:hover {
            background-color: #1E492D;
        }

        .btn-with-icon i {
            margin-right: 10px; /* Espace entre l'icône et le texte */
        }

        /* Nouveau style pour le bouton de retour */
        .btn-back {
            position: absolute; /* Position absolue pour placer en haut à gauche */
            top: 20px; /* Distance du haut */
            left: 20px; /* Distance de la gauche */
            background-color: transparent; /* Fond transparent */
            border: 1px solid gray; /* Bordure verte */
            color: white; /* Texte de couleur verte */
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 1px; /* Bordure arrondie pour un style plus doux */
            display: flex;
            align-items: center;
            text-decoration: none; /* Enlever le soulignement */
            transition: all 0.3s ease; /* Transition pour un effet fluide */
            font-family: 'Poppins-Light'; /* Appliquer la même police que pour le contenu de la carte */
        }

        .btn-back:hover {
            background-color: #E5004D; /* Couleur de fond au survol */
            color: white; /* Texte en blanc au survol */
            border-color: #E5004D; /* Bordure verte au survol */
        }

        .btn-back i {
            margin-right: 8px; /* Espacement entre l'icône et le texte */
        }
    </style>
</head>
<body>
    <!-- Bouton retour en haut à gauche -->
    <a href="{{ route('admin.index') }}" class="btn btn-light btn-back">
        <i class="fas fa-arrow-left"></i>Retour
    </a>

    <div class="card">
        <div class="card-header text-center">
            <h5 class="titre">Gestion des paramètres</h5>
        </div>
        <div class="card-body">
            <!-- Affichage des erreurs de validation -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('settings.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="appro_email" class="form-label txtcourant">Courriel de l'Appro.</label>
                    <input type="email" class="form-control txtcourant1" id="appro_email" name="appro_email" value="{{ old('appro_email', $settings->appro_email) }}" required>
                </div>
                <div class="mb-3">
                    <label for="revision_delai" class="form-label txtcourant">Délai avant la révision (mois)</label>
                    <input type="number" class="form-control txtcourant1" id="revision_delai" name="revision_delai" value="{{ old('revision_delai', $settings->revision_delai) }}" required>
                </div>
                <div class="mb-3">
                    <label for="max_file_size" class="form-label txtcourant">Taille maximale des fichiers joints (Mo)</label>
                    <input type="number" class="form-control txtcourant1" id="max_file_size" name="max_file_size" value="{{ old('max_file_size', $settings->max_file_size) }}" required>
                </div>
                <div class="mb-3">
                    <label for="email_finance" class="form-label txtcourant">Courriel des Finances</label>
                    <input type="email" class="form-control txtcourant1" id="email_finance" name="email_finance" value="{{ old('email_finance', $settings->email_finance) }}" required>
                </div>
                <!-- Bouton avec l'icône, police identique au titre, et bord carré -->
                <button type="submit" class="btn-with-icon">
                    <i class="fas fa-save"></i>Sauvegarder 
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
