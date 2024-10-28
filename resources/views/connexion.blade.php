<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title", "Connexion")</title>
        <link rel="stylesheet" href="{{ asset('css/inscription.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            .login-section { display: none; }
            .active { display: block; }
        </style>
    </head>
    <body>
    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
        </div>
    @endif
    @if(session('message'))
        <div class="alert alert-success">
            <p>{{ session('message') }}</p>
        </div>
    @endif

    <div class="container test">
        <div class="text-center my-4">
            <button class="btn btn-outline-primary" onclick="showForm('neq-login')">Connexion par NEQ</button>
            <button class="btn btn-outline-primary" onclick="showForm('email-login')">Connexion par courriel</button>
            <button class="btn btn-outline-danger ml-2" onclick="window.location.href='{{ route('admin.index') }}'">Employé</button>
        </div>

       

        <!-- NEQ login form -->
        <div id="neq-login" class="login-section active">
            <form method="post" action="{{ route('Connexion.connexion') }}">
                @csrf
                <div class="d-flex justify-content-center">
                    <p class="col-8 text-center my-3 titre">Connexion</p>
                </div>

                <div class="mb-3 d-flex justify-content-center">
                    <label for="neq" class="col-2">NEQ :</label>
                    <input type="text" class="col-5" id="neq" placeholder="12345678910" name="neq">
                </div>

                <div class="mb-3 d-flex justify-content-center">
                    <label for="password" class="col-2">Mot de passe :</label>
                    <input type="password" class="col-5" id="password" placeholder="Entrez votre mot de passe" name="password">
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary my-4 col-auto">Se connecter</button>
                </div>

               
            </form>
            <p class="text-center"> Vous n'êtes pas inscrit? 
                <a href="{{route('Inscription.Identification')}}">Formulaire inscription</a> 
            </p>
        </div>

        <!-- Email login form -->
        <div id="email-login" class="login-section">
            <form method="post" action="{{ route('Connexion.connexion') }}">
                @csrf
                <div class="d-flex justify-content-center">
                    <p class="col-8 text-center my-3 titre">Connexion</p>
                </div>
                <div class="mb-3 d-flex justify-content-center">
                    <label for="email" class="col-2">Courriel :</label>
                    <input type="text" class="col-5" id="email" placeholder="exemple@gmail.com" name="email">
                </div>
                <div class="mb-3 d-flex justify-content-center">
                    <label for="password" class="col-2">Mot de passe :</label>
                    <input type="password" class="col-5" id="password" placeholder="Entrez votre mot de passe" name="password">
                </div>
                <div class="row d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary my-4 col-auto">Se connecter</button>
                </div>
            </form>
            <p class="text-center"> Vous n'êtes pas inscrit? 
                <a href="{{route('Inscription.Identification')}}">Formulaire inscription</a>  
                <a href="{{ route('app_forgotpassword')}}">Forgot password</a>  
            </p>  
        </div>

        
    </div>
 
    <script>
        localStorage.clear();
        function showForm(formId) {
            document.querySelectorAll('.login-section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(formId).classList.add('active');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
