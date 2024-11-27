<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des paramètres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1E492D; /* Couleur de fond douce */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
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
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header text-center">
            <h5>(Admin)--Gestion des paramètres</h5>
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
                    <label for="appro_email" class="form-label">Courriel de l'Appro.</label>
                    <input type="email" class="form-control" id="appro_email" name="appro_email" value="{{ old('appro_email', $settings->appro_email) }}" required>
                </div>
                <div class="mb-3">
                    <label for="revision_delai" class="form-label">Délai avant la révision (mois)</label>
                    <input type="number" class="form-control" id="revision_delai" name="revision_delai" value="{{ old('revision_delai', $settings->revision_delai) }}" required>
                </div>
                <div class="mb-3">
                    <label for="max_file_size" class="form-label">Taille maximale des fichiers joints (Mo)</label>
                    <input type="number" class="form-control" id="max_file_size" name="max_file_size" value="{{ old('max_file_size', $settings->max_file_size) }}" required>
                </div>
                <div class="mb-3">
                    <label for="email_finance" class="form-label">Courriel des Finances</label>
                    <input type="email" class="form-control" id="email_finance" name="email_finance" value="{{ old('email_finance', $settings->email_finance) }}" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Modifier</button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
