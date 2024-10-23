<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Amélioré</title>
    <!-- Lien vers Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b70424hT7SYkC1OgzlSRP+IlRH9sENBO0LR" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Couleur de fond légère */
        }

        .form-container {
            border: 2px solid red; /* Bordures rouges */
            padding: 40px; /* Plus d'espace interne */
            border-radius: 15px; /* Arrondir encore plus les coins */
            max-width: 500px;
            margin: 100px auto;
            background-color: white; /* Fond blanc pour contraste */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Ombre subtile */
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #dc3545; /* Rouge Bootstrap */
        }

        .btn-custom {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .btn-custom:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <h2>Inscription</h2>
            <form>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom">
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" placeholder="Entrez votre prénom">
                </div>
                <div class="mb-3">
                    <label for="sexe" class="form-label">Sexe</label>
                    <select class="form-select" id="sexe">
                        <option selected disabled>Choisissez...</option>
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-custom w-100">Soumettre</button>
            </form>
        </div>
    </div>

    <!-- Lien vers Bootstrap JS (optionnel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93zZqG9936Is3nOe0gxC70Vb2OmQ1pMaM2L6iE9EvsOVjO0tZX2oF6pG1KBr2J" crossorigin="anonymous"></script>
</body>
</html>
