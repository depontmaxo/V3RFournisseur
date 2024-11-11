<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <!-- Lien vers Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Ajout du token CSRF -->
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center"> Page-Admin (gestion des utilisateurs)</h3>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Utilisateur</th>
                <th scope="col">Rôle</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->email }}</td>
                <td>
                    <div class="form-group">
                        <select class="form-control user-role" data-id="{{ $user->id }}">
                            <option value="Administrateur" {{ $user->role == 'Administrateur' ? 'selected' : '' }}>
                                Administrateur
                            </option>
                            <option value="Commis" {{ $user->role == 'Commis' ? 'selected' : '' }}>
                                Commis
                            </option>
                            <option value="Responsable" {{ $user->role == 'Responsable' ? 'selected' : '' }}>
                                Responsable
                            </option>
                        </select>
                    </div>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}">Supprimer</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="d-flex justify-content-between mt-3">
        <button class="btn btn-primary">Enregistrer les modifications</button>
        <button class="btn btn-secondary">Annuler</button>
    </div>
</div>

<!-- Lien vers jQuery complet et Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Récupérer le token CSRF
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Gestion du clic sur le bouton Supprimer
        $('.btn-delete').click(function() {
            var userId = $(this).data('id'); // Récupérer l'ID de l'utilisateur
            var row = $(this).closest('tr'); // Récupérer la ligne du tableau
            
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                // Envoyer une requête AJAX pour supprimer l'utilisateur
                $.ajax({
                    url: '/users/' + userId, // URL pour la suppression de l'utilisateur
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Ajouter le token CSRF dans les en-têtes
                    },
                    success: function(result) {
                        // Supprimer la ligne du tableau si la suppression est réussie
                        row.remove();
                        alert('Utilisateur supprimé avec succès.');
                    },
                    error: function(xhr) {
                        // Gérer les erreurs
                        alert('Erreur lors de la suppression de l\'utilisateur.');
                    }           
                });
            }  
        });

        // Gestion du clic sur le bouton Enregistrer les modifications
        $('.btn-primary').click(function() {
            var roles = [];

            // Récupérer les informations des rôles sélectionnés pour chaque utilisateur
            $('.user-role').each(function() {
                var userId = $(this).data('id');
                var role = $(this).val();
                roles.push({ id: userId, role: role });
            });

            // Envoyer les modifications au serveur
            $.ajax({
                url: '/users/update-roles', // URL de mise à jour des rôles
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Ajouter le token CSRF dans les en-têtes
                },
                data: { roles: roles },
                success: function(result) {
                    alert('Les rôles ont été mis à jour avec succès.');
                },
                error: function(xhr) {
                    alert('Erreur lors de la mise à jour des rôles.');
                }
            });
        });
    });
</script>

</body>
</html>
