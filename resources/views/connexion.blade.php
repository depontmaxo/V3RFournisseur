<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title", "Connexion")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/fontStyle.css') }}">
    <style>
        /* Centrage du formulaire */
        .container1 {
     width: 100%;
    max-width: 600px; /* Largeur maximale du formulaire */
    padding: 20px;
    background-color: #0B2341; /* Même couleur que le fond pour éviter les bordures visibles */
    border: 2px solid white; /* Bordure du formulaire */
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.5); /* Ombre pour l'effet de profondeur */
}

.text-center.my-4.d-flex.justify-content-between {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}


        /* Style pour la boîte de connexion */
        .login-box {
            background-color: #0B2341; /* Couleur de fond mise à jour */
            padding: 10px;
            border:2px solid #0B2341;
            border-radius: 0;
            box-shadow:  0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        /* Style des titres */
        .titre1 {
           font-family: 'AlumniSans-ExtraBold', sans-serif;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Style des champs de saisie */
        .form-control {
            background-color: #78C6E0;
            border-radius: 0;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3); /* Ombre autour du formulaire */
            padding: 10px;
            font-size: 1rem;
        }
        .form-control:focus {
            border-color: #d63384;
            box-shadow: none;
        }

        .txtPop {
            font-family:'Poppins-Light', 'sans-serif';
            color:white;
        }

        .txtPop1 {
            font-family:'Poppins-Light', 'sans-serif';
            font-size:0.6rem;
            color:white;
        }

        /* Style des liens */
        .txt a {
            font-family:'Poppins-Light', 'sans-serif';
            color:  #d63384;
            text-decoration: none;
        }
        .txt a:hover {
            text-decoration: underline;
        }

        .btn-custom {
    background-color: #0B2341;
    color: white;
    font-family: 'Poppins-Light', sans-serif;
    border: 2px solid white;
    padding: 6px 16px; /* Réduit encore la hauteur du bouton */
    font-size: 0.71rem; /* Réduit la taille du texte */
    transition: background-color 0.3s ease;
    max-width: 180px; /* Largeur maximale plus petite pour éviter un effet "bloc" */
    border-radius: 0;
    height: 35px; /* Hauteur plus basse pour correspondre au texte */
    line-height: 1.2; /* Ajuste l’espacement vertical du texte */
}

.btn-custom:hover {
    background-color: #78C6E0;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.5);
}


body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    background-color: #0B2341; /* Couleur de fond globale */
    display: flex;
    justify-content: center;
    align-items: center;

    /*background-image: url('../images/firm-handshake_1098-18183.jpg'); */
    background-size: cover; /* Ajuste l’image pour qu’elle couvre toute la page */
    background-position: center; /* Centre l’image */
    background-repeat: no-repeat; /* Évite la répétition de l’image */
}




    </style>
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

