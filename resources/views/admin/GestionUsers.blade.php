@if (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'admin')
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
        <link rel="stylesheet" href="{{asset('css/fontStyle.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Ajout du token CSRF -->
        <style>
            .user-card {
                border: 1px solid #ddd;
                margin-bottom: 15px;
                padding: 10px;
                border-radius: 0; /* Change from 5px to 0 to remove rounded corners */
                font-family: 'Poppins-Light'; /* Apply Poppins font */
                background-color:white;
                color: #000000; /* Couleur du texte noire pour contraste */
            }
            .user-card .user-info {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .user-card .btn-group {
                display: flex;
                justify-content: flex-start;
                gap: 10px; /* Espace entre les boutons */
            }
            .add-user-btn-container {
                position: absolute;
                top: 15px;
                right: 15px;
                font-family:'Poppins-Light';
            }
            body {
                background-color: #1E492D; 
                font-family: 'Poppins-Light', sans-serif;
                color: white; 
            }

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

            .modal-content {
                background-color: #2C5F3D; /* Couleur de fond adaptée */
                color: white; /* Assurez-vous que le texte est visible */
            }

            .modal-header, .modal-body {
                color: white; /* Texte en blanc */
            }

            .form-control {
                background-color: #204A31; /* Fond des champs de formulaire */
                color: white; /* Couleur du texte */
            }

            .form-control::placeholder {
                color: #d3d3d3; /* Placeholder lisible */
            }

            .custom-close-btn {
                background-color: transparent; /* Fond transparent */
                color: red; /* Couleur rouge pour le symbole */
                border: none; /* Pas de bordure */
                font-size: 24px; /* Taille du symbole */
                padding: 0; /* Pas d'espacement interne */
                cursor: pointer; /* Curseur en forme de main */
                position: absolute; /* Positionnement absolu */
                top: 10px; /* Ajustez la position selon vos besoins */
                right: 10px; /* Ajustez la position selon vos besoins */
            }

            .custom-close-btn:hover {
                color: #ff0000; /* Rouge vif au survol */
                transform: scale(1.1); /* Légère augmentation de taille au survol */
            }

            .btn-transparent {
                background-color: transparent; /* Fond transparent */
                border: 1px solid white; /* Bordure blanche */
                color: white; /* Texte blanc */
                padding: 10px 20px; /* Espacement interne */
                font-size: 16px; /* Taille de la police */
                border-radius: 0px; /* Coins arrondis */
                transition: all 0.3s ease; /* Transition pour un effet fluide */
                font-family: 'Poppins-Light', sans-serif; /* Police personnalisée */
            }

            .btn-transparent:hover {
                background-color: #68B545; /* Fond légèrement blanc au survol */
                color: white; /* Texte toujours blanc */
                border-color: gray; /* Bordure blanche */
                transform: scale(1.05); /* Légère augmentation de taille */
            }

            .btn-transparent:focus {
                outline: none; /* Retirer le contour par défaut */
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.5); /* Effet de surbrillance */
            }
        </style>
    </head>
    <body>
    <a href="{{ route('admin.index') }}" class="btn btn-light btn-back">
        <i class="fas fa-arrow-left"></i> Retour
    </a><br>

    <div class="container mt-5">
        <h3 class="text-left">Gestion des utilisateurs</h3><br>

        <!-- Affichage des utilisateurs sous forme de lignes -->
        <div class="row">
            @foreach ($users as $user)
            <div class="col-md-4">
                <div class="user-card">
                    <div class="user-info">
                        <div>
                            <h5>{{ $user->email }}</h5>
                            <p><strong>Rôle:</strong> {{ $user->role }}</p>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-primary btn-sm btn-edit" data-id="{{ $user->id }}" data-email="{{ $user->email }}" data-role="{{ $user->role }}">
                                <i class="fas fa-edit"></i> 
                            </button>
                            <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

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
                        <button type="button" class="btn-close custom-close-btn" data-dismiss="modal" aria-label="Close">
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
                            <button type="button" class="btn btn-transparent" id="saveUserButton">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modale de modification -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Modifier l'utilisateur</h5>
                        <button type="button" class="btn-close custom-close-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editUserForm">
                            <div class="form-group">
                                <label for="editEmail">Adresse e-mail</label>
                                <input type="email" id="editEmail" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="editRole">Rôle</label>
                                <select id="editRole" name="role" class="form-control" required>
                                    <option value="admin">Administrateur</option>
                                    <option value="commis">Commis</option>
                                    <option value="responsable">Responsable</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editPassword">Mot de passe (laisser vide pour ne pas modifier)</label>
                                <input type="password" id="editPassword" name="password" class="form-control">
                            </div>
                            <button type="button" class="btn btn-transparent" id="saveEditButton">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fonctionnalité du bouton Modifier
        $(document).on('click', '.btn-edit', function() {
            var userId = $(this).data('id');
            var userEmail = $(this).data('email');
            var userRole = $(this).data('role');

            // Pré-remplir le formulaire de modification dans la modale
            $('#editEmail').val(userEmail);
            $('#editRole').val(userRole);
            $('#editUserModal').data('id', userId).modal('show'); // Montrer la modale avec les données
        });

        // Sauvegarder les modifications de l'utilisateur
        $(document).on('click', '#saveEditButton', function () {
            const userId = $('#editUserModal').data('id');
            const email = $('#editEmail').val();
            const role = $('#editRole').val();
            const password = $('#editPassword').val(); // Le mot de passe peut être vide

            // Vérification des champs nécessaires
            if (!email || !role) {
                alert('L\'email et le rôle sont requis !');
                return;
            }

            // Envoi de la requête AJAX pour mettre à jour les données
            $.ajax({
                url: '/users/' + userId, // URL de la mise à jour
                method: 'PUT',
                data: {
                    email: email,
                    role: role,
                    password: password, // Mot de passe peut être vide
                    _token: $('meta[name="csrf-token"]').attr('content') // Token CSRF pour la sécurité
                },
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload(); // Rafraîchir la page pour voir les changements
                    } else {
                        alert('Erreur lors de la mise à jour.');
                    }
                },
                error: function (xhr) {
                    alert('Erreur : ' + xhr.responseJSON.message);
                }
            });
        });

// Fonctionnalité du bouton Supprimer
$(document).on('click', '.btn-delete', function() {
    var userId = $(this).data('id'); // Récupérer l'ID de l'utilisateur

    // Confirmer la suppression avec un message d'alerte
    if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
        // Envoi de la requête AJAX pour supprimer l'utilisateur
        $.ajax({
            url: '/users/' + userId, // URL de la suppression
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content') // Token CSRF pour la sécurité
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message); // Afficher le message de succès
                    location.reload(); // Rafraîchir la page pour voir les changements
                } else {
                    alert(response.message); // Afficher le message d'erreur, ex: "Il doit y avoir au moins 2 administrateurs."
                }
            },
            error: function(xhr, status, error) {
                if (xhr.responseJSON) {
                    alert('Erreur : ' + xhr.responseJSON.message); // Afficher l'erreur venant du backend
                } else {
                    alert('Erreur lors de la requête AJAX : ' + error); // Afficher l'erreur générale
                }
            }
        });
    }
});



// Sauvegarder un nouvel utilisateur
$(document).on('click', '#saveUserButton', function () {
    const email = $('#email').val();
    const role = $('#role').val();
    const password = $('#password').val(); // Le mot de passe

    // Vérification des champs nécessaires
    if (!email || !role || !password) {
        alert('L\'email, le rôle et le mot de passe sont requis !');
        return;
    }

    // Envoi de la requête AJAX pour ajouter l'utilisateur
    $.ajax({
        url: '/users', // URL de l'ajout
        method: 'POST',
        data: {
            email: email,
            role: role,
            password: password,
            _token: $('meta[name="csrf-token"]').attr('content') // Token CSRF pour la sécurité
        },
        success: function (response) {
            if (response.success) {
                alert(response.message);
                location.reload(); // Rafraîchir la page pour voir les changements
            } else {
                alert('Erreur lors de l\'ajout de l\'utilisateur.');
            }
        },
        error: function (xhr) {
            alert('Erreur : ' + xhr.responseJSON.message);
        }
    });
});

    </script>
    </body>
    </html>
@endif
