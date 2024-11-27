<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer le mot de passe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow p-4">
                <h1 class="text-center text-muted mb-3">Changer votre mot de passe</h1>
                <p class="text-center text-muted mb-4">Veuillez entrer un nouveau mot de passe.</p>

                <!-- Formulaire -->
                <form action="{{ route('app_changepassword', ['token' => $activation_token]) }}" method="post">
                    @csrf

                    <!-- Affichage des alertes -->
                    @include('alerts.alert-message')

                    <!-- Nouveau mot de passe -->
                    <div class="mb-3">
                        <label for="new-password" class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="new-password" id="new-password" class="form-control @error('password-success') is-valid @enderror  @error('password-error') is-invalid @enderror" placeholder="Entrez votre nouveau mot de passe" required value="@if(Session::has('old-new-password')){{Session::get('old-new-password')}}@endif">
                    </div>

                    <!-- Confirmation du mot de passe -->
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirmez le mot de passe</label>
                        <input type="password" name="confirm-password" id="confirm-password" class="form-control   @error('password-error-confirm') is-invalid @enderror" placeholder="Confirmez votre mot de passe" required value="@if(Session::has('old-new-password')){{Session::get('old-new-password-confirm')}}@endif">
                    </div>

                    <!-- Bouton de soumission -->
                    <button type="submit" class="btn btn-primary w-100">Mettre à jour le mot de passe</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
