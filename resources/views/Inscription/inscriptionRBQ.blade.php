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
                        <label for="rbq" class="form-label txtPop">
                            Licence RBQ valide
                            <span class="info-icon" onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                                <i class="fa-sharp fa-regular fa-circle-question"></i>
                            </span> :
                        </label>
                        <div class="custom-tooltip">
                            <p class="critere">
                            Une licence RBQ (Régie du bâtiment du Québec) est un permis obligatoire pour exercer certaines activités liées à la construction, 
                            la rénovation ou la gestion de projets de bâtiment au Québec. 
                            Elle atteste que l'entrepreneur respecte les normes de sécurité et les lois en vigueur. Pour plus d'informations, 
                            cliquez <a href="https://www.rbq.gouv.qc.ca/foire-aux-questions-faq/entrepreneur/licence/" target="_blank">ici</a>.
                            </p>
                        </div>
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
                        <input type="file" class="form-control-file" name="documents[]" multiple>
                        
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
                mask: "9999-9999-99",
                placeholder: "____-____-__"
            }).mask(document.getElementById('rbq'));
        });
    </script>
</body>
@endsection