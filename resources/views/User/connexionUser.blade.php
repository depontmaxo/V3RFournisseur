<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fontStyle.css') }}">
    <style>
        /* Couleur de fond du site */
        body {
            background-color: #0B2341; /* Couleur de fond de la page */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Limite de la largeur du formulaire */
        .form-width {
            max-width: 400px;
            width: 100%;
        }

        /* Style du formulaire */
        .card {
            background-color: #ED8C00; /* Couleur de fond du formulaire */
            border: 1px solid rgba(255, 0, 0, 0.3);
            border-radius: 0;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Style des champs d'entrée */
        .form-control, .form-select {
            border-radius: 0;
            border: 1px solid #333;
        }

        /* Bouton stylisé */
        .btn-outline-red {
            color: black;
            border: 2px solid red;
            background-color: transparent;
        }

        .btn-outline-red:hover {
            background-color: red;
            color: white;
        }

        /* Style de la liste déroulante */
        .form-select {
            background-color: #f8f9fa;
            font-size: 16px;
            padding: 8px 12px;
            color: #333;
        }

        /* Style du titre */
        .txtTitre {
            font-family: 'AlumniSans-ExtraBold', sans-serif;
        }

        .form-select:focus {
            border-color: red;
            box-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
            outline: none;
        }
    </style>
</head>
<body>
    <div class="container form-width">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center txtTitre">
                        <h4>Connexion Employé</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('employeConnecte') }}" method="POST">
                            @csrf
                            <!-- Adresse e-mail -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse e-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail" required>
                            </div>

                            <!-- Sélection du rôle -->
                           <!--  <div class="mb-3">
                                <label for="role" class="form-label">Rôle</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="" disabled selected>Choisissez votre rôle</option>
                                    <option value="Commis">Commis</option>
                                    <option value="Responsable">Responsable</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div> -->

                            <!-- Gestion des erreurs (facultatif) -->
                            <div id="error-message" class="alert alert-danger d-none">
                                Une erreur s'est produite. Veuillez réessayer.
                            </div>

                            <!-- Bouton de soumission -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-outline-red">Se connecter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
