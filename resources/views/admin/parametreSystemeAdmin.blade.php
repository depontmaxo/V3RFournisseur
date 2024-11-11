<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Gestion des Paramètres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Card pour le formulaire -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="text-center">Gestion des paramètres</h4>
        </div>
        <div class="card-body">
            <form>
                <!-- Champ pour le premier courriel -->
                <div class="mb-3">
                    <label for="email1" class="form-label">Courriel de l'approvisionnement</label>
                    <input type="email" class="form-control" id="email1" placeholder="Entrez un courriel" required>
                </div>

                <!-- Champ pour le délai avant la révision -->
                <div class="mb-3">
                    <label for="delai" class="form-label">Délai avant la révision (nombre de mois)</label>
                    <input type="number" class="form-control" id="delai" placeholder="Entrez le nombre de mois" min="1" required>
                </div>

                <!-- Champ pour la taille maximale des fichiers joints -->
                <div class="mb-3">
                    <label for="tailleMax" class="form-label">Taille maximale des fichiers joints (Mo)</label>
                    <input type="number" class="form-control" id="tailleMax" placeholder="Entrez la taille en Mo" min="1" required>
                </div>

                <!-- Champ pour le second courriel -->
                <div class="mb-3">
                    <label for="email2" class="form-label">Courriel des finances</label>
                    <input type="email" class="form-control" id="email2" placeholder="Entrez un autre courriel" required>
                </div>

                <!-- Bouton de soumission -->
                <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
