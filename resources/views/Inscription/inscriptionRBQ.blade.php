@extends('layouts.inscriptionLayout')
 
@section('titre', 'Licence RBQ et documents')

@section('contenu')

<body>
    <div class="container form-box">
        <div class="bg-titre">
            <div class="titre">Brochures et cartes d'affaires</div>
        </div>
        <div class="form">
            <form method="post" action="{{ route('Inscription.verificationRBQ') }}" enctype="multipart/form-data">
                @csrf
                <div class="container-fluid">
                    <div class="sousTitres">Licence(s)</div>
                    <!----Licence RBQ---->
                    <div class="mb-3" style="position:relative;">
                        <label for="rbq" class="form-label txtPop">Licence(s) RBQ valide(s) (optionnel):</label>
                        <input type="text" class="form-control" id="rbq" placeholder= "____-____-__" name="rbq" value="{{ old('rbq', session('user_data.rbq')) }}">
                        
                        @error('rbq')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    
                    <div class="sousTitres">Fichier(s) joint(s)</div>
                    <!----Documents---->
                    <div class="mb-3" style="position:relative;">
                        <label for="documents[]" class="form-label">Joindres les fichiers (docx, doc, pdf, jpg, jpeg, xls, xlsx seulement)</label>
                        <input type="file" class="form-control-file" name="documents[]" multiple required>
                        
                        @error('documents')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                        @error('documents.*')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!----Les boutons---->
                    <div class="d-flex justify-content-center pt-3">
                        <a class="btn btn-custom mx-3" href="{{ route('Inscription.Contact') }}">Précédent</a>
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

    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Inputmask({
                mask: "9999-9999-99",
                placeholder: "____-____-__"
            }).mask(document.getElementById('rbq'));
        });
    </script>
</body>
