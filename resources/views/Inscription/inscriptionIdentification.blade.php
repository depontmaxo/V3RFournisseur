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
                    <div class="sousTitres">Identification</div>
                    
                    <!----Nom de l'entreprise---->
                    <div class="mb-3" style="position:relative;">
                        <label for="entreprise" class="form-label txtPop">
                            <span class="text-danger">* </span>
                            Nom de l'entreprise :
                        </label>

                        <input type="text" class="form-control" id="entreprise" placeholder="Tech Innovators" name="entreprise" value="{{ old('entreprise', session('user_data.entreprise', '')) }}" required>
                                        
                        @error('entreprise')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!----Numéro d'entreprise (NEQ)---->
                    <div class="mb-3" style="position:relative;">
                        <label for="neq" class="form-label txtPop">
                            Numéro d'entreprise (NEQ)
                            <span class="info-icon" onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                                <i class="fa-sharp fa-regular fa-circle-question"></i>
                            </span> :
                        </label>
                        <div class="custom-tooltip">
                            <p class="critere">
                            Le numéro d'entreprise du Québec (NEQ) est un code unique attribué à chaque entreprise au Québec pour l'identifier officiellement dans les démarches administratives. 
                            Pour plus d'information, cliquez <a href="https://www.quebec.ca/entreprises-et-travailleurs-autonomes/demarrer-entreprise/immatriculer-constituer-entreprise/immatriculation-entreprise/numero-entreprise-quebec" target="_blank">ici</a>.
                            </p>
                        </div>
                        <input type="text" class="form-control" id="neq" placeholder="__ __ __ __ __" name="neq" value="{{ old('neq', session('user_data.neq', '')) }}">
                                
                        @error('neq')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                        
                    <div class="sousTitres">Authentification pour connexion</div> 
                    <!----Courriel de connexion---->
                    <div class="mb-3" style="position:relative;">
                        
                        <label for="courrielConnexion" class="form-label txtPop">
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

                    <!----Mot de passe---->
                    <div class="mb-3" style="position:relative;">
                        <label for="password" class="form-label txtPop">
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
                        <input type="password" class="form-control" id="password" placeholder="Veuillez entrez un mot de passe" name="password" value="{{ old('password', '') }}" required>
                                
                        @error('password')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!----Confirmation mot de passe---->
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label txtPop" >
                        <span class="text-danger">* </span>
                            Confirmer mot de passe :
                        </label>
                        <input type="password" class="form-control" id="password" placeholder="Retapez votre mot de passe" name="password_confirmation" required>
                                
                        @error('password_confirmation')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div> <br>

                     <!--Les boutons-->
                    <div class="d-flex justify-content-center pt-3">
                        <a class="btn btn-custom btnAnnulerRetour-custom mx-3" href="{{ route('Connexion.pageConnexion') }}">
                            <i class="fa fa-times-circle me-2"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-custom mx-3">
                        Suivant  <i class="fa fa-arrow-right me-2"></i> 
                        </button>
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

        document.addEventListener('DOMContentLoaded', () => {
            const infoIcons = document.querySelectorAll('.info-icon');
            infoIcons.forEach(icon => {
                const tooltip = icon.parentNode.nextElementSibling;

                icon.addEventListener('mouseover', () => showTooltip(icon));
                icon.addEventListener('mouseout', () => hideTooltip(icon));

                tooltip.addEventListener('mouseover', () => showTooltip(icon)); // Tooltip reste ouvert quand la souris est dessus
                tooltip.addEventListener('mouseout', () => hideTooltip(icon));  // Tooltip disparaît quand la souris sort
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Inputmask({
                mask: "99 99 99 99 99",
                placeholder: "__ __ __ __ __"
            }).mask(document.getElementById('neq'));
        });
    </script>
</body>
@endsection
