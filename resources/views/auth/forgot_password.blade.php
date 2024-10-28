<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
            <h1 class="text-center mb-4">Réinitialiser le mot de passe</h1>
            <p class="text-center text-muted mb-5">Entrer votre adresse mail, nous vous enverrons un lien de réinitialisation</p>
            <form method="POST" action="{{ route('app_forgotpassword')}}">
                @csrf
                <div class="mb-3">
                    <label for="email-send" class="form-label">Adresse e-mail</label>
                    <input type="email" class="form-control  @error('email-success') is-invalid @enderror @error('email-error') is-invalid @enderror" id="email-send" name="email-send"  placeholder="Entrez votre e-mail" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Réinitialiser le mot de passe</button>
            </form>
            <p class="text-center mt-3">
                <a href="{{ route('index')}}">Retour à la connexion</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
