@extends('layouts.inscriptionLayout')
 
@section('titre', 'Coordonnées')

@section('contenu')
<body>
    <div class="container form-box">
        <div class="bg-titre">
            <div class="titre">Coordonnées de votre entreprise</div>
        </div>

        <div class="form">
            <form method="post" action="{{ route('Inscription.verificationCoordonnees') }}">
                @csrf
                <div class="container-fluid">
                    <div class="sousTitres">Emplacement de l'entreprise</div>

                    <div class="mb-3 row" style="position:relative;">
                        <!--Input numéro civique-->
                        <div class="col-12 col-md-4 mb-2">
                            <label for="Ncivique" class="form-label txtPop"><span class="text-danger">* </span>N° Civique :</label>
                            <input type="text" class="form-control" id="Ncivique" placeholder="123" name="Ncivique" value="{{ old('Ncivique', session('user_data.Ncivique', '')) }}" required>

                            @error('Ncivique')
                                <div class="text-danger d-flex align-items-center mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!--Input rue-->
                        <div class="col-12 col-md-4 mb-2">
                            <label for="rue" class="form-label txtPop"><span class="text-danger">* </span>Rue :</label>
                            <input type="text" class="form-control" id="rue" placeholder="Street" name="rue" value="{{ old('rue', session('user_data.rue', '')) }}" required>
                            
                            @error('rue')
                                <div class="text-danger d-flex align-items-center mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!--Input bureau-->
                        <div class="col-12 col-md-4 mb-2" style="position:relative;">
                            <label for="bureau" class="form-label txtPop">Bureau :</label>
                            <input type="text" class="form-control" id="bureau" placeholder="Optionnel" name="bureau" value="{{ old('bureau', session('user_data.bureau', '')) }}">                           

                            @error('bureau')
                                <div class="text-danger d-flex align-items-center mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!--Input province-->
                    <div class="mb-3" style="position:relative;">
                        <label for="province" class="form-label txtPop">
                            <span class="text-danger">* </span>Province :
                        </label>
                        <select class="form-control" id="province" name="province" required>
                            <option value="" disabled selected>Choisir une province</option>
                            <option value="Alberta" {{ old('province', session('user_data.province')) == 'Alberta' ? 'selected' : '' }}>Alberta</option>
                            <option value="Colombie-Britannique" {{ old('province', session('user_data.province')) == 'Colombie-Britannique' ? 'selected' : '' }}>Colombie-Britannique</option>
                            <option value="Manitoba" {{ old('province', session('user_data.province')) == 'Manitoba' ? 'selected' : '' }}>Manitoba</option>
                            <option value="Nouveau-Brunswick" {{ old('province', session('user_data.province')) == 'Nouveau-Brunswick' ? 'selected' : '' }}>Nouveau-Brunswick</option>
                            <option value="Terre-Neuve-et-Labrador" {{ old('province', session('user_data.province')) == 'Terre-Neuve-et-Labrador' ? 'selected' : '' }}>Terre-Neuve-et-Labrador</option>
                            <option value="Nouvelle-Écosse" {{ old('province', session('user_data.province')) == 'Nouvelle-Écosse' ? 'selected' : '' }}>Nouvelle-Écosse</option>
                            <option value="Ontario" {{ old('province', session('user_data.province')) == 'Ontario' ? 'selected' : '' }}>Ontario</option>
                            <option value="Île-du-Prince-Édouard" {{ old('province', session('user_data.province')) == 'Île-du-Prince-Édouard' ? 'selected' : '' }}>Île-du-Prince-Édouard</option>
                            <option value="Québec" {{ old('province', session('user_data.province')) == 'Québec' ? 'selected' : '' }}>Québec</option>
                            <option value="Saskatchewan" {{ old('province', session('user_data.province')) == 'Saskatchewan' ? 'selected' : '' }}>Saskatchewan</option>
                            <option value="Territoires du Nord-Ouest" {{ old('province', session('user_data.province')) == 'Territoires du Nord-Ouest' ? 'selected' : '' }}>Territoires du Nord-Ouest</option>
                            <option value="Nunavut" {{ old('province', session('user_data.province')) == 'Nunavut' ? 'selected' : '' }}>Nunavut</option>
                            <option value="Yukon" {{ old('province', session('user_data.province')) == 'Yukon' ? 'selected' : '' }}>Yukon</option>
                        </select>

                        @error('province')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!--Input ville-->
                    <div class="mb-3" id="ville-quebec-container" style="position:relative; display: {{ old('province') == 'Québec' ? 'block' : 'none' }};">
                        <label for="ville" class="form-label txtPop">
                            <span class="text-danger">*</span> Ville :
                        </label>
                        <select class="form-control" id="ville" name="ville">
                            <option value="" disabled selected>Choisir une ville</option>
                            @foreach ($villes as $ville)
                                <option value="{{ $ville->ville }}" {{ old('ville', session('user_data.ville')) == $ville->ville ? 'selected' : '' }}>
                                    {{ $ville->ville }}
                                </option>
                            @endforeach
                        </select>

                        @error('ville')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3" id="ville-autre-container" style="position:relative; display: {{ old('province') != 'Québec' ? 'block' : 'none' }};">
                        <label for="ville-autre" class="form-label txtPop">
                            <span class="text-danger">*</span> Ville :
                        </label>
                        <input type="text" class="form-control" id="ville-autre" name="ville-autre" placeholder="Entrez votre ville"
                            value="{{ old('ville-autre', session('user_data.ville-autre', '')) }}">
                        @error('ville-autre')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!--Input code postal-->
                    <div class="mb-3" style="position:relative;">
                        <label for="codePostal" class="form-label txtPop" ><span class="text-danger">* </span>Code postal 
                            <span class="info-icon" onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                                <i class="fa-sharp fa-regular fa-circle-question"></i>
                            </span> :
                        </label>
                        <div class="custom-tooltip">
                            <ul class="critere">
                                <li>Obligatoire.</li>
                                <li>Doit contenir entre 7 et 12 caractères.</li>
                                <li>Doit inclure au moins</li>
                            </ul>
                        </div>
                        <input type="text" class="form-control" id="codePostal" placeholder="A1A 1A1" name="codePostal" value="{{ old('codePostal', session('user_data.codePostal')) }}" 
                        style="text-transform: uppercase;" required>
                       
                        @error('codePostal')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="sousTitres">Téléphone</div>
                    
                    <div class="row">
                        <!--Input numéro de téléphone-->
                        <div class="mb-3 col-12 col-md-7" style="position:relative;">
                            <label for="numTel" class="form-label txtPop"><span class="text-danger">* </span>Numéro :</label>
                            <input type="text" class="form-control" id="numTel" placeholder="___-___-____" name="numTel" value="{{ old('numTel', session('user_data.numTel')) }}" required>
                            
                            @error('numTel')
                                <div class="text-danger">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!--Input poste du téléphone-->
                        <div class="mb-3 col-12 col-md-5" id="poste-container" style="position:relative; display: {{ old('typeContact') == 'Bureau' ? 'block' : 'none' }};">
                            <label for="posteTel" class="form-label txtPop">Poste :</label>
                            <input type="text" class="form-control" id="posteTel" placeholder="5589" name="posteTel" value="{{ old('posteTel', session('user_data.posteTel')) }}">
                            
                            @error('posteTel')
                                <div class="text-danger">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!--Type de téléphone-->
                    <div class="mb-3 col-12 col-md-6">
                        <label for="typeContact" class="form-label txtPop">
                            <span class="text-danger">* </span>Type de téléphone :
                        </label>
                        <select class="form-control" id="typeContact" name="typeContact" required>
                            <option value="" disabled selected>Choisir un type de contact</option>
                            <option value="Bureau" {{ old('typeContact', session('user_data.typeContact')) == 'Bureau' ? 'selected' : '' }}>Bureau</option>
                            <option value="Télécopieur" {{ old('typeContact', session('user_data.typeContact')) == 'Télécopieur' ? 'selected' : '' }}>Télécopieur</option>
                            <option value="Cellulaire" {{ old('typeContact', session('user_data.typeContact')) == 'Cellulaire' ? 'selected' : '' }}>Cellulaire</option>
                        </select>

                        @error('typeContact')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>


                    <div class="sousTitres">Autres</div>
                    <!--Input site web-->
                    <div class="mb-3" style="position:relative;">
                        <label for="site" class="form-label txtPop" >Site web :</label>
                        <input type="text" class="form-control" id="site" placeholder="Optionnel" name="site" value="{{ old('site', session('user_data.site')) }}">
                       
                        @error('site')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>


                    <!--Les boutons-->
                        <div class="d-flex justify-content-center pt-3">
                        <a class="btn btn-custom btnAnnulerRetour-custom mx-3" href="{{ route('Inscription.Identification') }}">
                            <i class="fa fa-arrow-left me-2"></i>Précédent
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
            const provinceSelect = document.getElementById('province');
            const villeQuebecContainer = document.getElementById('ville-quebec-container');
            const villeAutreContainer = document.getElementById('ville-autre-container');

            // Fonction pour ajuster l'affichage selon la valeur de la province
            function adjustVilleInput() {
                if (provinceSelect.value === 'Québec') {
                    villeQuebecContainer.style.display = 'block';
                    villeAutreContainer.style.display = 'none';
                } else {
                    villeQuebecContainer.style.display = 'none';
                    villeAutreContainer.style.display = 'block';
                }
            }

            // Appeler la fonction au chargement de la page pour tenir compte de la valeur actuelle
            adjustVilleInput();

            // Ajouter un événement sur le changement de valeur du select
            provinceSelect.addEventListener('change', adjustVilleInput);
        });


        document.addEventListener('DOMContentLoaded', function () {
            const typeContactSelect = document.getElementById('typeContact');
            const posteTelContainer = document.getElementById('poste-container');

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
            }).mask(document.getElementById('numTel'));

            Inputmask({
                mask: "A9A 9A9", // Format : Lettre - Chiffre - Lettre - Espace - Chiffre - Lettre - Chiffre
                definitions: {
                    'A': { validator: "[A-Za-z]" }, // Accepte uniquement des lettres
                    '9': { validator: "[0-9]" }     // Accepte uniquement des chiffres
                },
                placeholder: "___ ___"
            }).mask(document.getElementById('codePostal'));
        });
    </script>
</body>
@endsection