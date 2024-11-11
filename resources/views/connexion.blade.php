<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title", "Connexion")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/fontStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/connexion.css') }}">
</head>

<body>
    <div class="container">
        <div class="login-box">
        <div class="container">
        <div class="container"><h1 class='titre1'>Bienvenue sur le portail de connexion</h1> </div>
    <div class="text-center my-4 d-flex justify-content-between">
        <button class="btn btn-custom" onclick="showForm('neq-login')">Connexion par NEQ</button>
        <button class="btn btn-custom" onclick="showForm('email-login')">Connexion par courriel</button>
        <button class="btn btn-outline-danger btn-custom" onclick="window.location.href='{{ route('connexionUser.index') }}'">Employé</button>
    </div>

            <!-- Formulaire de connexion par NEQ -->
            <div id="neq-login" class="login-section active">
                <form method="post" action="{{ route('Connexion.connexion') }}">
                    @csrf
                  <!--  <p class="titre1">Connexion par NEQ</p> -->
                    <div class="mb-3">
                        <label for="neq" class="form-label txtPop">NEQ:</label>
                        <input type="text" class="form-control" id="neq" placeholder="12345678910" name="neq">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label txtPop">Mot de passe:</label>
                        <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe" name="password">
                    </div>
                    <button type="submit" class="btn btn-custom">Se connecter</button>
                </form>
                <p class="text-center   mt-3 txtPop1">Vous n'êtes pas inscrit ? 
                    <a href="{{route('Inscription.Identification')}}">Formulaire d'inscription</a> | 
                    <a href="{{ route('app_forgotpassword')}}">Mot de passe oublié?</a>       
                </p>
            </div>

            <!-- Formulaire de connexion par courriel -->
            <div id="email-login" class="login-section" style="display: none;">
                <form method="post" action="{{ route('Connexion.connexion') }}">
                    @csrf
                   <!--  <p class="titre1">Connexion par courriel</p> -->
                    <div class="mb-3">
                        <label for="email" class="form-label txtPop">Courriel :</label>
                        <input type="text" class="form-control" id="email" placeholder="exemple@gmail.com" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label txtPop">Mot de passe :</label>
                        <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe" name="password">
                    </div>
                    <button type="submit" class="btn btn-custom">Se connecter</button>
                </form>
                <p class="text-center txtPop1 mt-3">Vous n'êtes pas inscrit ? 
                    <a href="{{route('Inscription.Identification')}}">Formulaire d'inscription</a> | 
                    <a href="{{ route('app_forgotpassword')}}">Mot de passe oublié?</a>       
                </p>  
            </div>
        </div>
    </div>

    <script>
        function showForm(formId) {
            document.querySelectorAll('.login-section').forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById(formId).style.display = 'block';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

