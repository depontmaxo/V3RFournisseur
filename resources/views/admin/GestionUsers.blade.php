<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <!-- Lien vers Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Lien vers Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Ajout du token CSRF -->
    <style>
        .add-user-btn-container {
            position: absolute;
            top: 15px;
            right: 15px;
        }

    </style>
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center">Page-Admin (gestion des utilisateurs)</h3>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Utilisateur</th>
                <th scope="col">Rôle</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td> <!-- Rôle affiché directement -->
                <td>
                    <button class="btn btn-info btn-sm btn-edit" data-id="{{ $user->id }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Bouton pour ajouter un utilisateur dans le coin supérieur droit -->
    <div class="add-user-btn-container">
        <button class="btn btn-success" data-toggle="modal" data-target="#addUserModal">
            <i class="fas fa-plus"></i> Ajouter un utilisateur
        </button>
    </div>

    <!-- Modale Bootstrap -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Ajouter un utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        <div class="form-group">
                            <label for="email">Adresse e-mail</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Entrez l'adresse e-mail" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Rôle</label>
                            <select id="role" name="role" class="form-control" required>
                                <option value="admin">Administrateur</option>
                                <option value="commis">Commis</option>
                                <option value="responsable">Responsable</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Entrez le mot de passe" required>
                        </div>

                        <button type="button" class="btn btn-primary" id="saveUserButton">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Lien vers jQuery complet et Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Fonctionnalité du bouton Modifier
    $(document).on('click', '.btn-edit', function() {
        var userId = $(this).data('id'); // Récupérer l'ID de l'utilisateur
        var row = $(this).closest('tr'); // Récupérer la ligne de l'utilisateur

        // Récupérer les données actuelles
        var email = row.find('td').first().text();
        var role = row.find('.user-role').val();

        // Afficher une modale ou une alerte pour modifier (vous pouvez personnaliser ici)
        var newEmail = prompt("Modifier l'adresse e-mail :", email);
        if (newEmail !== null && newEmail !== email) {
            row.find('td').first().text(newEmail); // Mettre à jour l'email dans la table
        }
        alert("Vous pouvez également modifier le rôle directement.");
    });

    // Fonctionnalité du bouton Supprimer
    $(document).on('click', '.btn-delete', function() {
        var userId = $(this).data('id');
        var row = $(this).closest('tr');

        if (!userId) {
            alert("ID utilisateur invalide");
            return;
        }

        if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
            $.ajax({
                url: '/users/' + userId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        row.remove();
                        alert('Utilisateur supprimé avec succès.');
                    } else {
                        alert('Utilisateur non trouvé.');
                    }
                },
                error: function(xhr) {
                    alert('Erreur lors de la suppression de l\'utilisateur.');
                }
            });
        }
    });

    // Gestion du clic sur le bouton Ajouter
    $('#saveUserButton').click(function() {
        var email = $('#email').val();
        var role = $('#role').val();
        var password = $('#password').val();  // Assurez-vous d'ajouter un champ pour le mot de passe

        // Vérifier que tous les champs sont remplis
        if (!email || !role || !password) {
            alert("Tous les champs sont requis !");
            return;
        }

        $.ajax({
            url: '/users',  // URL de votre route pour l'ajout d'un utilisateur
            method: 'POST',
            data: {
                email: email,
                role: role,
                password: password,
                _token: $('meta[name="csrf-token"]').attr('content')  // CSRF Token
            },
            success: function(response) {
                if (response.success) {
                    alert('Utilisateur ajouté avec succès');
                    // Ajouter une ligne au tableau
                    var newRow = `
                        <tr>
                            <td>${email}</td>
                            <td>${role}</td>
                            <td>
                                <button class="btn btn-info btn-sm btn-edit" data-id="${response.id}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm btn-delete" data-id="${response.id}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>`;
                    $('table tbody').append(newRow);
                    $('#addUserModal').modal('hide');
                    $('#email').val('');
                    $('#role').val('');
                    $('#password').val('');  // Réinitialiser le mot de passe
                } else {
                    alert('Erreur lors de l\'ajout de l\'utilisateur');
                }
            },
            error: function(xhr) {
                alert('Erreur : ' + xhr.responseJSON.message);
            }
        });
    });
</script>

</body>
</html>
