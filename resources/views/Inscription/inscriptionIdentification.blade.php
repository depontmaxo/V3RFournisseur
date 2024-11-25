@extends('layouts.inscriptionLayout')
 
@section('titre', 'Votre fiche')

  
@section('contenu')

<body>
    <form method="post" action="{{ route('Inscription.verificationIdentification') }}">
        @csrf
        <div class="container-fluid">
                    
            <p class="col-12 text-center my-3 titre">Information de votre entreprise</p>
                        
            <span class="sousTitres">Identification</span> 
            
            <div class="mb-3">
                <label for="entreprise" class="form-label txtPop">Nom de l'entreprise :</label>
                <input type="text" class="form-control" id="entreprise" placeholder="Tech Innovators" name="entreprise" value="{{ old('entreprise', session('user_data.entreprise', '')) }}">
                                
                @error('entreprise')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
                        
            <div class="mb-3 row">
                <label for="entreprise" class="col-3" >Nom de l'entreprise :</label>
                <input type="text" class="col-9" id="entreprise" placeholder="Tech Innovators" name="entreprise" value="{{ old('entreprise', session('user_data.entreprise', '')) }}">
                        
                @error('entreprise')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 row">
                <label for="neq" class="col-3" >Numéro d'entreprise (NEQ) :</label>
                <input type="text" class="col-9" id="neq" placeholder="12345678910" name="neq" value="{{ old('neq', session('user_data.neq', '')) }}">
                        
                @error('neq')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
                 
            <span class="sousTitres">Authentification pour connexion</span> 
            <div class="mb-3 row">
                <label for="courrielConnexion" class="col-3" >Adresse courriel :</label>
                <input type="email" class="col-9" id="courrielConnexion" placeholder="example@courriel.com" name="courrielConnexion" value="{{ old('courrielConnexion', session('user_data.courrielConnexion', '')) }}">
                        
                @error('courrielConnexion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 row">
                <label for="password" class="col-3" >Choisir un mot de passe :</label>
                <input type="password" class="col-9" id="password" placeholder="Veuillez entrez un mot de passe" name="password" value="{{ old('password', '') }}">
                        
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 row">
                <label for="confirmPassword" class="col-3" >Confirmer mot de passe :</label>
                <input type="password" class="col-9" id="password" placeholder="Retapez votre mot de passe" name="password_confirmation">
                        
                @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>



            <div class="d-flex justify-content-center">
                <a class="btn btn-custom" href="{{ route('Connexion.pageConnexion') }}">Annuler</a>
                <button type="submit" class="btn btn-custom">Suivant</button>
            </div>
                    
        </div>
    </form>

    <!-- <div class="container">
        <div class="login-box">
        <div class="container">
        <div class="container"><h1 class='titre1'>Portail d'inscription</h1> </div>

        <p class="col-12 text-center my-3 titre">Information de votre entreprise</p>
            <div>
                <form method="post" action="{{ route('Inscription.verificationIdentification') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="entreprise" class="form-label txtPop">Nom de l'entreprise :</label>
                        <input type="text" class="form-control" id="entreprise" placeholder="Tech Innovators" name="entreprise" value="{{ old('entreprise', session('user_data.entreprise', '')) }}">
                                
                        @error('entreprise')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label txtPop">Mot de passe:</label>
                        <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe" name="password">
                    </div>

                    <a class="btn btn-custom" href="{{ route('Connexion.pageConnexion') }}">Annuler</a>
                    <button type="submit" class="btn btn-custom">Suivant</button>
                </form>
            </div>
        </div>
    </div>-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
@endsection