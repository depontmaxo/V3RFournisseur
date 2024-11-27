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
                    <span class="sousTitres">Information contact</span>

                    <div class="mb-3" style="position:relative;">
                        <label for="prenom" class="form-label txtPop">
                            <span class="text-danger">* </span>
                            Prénom :
                        </label>

                        <input type="text" class="form-control" name="prenom" placeholder="Connor" value="{{ old('prenom', session('user_data.prenom', '')) }}">
                        
                        @error('prenom')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3" style="position:relative;">
                        <label for="nom" class="form-label txtPop">
                            <span class="text-danger">* </span>
                            Nom :
                        </label>
                        <input type="text" class="form-control" name="nom" placeholder="McDavid" value="{{ old('nom', session('user_data.nom', '')) }}">
                        @error('nom')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3" style="position:relative;">
                        <label for="poste" class="form-label txtPop">
                            <span class="text-danger">* </span>
                            Poste/Fonction :
                        </label>
                        <input type="text" class="form-control" name="poste" placeholder="Centre" value="{{ old('poste', session('user_data.poste', '')) }}">
                        @error('poste')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3" style="position:relative;">
                        <label for="courrielContact" class="form-label txtPop">
                            <span class="text-danger">* </span>
                            Courriel :
                        </label>
                        <input type="email" class="form-control" name="courrielContact" placeholder="exemple@gmail.com" value="{{ old('courrielContact', session('user_data.courrielContact', '')) }}">
                        @error('courrielContact')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3" style="position:relative;">
                        <label for="numContact" class="form-label txtPop">
                            <span class="text-danger">* </span>
                            Numéro de téléphone :
                        </label>
                        <input type="text" class="form-control" name="numContact" placeholder="(819)123-4567" value="{{ old('numContact', session('user_data.numContact', '')) }}">
                        @error('numContact')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center">
                        <a class="btn btn-custom mx-3" href="{{ route('Inscription.Coordonnees') }}">Précédent</a>
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