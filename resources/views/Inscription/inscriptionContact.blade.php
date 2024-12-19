@extends('layouts.inscriptionLayout')
 
@section('titre', 'Contacts')

@section('contenu')
<body>
    <div class="container form-box">
        <div class="bg-titre">
            <div class="titre">Contact(s) rejoignable(s)</div>
        </div>
        <div class="form">
            <form method="post" action="{{ route('Inscription.verificationContact') }}">
                @csrf
                <div class="container-fluid">
                    <div class="sousTitres">Information contact</div>

                    <!----Prenom---->
                    <div class="mb-3" style="position:relative;">
                        <label for="prenom" class="form-label txtPop">
                            <span class="text-danger">* </span>
                            Prénom :
                        </label>

                        <input type="text" class="form-control" name="prenom" placeholder="Connor" value="{{ old('prenom', session('user_data.prenom', '')) }}" required>
                        
                        @error('prenom')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!----Nom---->
                    <div class="mb-3" style="position:relative;">
                        <label for="nom" class="form-label txtPop">
                            <span class="text-danger">* </span>
                            Nom :
                        </label>
                        <input type="text" class="form-control" name="nom" placeholder="McDavid" value="{{ old('nom', session('user_data.nom', '')) }}" required>
                        @error('nom')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!----fonction du contact---->
                    <div class="mb-3" style="position:relative;">
                        <label for="fonction" class="form-label txtPop">
                            Fonction :
                        </label>
                        <input type="text" class="form-control" name="fonction" placeholder="Chef de Marketing" value="{{ old('fonction', session('user_data.fonction', '')) }}">
                        @error('fonction')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="sousTitres">Coordonnées du contact</div>
                    <!----Courriel du contact---->
                    <div class="mb-3" style="position:relative;">
                        <label for="courrielContact" class="form-label txtPop">
                            <span class="text-danger">* </span>
                            Courriel :
                        </label>
                        <input type="email" class="form-control" name="courrielContact" placeholder="exemple@gmail.com" value="{{ old('courrielContact', session('user_data.courrielContact', '')) }}" required>
                        @error('courrielContact')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <!--Input numéro de téléphone-->
                        <div class="mb-3 col-12 col-md-7" style="position:relative;">
                            <label for="numContact" class="form-label txtPop">
                                <span class="text-danger">* </span>Numéro :</label>
                            <input type="text" class="form-control" id="numContact" placeholder="___-___-____" name="numContact" value="{{ old('numContact', session('user_data.numContact')) }}">
                            
                            @error('numContact')
                                <div class="text-danger">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!--Input poste du téléphone-->
                        <div class="mb-3 col-12 col-md-5" id="poste-container" style="position:relative; display: {{ old('typeContact') == 'Bureau' ? 'block' : 'none' }};">
                            <label for="posteTelContact" class="form-label txtPop">Poste :</label>
                            <input type="text" class="form-control" id="posteTelContact" placeholder="" name="posteTelContact" value="{{ old('posteTelContact', session('user_data.posteTelContact')) }}">
                            
                            @error('posteTelContact')
                                <div class="text-danger">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!--Type de téléphone-->
                    <div class="mb-3 col-12 col-md-6">
                        <label for="typeTelContact" class="form-label txtPop">
                            <span class="text-danger">* </span>
                            Type de téléphone :
                        </label>
                        <select class="form-control" id="typeTelContact" name="typeTelContact">
                            <option value="null" disabled selected>Choisir un type de contact</option>
                            <option value="Bureau" {{ old('typeTelContact', session('user_data.typeTelContact')) == 'Bureau' ? 'selected' : '' }}>Bureau</option>
                            <option value="Télécopieur" {{ old('typeTelContact', session('user_data.typeTelContact')) == 'Télécopieur' ? 'selected' : '' }}>Télécopieur</option>
                            <option value="Cellulaire" {{ old('typeTelContact', session('user_data.typeTelContact')) == 'Cellulaire' ? 'selected' : '' }}>Cellulaire</option>
                        </select>

                        @error('typeTelContact')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div> <br>

                    <!----Les boutons---->
                    <div class="d-flex justify-content-center pt-3">
                        <a class="btn btn-custom btnAnnulerRetour-custom mx-3" href="{{ route('Inscription.Coordonnees') }}">
                            <i class="fa fa-arrow-left me-2"></i> Précédent
                        </a>
                        <button type="submit" class="btn btn-custom mx-3">
                        Suivant <i class="fa fa-arrow-right me-2"></i> 
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

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeContactSelect = document.getElementById('typeTelContact');
            const posteTelContainer = document.getElementById('poste-container');
            const numTelInput = document.getElementById('numContact');

            // Fonction pour ajuster l'affichage selon la valeur de la province
            function adjustPosteInput() {                
                if (typeContactSelect.value === 'Bureau'){
                    posteTelContainer.style.display = 'block';
                }
                else{
                    posteTelContainer.style.display = 'none';
                }
            }

            // Appeler la fonction au chargement de la page pour tenir compte de la valeur actuelle
            adjustPosteInput();

            // Ajouter un événement sur le changement de valeur du select
            typeContactSelect.addEventListener('change', adjustPosteInput);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Inputmask({
                mask: "999-999-9999",
                placeholder: "___-___-____"
            }).mask(document.getElementById('numContact'));
        });
    </script>
</body>
@endsection