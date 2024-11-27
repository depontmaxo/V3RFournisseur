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
                            <span class="text-danger">* </span>
                            Nom de l'entreprise
                            <span class="info-icon" onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                                <i class="fa-sharp fa-regular fa-circle-question"></i>
                            </span> :
                        </label>
                        <div class="custom-tooltip">
                            <ul class="critere">
                                <li>Obligatoire.</li>
                                <li>Doit contenir entre 5 et 75 caractères.</li>
                            </ul>
                        </div>

                        <input type="text" class="form-control" id="entreprise" placeholder="Tech Innovators" name="entreprise" value="{{ old('entreprise', session('user_data.entreprise', '')) }}">
                                        
                        @error('entreprise')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
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
                            <ul class="critere">
                                <li>Obligatoire si le champ "courriel" est vide.</li>
                                <li>Composé exactement de 10 chiffres.</li>
                                <li>Doit commencer par 11, 22, 33 ou 88.</li>
                            </ul>
                        </div>

                        <input type="text" class="form-control" id="neq" placeholder="12345678910" name="neq" value="{{ old('neq', session('user_data.neq', '')) }}">
                                
                        @error('neq')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
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
                            <ul class="critere">
                                <li>Obligatoire si le champ NEQ est vide.</li>
                                <li>Doit être une adresse courriel valide.</li>
                                <li>Ne peut pas dépasser 64 caractères.</li>
                                <li>Le domaine doit avoir une extension valide (exemple : .com, .org).</li>
                                <li>Pas de tirets juste avant ou après le "@" dans l'adresse.</li>
                            </ul>
                        </div>

                        <input type="email" class="form-control" id="courrielConnexion" placeholder="example@courriel.com" name="courrielConnexion" value="{{ old('courrielConnexion', session('user_data.courrielConnexion', '')) }}">
                                
                        @error('courrielConnexion')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3" style="position:relative;">
                        <label for="entreprise" class="form-label txtPop">
                            <span class="text-danger">* </span>
                            Choisir un mot de passe
                            <span class="info-icon" onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                                <i class="fa-sharp fa-regular fa-circle-question"></i>
                            </span> :
                        </label>
                        <div class="custom-tooltip">
                            <ul class="critere">
                                <li>Obligatoire.</li>
                                <li>Doit contenir entre 7 et 12 caractères.</li>
                                <li>Doit inclure au moins :
                                    <ul>
                                        <li>Une lettre minuscule.</li>
                                        <li>Une lettre majuscule.</li>
                                        <li>Un chiffre.</li>
                                        <li>Un caractère spécial.</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <input type="password" class="form-control" id="password" placeholder="Veuillez entrez un mot de passe" name="password" value="{{ old('password', '') }}">
                                
                        @error('password')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label txtPop" >
                        <span class="text-danger">* </span>
                            Confirmer mot de passe :
                        </label>
                        <input type="password" class="form-control" id="password" placeholder="Retapez votre mot de passe" name="password_confirmation">
                                
                        @error('password_confirmation')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center">
                        <a class="btn btn-custom mx-3" href="{{ route('Connexion.pageConnexion') }}">Annuler</a>
                        <button type="submit" class="btn btn-custom mx-3">Suivant</button>
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