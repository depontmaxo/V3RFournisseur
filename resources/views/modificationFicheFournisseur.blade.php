@extends('layouts.app')
 
@section('titre', 'Modification fiche fournisseur')
  
@section('contenu')

@if (Auth::guard('web')->check() || (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'responsable'))
    @if (auth()->user() != null || auth()->guard('user')->user() != null)
        @if (Auth::guard('web')->check())
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h1>Modifier information de votre profile</h1>
                @if ($utilisateur->statut == 'Actif')
                    <a onclick="return confirm('Êtes-vous sûr de rendre votre compte inactif?')" href="{{ route('Fournisseur.inactif', $utilisateur->id) }}" style="position:absolute; right:0;" class="btn btn-danger mx-3">Rendre compte inactif</a>
                @elseif ($utilisateur->statut == 'Inactif')
                    <a onclick="return confirm('Êtes-vous sûr de rendre votre compte actif?')" href="{{ route('Fournisseur.actif', $utilisateur->id) }}" style="position:absolute; right:0;" class="btn btn-success mx-3">Rendre compte actif</a>
                @endif
            </div>
        @elseif (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'responsable')
            <div style="display: flex; justify-content: space-between; align-items: center;">  
            <h1>Modifier fiche fournisseur</h1>
                @if ($utilisateur->statut == 'Actif')
                    <a onclick="return confirm('Êtes-vous sûr de rendre le compte inactif?')" href="{{ route('Fournisseur.inactif', $utilisateur->id) }}" style="position:absolute; right:0;" class="btn btn-danger mx-3">Rendre compte inactif</a>
                @elseif ($utilisateur->statut == 'Inactif')
                    <a onclick="return confirm('Êtes-vous sûr de rendre le compte actif?')" href="{{ route('Fournisseur.actif', $utilisateur->id) }}" style="position:absolute; right:0;" class="btn btn-success mx-3">Rendre compte actif</a>
                @endif
            </div>
        @endif
    @endif

    <body>
        @if (isset($utilisateur))
        <form method="POST" action="{{route('Fournisseur.appliqueModification', [$utilisateur]) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="container-fluid">
            
            <!------------------------------SECTIONS UTILISATEUR------------------------------>
                <span class="sections">Information de votre profile</span>

                <!----Nom de l'entreprise---->
                    <div class="mb-3" style="position:relative;">
                        <label for="entreprise" class="form-label txtPop">
                            Nom de l'entreprise :
                        </label>

                        <input type="text" class="form-control" id="entreprise" placeholder="Tech Innovators" name="entreprise" value="{{ old('entreprise', $utilisateur->nom_entreprise) }}" required>
                                        
                        @error('entreprise')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                @if (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'responsable')
                    <!----Numéro d'entreprise (NEQ)---->
                    <div class="mb-3" style="position:relative;">
                        <label for="neq" class="form-label txtPop">
                            Numéro d'entreprise (NEQ)
                        </label>
                        <input type="text" class="form-control" id="neq" placeholder="__ __ __ __ __" name="neq" value="{{ old('neq', $utilisateur->neq) }}">
                                
                        @error('neq')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                @endif

                <!----Courriel de connexion---->
                @if (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'responsable')
                <div class="mb-3" style="position:relative;">
                        
                        <label for="courrielConnexion" class="form-label txtPop">
                            Adresse courriel
                        </label>

                        <input type="email" class="form-control" id="courrielConnexion" placeholder="example@courriel.com" name="courrielConnexion" value="{{ old('courrielConnexion', $utilisateur->email) }}">
                                
                        @error('courrielConnexion')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                @endif


                <!------------------------------SECTIONS COORDONNÉES------------------------------>
                </br>
                <span class="sections">Coordonnées de l'entreprise :</span>

                    <div class="mb-3 row" style="position:relative;">
                        <!-- Numéro civique -->
                        <div class="col-12 col-md-4 mb-2">
                            <label for="Ncivique" class="form-label txtPop">N° Civique :</label>
                            <input type="text" class="form-control" id="Ncivique" placeholder="123" name="Ncivique" value="{{ old('Ncivique', $coordonnees->num_civique) }}" required>

                            @error('Ncivique')
                                <div class="text-danger d-flex align-items-center mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Rue -->
                        <div class="col-12 col-md-4 mb-2">
                            <label for="rue" class="form-label txtPop">Rue :</label>
                            <input type="text" class="form-control" id="rue" placeholder="Street" name="rue" value="{{ old('rue', $coordonnees->rue) }}" required>
                            
                            @error('rue')
                                <div class="text-danger d-flex align-items-center mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Bureau -->
                        <div class="col-12 col-md-4 mb-2" style="position:relative;">
                            <label for="bureau" class="form-label txtPop">Bureau :</label>
                            <input type="text" class="form-control" id="bureau" placeholder="Optionnel" name="bureau" value="{{ old('bureau', $coordonnees->bureau) }}">                           

                            @error('bureau')
                                <div class="text-danger d-flex align-items-center mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Province -->               
                    <div class="form-group pt-2">
                        <label for="province">Province :</label>
                        <select class="form-control" id="province" name="province" required>
                            <option value="" disabled selected>Choisir une province</option>
                            <option value="Québec" {{  old('province', $coordonnees->province) == 'Québec' ? 'selected' : '' }}>Québec</option>
                            <option value="Alberta" {{ old('province', $coordonnees->province) == 'Alberta' ? 'selected' : '' }}>Alberta</option>
                            <option value="Colombie-Britannique" {{ old('province', $coordonnees->province) == 'Colombie-Britannique' ? 'selected' : '' }}>Colombie-Britannique</option>
                            <option value="Manitoba" {{  old('province', $coordonnees->province) == 'Manitoba' ? 'selected' : '' }}>Manitoba</option>
                            <option value="Nouveau-Brunswick" {{  old('province', $coordonnees->province) == 'Nouveau-Brunswick' ? 'selected' : '' }}>Nouveau-Brunswick</option>
                            <option value="Terre-Neuve-et-Labrador" {{  old('province', $coordonnees->province) == 'Terre-Neuve-et-Labrador' ? 'selected' : '' }}>Terre-Neuve-et-Labrador</option>
                            <option value="Nouvelle-Écosse" {{  old('province', $coordonnees->province) == 'Nouvelle-Écosse' ? 'selected' : '' }}>Nouvelle-Écosse</option>
                            <option value="Ontario" {{  old('province', $coordonnees->province) == 'Ontario' ? 'selected' : '' }}>Ontario</option>
                            <option value="Île-du-Prince-Édouard" {{  old('province', $coordonnees->province) == 'Île-du-Prince-Édouard' ? 'selected' : '' }}>Île-du-Prince-Édouard</option>
                            <option value="Saskatchewan" {{  old('province', $coordonnees->province) == 'Saskatchewan' ? 'selected' : '' }}>Saskatchewan</option>
                            <option value="Territoires du Nord-Ouest" {{  old('province', $coordonnees->province) == 'Territoires du Nord-Ouest' ? 'selected' : '' }}>Territoires du Nord-Ouest</option>
                            <option value="Nunavut" {{  old('province', $coordonnees->province) == 'Nunavut' ? 'selected' : '' }}>Nunavut</option>
                            <option value="Yukon" {{  old('province', $coordonnees->province) == 'Yukon' ? 'selected' : '' }}>Yukon</option>
                        </select>
                        @error('province')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Ville -->
                    <div class="mb-3" id="ville-quebec-container" style="position:relative; display: {{ old('province') == 'Québec' ? 'block' : 'none' }};">
                        <label for="ville" class="form-label txtPop">
                            <span class="text-danger">*</span> Ville :
                        </label>
                        <select class="form-control" id="ville" name="ville">
                            <option value="" disabled selected>Choisir une ville</option>
                            @foreach ($villes as $ville)
                                <option value="{{ $ville->ville }}" {{ old('ville', $coordonnees->ville) == $ville->ville ? 'selected' : '' }}>
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
                        <label for="ville-autre" class="form-label txtPop"> Ville :</label>
                        <input type="text" class="form-control" id="ville-autre" name="ville-autre" placeholder="Entrez votre ville"
                            value="{{ old('ville-autre', $coordonnees->ville) }}">
                        @error('ville-autre')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Code postal -->
                    <div class="mb-3" style="position:relative;">
                        <label for="codePostal" class="form-label txtPop" >Code postal :</label>
                        <input type="text" class="form-control" id="codePostal" placeholder="A1A 1A1" name="codePostal" value="{{ old('codePostal', $coordonnees->code_postal) }}" 
                        style="text-transform: uppercase;" required>
                       
                        @error('codePostal')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Numéro de téléphone -->
                    <div class="mb-3" style="position:relative;">
                        <label for="numTel" class="form-label txtPop">Numéro :</label>
                        <input type="text" class="form-control" id="numTel" placeholder="___-___-____" name="numTel" value="{{ old('numTel', $coordonnees->num_telephone) }}" required>
                            
                        @error('numTel')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Siteweb -->
                    <div class="mb-3" style="position:relative;">
                        <label for="site" class="form-label txtPop" >Site web :</label>
                        <input type="text" class="form-control" id="site" placeholder="Optionnel" name="site" value="{{ old('site', $coordonnees->siteweb) }}">
                       
                        @error('site')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                <!------------------------------SECTIONS FINANCE------------------------------>
                </br>
                <span class="sections">Finance de l'entreprise :</span>
                <div class="form-group pt-2">
                    <label for="numeroTPS">Numéro TPS:</label>
                    <input type="text" class="form-control" id="numeroTPS" placeholder="Numéro TPS" name="numeroTPS" value="{{ old('numeroTPS', $finances?->numeroTPS) }}">
                    @error('numeroTPS')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="numeroTVQ">Numéro TVQ:</label>
                    <input type="text" class="form-control" id="numeroTVQ" placeholder="Numéro TVQ" name="numeroTVQ" value="{{ old('numeroTVQ', $finances?->numeroTVQ) }}">
                    @error('numeroTVQ')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="conditionPaiement">Condition de paiement:</label>
                    <input type="text" class="form-control" id="conditionPaiement" placeholder="Z001" name="conditionPaiement" value="{{ old('conditionPaiement', $finances?->conditionPaiement) }}">
                    @error('conditionPaiement')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="devise">Devise:</label>
                    <input type="text" class="form-control" id="devise" placeholder="CAD" name="devise" value="{{ old('devise', $finances?->devise) }}">
                    @error('devise')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="modeCommunication">Mode de communication: </label>
                    <input type="text" class="form-control" id="modeCommunication" placeholder="Email" name="modeCommunication" value="{{ old('modeCommunication', $finances?->modeCommunication) }}">
                    @error('modeCommunication')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <!--SECTIONS CONTACTS-->
                <?php
                    $nbFournisseur = 1;
                ?>
                </br>
                <span class="sections">Information contact(s)</span>

                
                <?php
                /* Mis en commentaire car ça bug, on peut juste delete et refaire un contact en attendant
                                @foreach ($contacts as $index => $contact)
                    <h6>Contact {{ $index + 1 }}</h6>

                    <!-- Prénom du contact -->
                    <div class="form-group pt-2">
                        <label for="prenom_{{ $index }}">Prénom du contact :</label>
                        <input type="text" class="form-control" id="prenom_{{ $index }}" placeholder="Jane" name="prenom[{{ $index }}]" value="{{ old('prenom.' . $index) ?? $contact->prenom }}">
                        @error('prenom.'.$index)
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nom du contact -->
                    <div class="form-group pt-2">
                        <label for="nom_{{ $index }}">Nom du contact :</label>
                        <input type="text" class="form-control" id="nom_{{ $index }}" placeholder="Doe" name="nom[{{ $index }}]" value="{{ old('nom.' . $index) ?? $contact->nom }}">
                        @error('nom.'.$index)
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Poste occupé -->
                    <div class="form-group pt-2">
                        <label for="poste_{{ $index }}">Poste occupé :</label>
                        <input type="text" class="form-control" id="poste_{{ $index }}" placeholder="Développeur" name="poste[{{ $index }}]" value="{{ old('poste.' . $index) ?? $contact->poste }}">
                        @error('poste.'.$index)
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email du contact -->
                    <div class="form-group pt-2">
                        <label for="email_contact_{{ $index }}">Courriel du contact :</label>
                        <input type="text" class="form-control" id="email_contact_{{ $index }}" placeholder="JaneDoe@email.com" name="email_contact[{{ $index }}]" value="{{ old('email_contact.' . $index) ?? $contact->email_contact }}">
                        @error('email_contact.'.$index)
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Numéro de téléphone du contact -->
                    <div class="form-group pt-2">
                        <label for="num_contact_{{ $index }}">Numéro de téléphone du contact :</label>
                        <input type="text" class="form-control" id="num_contact_{{ $index }}" placeholder="(819)123-4567" name="num_contact[{{ $index }}]" value="{{ old('num_contact.' . $index) ?? $contact->num_contact }}">
                        @error('num_contact.'.$index)
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    </br>
                @endforeach
                */
                ?>

                <div class="form-group pt-2">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" onclick="window.location.href='{{ route('Fournisseur.fiche', ['utilisateur' => $utilisateur]) }}'" class="btn btn-secondary">Annuler</button>
                </div>
            </div>


            <!--SECTIONS DOCUMENTS-->
        </form>
        @else
            <div>Une erreur est survenue, veuiller réessayer plus tard!</div>
        @endif

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
                mask: "99 99 99 99 99",
                placeholder: "__ __ __ __ __"
            }).mask(document.getElementById('neq'));
        });
    </script>

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
    @else
    <script>
        window.location.href = '{{ route("Responsable.index") }}'; // Redirect to a specific route
    </script>
@endif
@endsection



