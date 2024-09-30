<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin</title>
    
    <!-- Lien vers le fichier CSS de Bootstrap via CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center">Tableau de bord de l'Administrateur</h1>
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Actions</th>
                    </tr> 
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            <a href="{{ route('gestion.userAdmin') }}">Gestion des Utilisateurs</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <a href="#">Gérer les paramètres du système</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <a href="#">Gérer les modèles de courriels</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Lien vers le fichier JavaScript de Bootstrap et jQuery via CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
