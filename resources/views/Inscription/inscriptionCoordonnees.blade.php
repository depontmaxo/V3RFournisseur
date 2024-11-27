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
                    <span class="sousTitres">Emplacement de l'entreprise</span>

                    <div class="mb-3 row" style="position:relative;">
                        <div class="col-12 col-md-4 mb-2">
                            <label for="Ncivique" class="form-label txtPop"><span class="text-danger">* </span>N° Civique :</label>
                            <input type="text" class="form-control" id="Ncivique" placeholder="123" name="Ncivique" value="{{ old('Ncivique', session('user_data.Ncivique', '')) }}">

                            @error('Ncivique')
                                <div class="text-danger d-flex align-items-center mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4 mb-2">
                            <label for="rue" class="form-label txtPop"><span class="text-danger">* </span>Rue :</label>
                            <input type="text" class="form-control" id="rue" placeholder="Street" name="rue" value="{{ old('rue', session('user_data.rue', '')) }}">
                            

                            @error('rue')
                                <div class="text-danger d-flex align-items-center mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>


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

                    <div class="mb-3" style="position:relative;">
                        <label for="pays" class="form-label txtPop"><span class="text-danger">* </span>Pays :</label>
                        <input type="text" class="form-control" id="pays" placeholder="Canada" name="pays" value="{{ old('pays', session('user_data.pays')) }}">
                       
                        @error('pays')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
        

                    <div class="mb-3" style="position:relative;">
                        <label for="ville" class="form-label txtPop" ><span class="text-danger">* </span>Ville :</label>
                        <input type="text" class="form-control" id="ville" placeholder="Trois-Rivières" name="ville" value="{{ old('ville', session('user_data.ville')) }}">
                       
                        @error('ville')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3" style="position:relative;">
                        <label for="province" class="form-label txtPop" ><span class="text-danger">* </span>Province :</label>
                        <input type="text" class="form-control" id="province" placeholder="Québec" name="province" value="{{ old('province', session('user_data.province')) }}">
                       
                        @error('province')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

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
                        <input type="text" class="form-control" id="codePostal" placeholder="A1A 1A1" name="codePostal" value="{{ old('codePostal', session('user_data.codePostal')) }}">
                       
                        @error('codePostal')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <span class="sousTitres">Autres</span>
                       <div class="mb-3" style="position:relative;">
                           <label for="numTel" class="form-label txtPop"><span class="text-danger">* </span>Numéro de téléphone :</label>
                           <input type="text" class="form-control" id="numTel" placeholder="(819)123-4567" name="numTel" value="{{ old('numTel', session('user_data.numTel')) }}">
                           
                           @error('numTel')
                               <div class="text-danger">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                               </div>
                           @enderror
                       
                       </div>

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


                    <div class="d-flex justify-content-center">
                        <a class="btn btn-custom mx-3" href="{{ route('Inscription.Produits') }}">Précédent</a>
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
