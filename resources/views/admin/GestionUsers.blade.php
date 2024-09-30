<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <!-- Lien vers Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center">Gestion des utilisateurs</h3>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Utilisateur</th>
                <th scope="col">Rôle</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->email }}</td>
                <td>
                    <select class="form-control">
                        <option value="Administrateur">Administrateur</option>
                        <option value="Commis">Commis</option>
                        <option value="Responsable">Responsable</option>
                    </select>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="d-flex justify-content-between mt-3">
        <button class="btn btn-success">Ajouter</button>
        <button class="btn btn-danger">Supprimer</button>
        <button class="btn btn-primary">Enregistrer les modifications</button>
        <button class="btn btn-secondary">Annuler</button>
    </div>
</div>

<!-- Lien vers jQuery et Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
