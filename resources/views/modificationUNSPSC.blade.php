@extends('layouts.app')
 
@section('titre', 'Gestion Code UNSPSC')
  
@section('contenu')

@if (Auth::guard('web')->check() || (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'responsable'))
        
<body>
    <h2 id="Recherche">Liste des codes UNSPSC </h2>
            
        @if ($codes && $codes->count() > 0)
            <ul> 
                @foreach ($codes as $code)
                    <li class="UNSPSC_list">
                        {{ $code->nature_contrat }} / {{ $code->desc_cat }} / {{ $code->unspsc_id }} / {{ $code->desc_det_unspsc }} 
                        <!-- Remove Code Form -->
                        <form action="{{ route('Fournisseurs.supprimerUNSPSC') }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="unspsc_id" value="{{ $code->unspsc_id }}">
                            <input type="hidden" name="utilisateur_id" value="{{ $utilisateur->id }}">
                            <button type="submit" class="btn btn-sm btn-danger UNSPSC_delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce code ?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Il n'y a pas de codes associés</p>
        @endif

    <h2 id="Recherche">Ajout de Code </h2>
    <div class="container form-box">
        <div class="form">
            <div class="container">
                <!-- Formulaire Laravel -->
                <form method="POST" action="{{ route('Fournisseur.appliqueUNSPSC', ['utilisateur' => $utilisateur]) }}" id="insideForm">
                    @csrf
                    <input type="hidden" id="selectedCodesInput" name="selected_codes" value="">
                    <!-- Barre de recherche -->
                    <div class="mb-3">
                        <input 
                            type="text" 
                            id="search" 
                            class="form-control" 
                            placeholder="Rechercher un code ou une description"
                            oninput="searchUNSPSC()"
                        />
                    </div>

                    <!-- Table responsive -->
                    <div class="table-responsive">
                        @error('selected_codes')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" style="width: 5%;"></th>
                                    <th scope="col" style="width: 20%;">Code UNSPSC</th>
                                    <th scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody id="unspscTable">
                                <!-- Les lignes seront ajoutées dynamiquement ici -->
                            </tbody>
                        </table>
                    </div> <br>

                    <!-- Pagination -->
                    <nav>
                        <ul class="pagination justify-content-center" id="pagination">
                            <!-- Pagination dynamiquement remplie -->
                        </ul>
                    </nav>

                    <!-- Bouton Soumettre -->
                    <div class="form-group pt-2">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" onclick="window.location.href='{{ route('Fournisseur.fiche', ['utilisateur' => $utilisateur]) }}'" class="btn btn-secondary">Annuler</button>
                    </div>
                </form>
            </div>
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
        const unspscData = @json($UNSPSC);

        const mockData = unspscData.map(item => ({
            code: item.code_unspsc,
            description: item.desc_unspsc
        }));

        let selectedCodes = @json(session('user_data.selectedCodes', [])); // Liste des codes sélectionnés
        //console.log("codes : " + selectedCodes);
        let filteredData = []; // Données filtrées par la recherche
        let currentPage = 1;
        const itemsPerPage = 10;

        function searchUNSPSC() {
            const query = document.getElementById("search").value.toLowerCase(); // Récupérer la saisie en minuscules
            filteredData = mockData.filter(item => 
                String(item.code).toLowerCase().includes(query) || 
                item.description.toLowerCase().includes(query)
            );
            currentPage = 1; // Revenir à la première page après une recherche
            displayPage(currentPage); // Afficher les résultats filtrés
        }

        function displayPage(page) {
            const dataToDisplay = filteredData.length > 0 ? filteredData : mockData; // Utiliser les données filtrées ou les données complètes
            const totalPages = Math.ceil(dataToDisplay.length / itemsPerPage);
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const pageData = dataToDisplay.slice(start, end);

            // Mettre à jour le tableau avec les données de la page actuelle
            const tbody = document.getElementById("unspscTable");
            tbody.innerHTML = pageData.map(item => {
                const checked = selectedCodes.includes(item.code) ? 'checked' : ''; // Vérifier si le code est sélectionné
                return `
                    <tr>
                        <td>
                            <input type="checkbox" name="unspsc_codes[]" value="${item.code}" class="unspsc-checkbox" ${checked} onchange="toggleSelection('${item.code}')">
                        </td>
                        <td>${item.code}</td>
                        <td>${item.description}</td>
                    </tr>
                `;
            }).join('');

            // Mettre à jour la pagination
            currentPage = page;
            updatePagination(dataToDisplay.length, totalPages);
            updateCheckboxState();
        }

        function updateCheckboxState() {
            // Pour chaque case à cocher
            const checkboxes = document.querySelectorAll('.unspsc-checkbox');
            checkboxes.forEach(checkbox => {
                // Vérifie si le code est dans selectedCodes et applique l'état
                if (selectedCodes.includes(checkbox.value)) {
                    checkbox.checked = true; // Coche la case
                } else {
                    checkbox.checked = false; // Décoche la case
                }
            });
        }

        function toggleSelection(code) {
            // Si la case est cochée, on l'ajoute à la liste; sinon on la retire
            if (selectedCodes.includes(code)) {
                selectedCodes = selectedCodes.filter(item => item !== code);
            } else {
                selectedCodes.push(code);
            }
            //console.log(selectedCodes);
        }


        function updatePagination(totalItems, totalPages) {
            const pagination = document.getElementById("pagination");

            // Calcul des pages à afficher
            const range = 2;  // Affiche 2 pages avant et après la page courante
            const startPage = Math.max(currentPage - range, 1); // La première page affichée
            const endPage = Math.min(currentPage + range, totalPages); // La dernière page affichée

            let pages = [];

            // Ajouter page précédente
            if (currentPage > 1) {
                pages.push(`
                    <li class="page-item">
                        <button class="page-link btn btn-pagination" onclick="displayPage(${currentPage - 1})">Précédent</button>
                    </li>
                `);
            }

            // Ajouter première page
            if (startPage > 1) {
                pages.push(`
                    <li class="page-item">
                        <button class="page-link btn btn-pagination" onclick="displayPage(1)">1</button>
                    </li>
                `);
                pages.push(`<li class="page-item disabled"><span class="page-link btn btn-pagination" style="background:inherit;">...</span></li>`);
            }

            // Ajouter pages dans la plage
            for (let i = startPage; i <= endPage; i++) {
                pages.push(`
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <button class="page-link btn btn-pagination" onclick="displayPage(${i})">${i}</button>
                    </li>
                `);
            }

            // Ajouter dernière page
            if (endPage < totalPages) {
                pages.push(`<li class="page-item disabled"><span class="page-link btn btn-pagination" style="background:inherit;">...</span></li>`);
                pages.push(`
                    <li class="page-item">
                        <button class="page-link btn btn-pagination" onclick="displayPage(${totalPages})">${totalPages}</button>
                    </li>
                `);
            }

            // Ajouter page suivante
            if (currentPage < totalPages) {
                pages.push(`
                    <li class="page-item">
                        <button class="page-link btn btn-pagination" onclick="displayPage(${currentPage + 1})">Suivant</button>
                    </li>
                `);
            }

            // Mettre à jour la pagination
            pagination.innerHTML = pages.join('');
        }

        // Initialisation
        displayPage(1);

        document.getElementById('unspscForm').addEventListener('submit', function(event) {
            //event.preventDefault();
            var input = document.getElementById('selectedCodesInput');
            input.value = JSON.stringify(selectedCodes);
        });
    </script>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@else
    <script>
        window.location.href = '{{ route("Responsable.index") }}'; // Redirect to a specific route
    </script>
@endif
@endsection



