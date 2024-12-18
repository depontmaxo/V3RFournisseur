<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres des courriels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Styles CSS */
@font-face {
    font-family: 'Poppins-Light';
    src: url('../fonts/Poppins-Light.ttf') format('truetype');
}

@font-face {
    font-family: 'Poppins-Medium';
    src: url('../fonts/Poppins-Medium.ttf') format('truetype');
}

@font-face {
    font-family: 'Poppins-Bold';
    src: url('../fonts/Poppins-Bold.ttf') format('truetype');
}

body {
    background-color: #1E492D;
    color: white;
    font-family: 'Poppins-Light', sans-serif;
}

/* Assure que toutes les bordures sont carrées */
* {
    border-radius: 0 !important; /* Ajoute cette ligne pour forcer des bords carrés sur tous les éléments */
}

.card {
    background-color: #2C5F3D;
    color: white;
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card-header {
    background-color: #204A31;
    font-family: 'Poppins-Bold', sans-serif;
}

.form-control, .form-select {
    background-color: #2C5F3D;
    color: white;
    border: 1px solid #204A31;
    border-radius: 0; /* Cette ligne supprime les arrondis sur les champs de formulaire */
}

.btn {
    font-family: 'Poppins-Medium', sans-serif;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    border-radius: 0; /* Assure que les boutons n'ont pas de bord arrondi */
}

.btn-success:hover, .btn-warning:hover, .btn-danger:hover {
    transform: scale(1.05);
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

    </style>
</head>
<body>
       <!-- Bouton Retour -->
       <a href="{{ route('admin.index') }}" class="btn btn-light btn-back">
        <i class="fas fa-arrow-left"></i> Retour
    </a><br>
    <div class="container mt-5">
        <h2 class="mb-4">Modèles de courriels</h2>
        <div class="row">
            <!-- Gestion des modèles -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modèles</div>
                    <div class="card-body">
                        <form id="modelForm" method="POST" action="{{ route('email.templates.store') }}">
                            @csrf
                            <input type="hidden" id="methodField" name="_method" value="POST">
                            <div class="mb-3">
                                <label for="newModelName" class="form-label">Nom du modèle</label>
                                <input type="text" name="nom_Modele" class="form-control" id="newModelName" placeholder="Entrez le nom du modèle">
                            </div>
                            <div class="mb-3">
                                <label for="newModelSubject" class="form-label">Objet</label>
                                <input type="text" name="objet" class="form-control" id="newModelSubject" placeholder="Entrez l'objet">
                            </div>
                            <div class="mb-3">
                                <label for="newModelMessage" class="form-label">Message</label>
                                <textarea name="message" class="form-control" id="newModelMessage" rows="4" placeholder="Entrez le message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success" id="addButton">
                                <i class="fas fa-plus"></i> Ajouter
                            </button>
                            <button type="button" class="btn btn-warning" id="editButton" style="display:none;" onclick="updateModel()">
                                <i class="fas fa-pen"></i> Modifier
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mes modèles -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Mes modèles</div>
                    <div class="card-body">
                        @if($templates->isNotEmpty())
                            <form id="selectModelForm">
                                <div class="mb-3">
                                    <label for="modelsDropdown" class="form-label">Sélectionner un modèle</label>
                                    <select class="form-select" id="modelsDropdown" onchange="populateFields(this)">
                                        <option value="">Sélectionnez un modèle</option>
                                        @foreach ($templates as $template)
                                            <option value="{{ $template->id }}" 
                                                data-nom="{{ $template->nom_Modele }}" 
                                                data-objet="{{ $template->objet }}" 
                                                data-message="{{ $template->message }}">
                                                {{ $template->nom_Modele }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                            <form action="{{ route('email.templates.destroy', $template->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce modèle ?');" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i> Supprimer
                                </button>
                            </form>
                        @else
                            <p>Aucun modèle disponible. Veuillez en ajouter un.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function populateFields(select) {
            const selectedOption = select.options[select.selectedIndex];
            const modelName = selectedOption.getAttribute('data-nom');
            const modelSubject = selectedOption.getAttribute('data-objet');
            const modelMessage = selectedOption.getAttribute('data-message');
            const modelId = selectedOption.value;

            // Remplir les champs
            document.getElementById('newModelName').value = modelName || '';
            document.getElementById('newModelSubject').value = modelSubject || '';
            document.getElementById('newModelMessage').value = modelMessage || '';

            // Afficher le bouton Modifier et masquer le bouton Ajouter
            document.getElementById('addButton').style.display = 'none';
            document.getElementById('editButton').style.display = 'inline-block';

            // Mettre à jour l'action du formulaire
            const modelForm = document.getElementById('modelForm');
            modelForm.action = `/email/templates/${modelId}/update`;
            document.getElementById('methodField').value = 'PUT';
        }

        function updateModel() {
            const form = document.getElementById('modelForm');
            form.submit();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
