<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres des courriels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien vers FontAwesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Modèles de courriels</h2>
        <div class="row">
            <!-- Gestion des modèles -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modèles</div>
                    <div class="card-body">
                        <!-- Formulaire pour ajouter un modèle -->
                        <form action="{{ route('email.templates.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="newModelName" class="form-label">Nom du modèle</label>
                                <input type="text" name="nom_Modele" class="form-control" id="newModelName">
                            </div>
                            <div class="mb-3">
                                <label for="newModelSubject" class="form-label">Objet</label>
                                <input type="text" name="objet" class="form-control" id="newModelSubject">
                            </div>
                            <div class="mb-3">
                                <label for="newModelMessage" class="form-label">Message</label>
                                <textarea name="message" class="form-control" id="newModelMessage" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus"></i> Ajouter
                            </button>
                        </form>
                    </div>
                </div>
            </div>

 <!-- Section avec le cadre "Mes modèles" -->
 <div class="col-md-4">
    <div class="card">
        <div class="card-header">Mes modèles</div>
        <div class="card-body">
            <!-- Vérifier si la liste des modèles n'est pas vide -->
            @if($templates->isNotEmpty())
                <!-- Formulaire pour sélectionner un modèle -->
                <form action="{{ route('email.templates.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="modelsDropdown" class="form-label">Sélectionner un modèle</label>
                        <select class="form-select" id="modelsDropdown" name="model_id">
                            <option value="">Sélectionnez un modèle</option>
                            @foreach ($templates as $template)
                                <option value="{{ $template->id }}">
                                    {{ $template->nom_Modele }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Conteneur pour aligner les boutons côte à côte -->
                    <div class="d-flex gap-2">
                        <!-- Bouton Modifier -->
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </button>
                    </div>
                </form>

                <!-- Formulaire pour supprimer un modèle -->
                <form action="{{ route('email.templates.destroy', $template->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce modèle ?');" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> Supprimer
                    </button>
                </form>
            @else
                <!-- Message lorsque la liste des modèles est vide -->
                <p>Aucun modèle disponible. Veuillez en ajouter un.</p>
            @endif
        </div>
    </div>
</div>
</body>
</html>
