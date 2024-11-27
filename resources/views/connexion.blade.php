@extends('pageAccueil')
 
@section('titre', 'Votre fiche')

@push('styles')
    <!-- Page-specific CSS file -->
    <link rel="stylesheet" href="{{ asset('css/connexion.css') }}">
@endpush
  
@section('contenu')

<body>
    <div class="container login-form" id="login-form">
        <div class="login-box">
            <div class="container">
                <div class="container">
                    <button class="close" onclick="closeLoginForm()"><i class="fa-solid fa-xmark"></i></button>
                    <h1 class='titre1'>Bienvenue sur le portail de connexion</h1>
                </div>

                <div class="text-center my-4 d-flex justify-content-between">
                    <button class="btn btn-custom" onclick="showForm('neq-login')">Connexion par NEQ</button>
                    <button class="btn btn-custom" onclick="showForm('email-login')">Connexion par courriel</button>
                    <button class="btn btn-outline-danger btn-custom" onclick="window.location.href='{{ route('connexionUser.index') }}'">Employé</button>
                </div>

                <!-- Formulaire de connexion par NEQ -->
                <div id="neq-login" class="login-section active">
                    <form method="post" action="{{ route('Connexion.connexion') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="neq" class="form-label txtPop">NEQ :</label>
                            <input type="text" class="form-control" id="neq" placeholder="12345678910" name="neq">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label txtPop">Mot de passe :</label>
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
    </div>

    <script>
        function showForm(formId) {
            document.querySelectorAll('.login-section').forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById(formId).style.display = 'block';
        }

        function closeLoginForm() {
                document.getElementById('login-form').style.display = 'none';
        }

        function openLoginForm() {
                document.getElementById('login-form').style.display = 'block';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

