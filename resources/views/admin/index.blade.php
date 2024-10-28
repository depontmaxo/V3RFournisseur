<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Bordures rouges discrètes pour le formulaire */
        .card {
            border: 1px solid rgba(255, 0, 0, 0.3); /* Rouge clair et moins visible */
        }

        /* Bouton avec bordures rouges et fond transparent */
        .btn-outline-red {
            color: black;
            border: 2px solid red;
            background-color: transparent;
        }

        /* Effet au survol (hover) */
        .btn-outline-red:hover {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Connexion Employé</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <!-- Adresse e-mail -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse e-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail" required>
                            </div>

                            <!-- Sélection du rôle -->
                            <div class="mb-3">
                                <label for="role" class="form-label">Rôle</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="" disabled selected>Choisissez votre rôle</option>
                                    <option value="Commis">Commis</option>
                                    <option value="Responsable">Responsable</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>

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
