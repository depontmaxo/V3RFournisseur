@extends('layouts.inscriptionLayout')
 
@section('titre', 'Identification')

  
@section('contenu')

<body>
    <div class="container form-box">
        <div class="bg-titre">
            <div class="titre">Information sur votre entreprise</div>
        </div>

        <div class="form">
            <form method="post" action="{{ route('Inscription.verificationIdentification') }}">
                @csrf
                <div class="container-fluid">
                    <span class="sousTitres">Identification</span> 
                    <div class="mb-3" style="position:relative;">
                        <label for="entreprise" class="form-label txtPop">
                            Nom de l'entreprise
                            <span class="info-icon" onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                                <i class="fa-sharp fa-regular fa-circle-question"></i>
                            </span> :
                        </label>
                        <div class="custom-tooltip">
                            <ul>
                                <li>Obligatoire.</li>
                                <li>Maximum 64 caractères</li>
                                <li>Doit être le nom officiel de votre entreprise.</li>
                                <li>Ne peut pas contenir de caractères spéciaux.</li>
                            </ul>
                        </div>

                        <input type="text" class="form-control" id="entreprise" placeholder="Tech Innovators" name="entreprise" value="{{ old('entreprise', session('user_data.entreprise', '')) }}">
                                        
                        @error('entreprise')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3" style="position:relative;">
                        <label for="entreprise" class="form-label txtPop">
                            Numéro d'entreprise (NEQ)
                            <span class="info-icon" onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                                <i class="fa-sharp fa-regular fa-circle-question"></i>
                            </span> :
                        </label>
                        <div class="custom-tooltip">
                            <ul>
                                <li>Test</li>
                                <li>Doit être le nom officiel enregistré.</li>
                                <li>Ne peut pas contenir de caractères spéciaux.</li>
                            </ul>
                        </div>

                        <input type="text" class="form-control" id="neq" placeholder="12345678910" name="neq" value="{{ old('neq', session('user_data.neq', '')) }}">
                                
                        @error('neq')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                        
                    <span class="sousTitres">Authentification pour connexion</span> 
                    <div class="mb-3" style="position:relative;">
                        
                        <label for="entreprise" class="form-label txtPop">
                            Adresse courriel
                            <span class="info-icon" onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                                <i class="fa-sharp fa-regular fa-circle-question"></i>
                            </span> :
                        </label>
                        <div class="custom-tooltip">
                            <ul>
                                <li>test2</li>
                                <li>Doit être le nom officiel enregistré.</li>
                                <li>Ne peut pas contenir de caractères spéciaux.</li>
                            </ul>
                        </div>

                        <input type="email" class="form-control" id="courrielConnexion" placeholder="example@courriel.com" name="courrielConnexion" value="{{ old('courrielConnexion', session('user_data.courrielConnexion', '')) }}">
                                
                        @error('courrielConnexion')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3" style="position:relative;">
                        <label for="entreprise" class="form-label txtPop">
                            Choisir un mot de passe
                            <span class="info-icon" onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                                <i class="fa-sharp fa-regular fa-circle-question"></i>
                            </span> :
                        </label>
                        <div class="custom-tooltip">
                            <ul>
                                <li>test3</li>
                                <li>Doit être le nom officiel enregistré.</li>
                                <li>Ne peut pas contenir de caractères spéciaux.</li>
                            </ul>
                        </div>
                        <input type="password" class="form-control" id="password" placeholder="Veuillez entrez un mot de passe" name="password" value="{{ old('password', '') }}">
                                
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label txtPop" >Confirmer mot de passe :</label>
                        <input type="password" class="form-control" id="password" placeholder="Retapez votre mot de passe" name="password_confirmation">
                                
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
        </div>
    </div>

    <script>
        function showTooltip(icon) {
            const tooltip = icon.parentNode.nextElementSibling;
            if (tooltip && tooltip.classList.contains('custom-tooltip')) {
                tooltip.style.display = 'block';
            }
        }

        function hideTooltip(icon) {
            const tooltip = icon.parentNode.nextElementSibling;
            if (tooltip && tooltip.classList.contains('custom-tooltip')) {
                tooltip.style.display = 'none';
            }
        }
    </script>
</body>
@endsection