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
            
            <!--SECTIONS UTILISATEUR-->
            <span class="sections">Information de votre profile</span>
                <div class="form-group pt-2">
                    <label for="nom_entreprise">Nom de l'entreprise :</label>
                    <input type="text" class="form-control" id="nom_entreprise" placeholder="Nom de votre entreprise" name="nom_entreprise" value="{{ old('nom_entreprise', $utilisateur->nom_entreprise) }}">
                    @error('nom_entreprise')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                @if (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'responsable')
                    <div class="form-group pt-2">
                        <label for="NEQ">NEQ :</label>
                        <input type="text" class="form-control" id="neq" placeholder="NEQ (10 chiffres)" name="neq" value="{{ old('neq', $utilisateur->neq) }}">
                        @error('neq')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                <div class="form-group pt-2">
                    <label for="Email">Email :</label>
                    <input type="text" class="form-control" id="email" placeholder="email@email.com" name="email" value="{{ old('email', $utilisateur->email) }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="rbq">Licence(s) RBQ :</label>
                    <input type="text" class="form-control" id="rbq" placeholder="Licence(s) RBQ" name="rbq" value="{{ old('rbq', $utilisateur->rbq) }}">
                    @error('rbq')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!--SECTIONS COORDONNÉES-->
                </br>
                <span class="sections">Coordonnées de l'entreprise :</span>
                <div class="form-group pt-2">
                    <label for="num_civique">Numéro civique :</label>
                    <input type="text" class="form-control" id="num_civique" placeholder="num_civique" name="num_civique" value="{{ old('num_civique', $coordonnees->num_civique) }}">
                    @error('num_civique')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="rue">Rue :</label>
                    <input type="text" class="form-control" id="rue" placeholder="rue" name="rue" value="{{ old('rue', $coordonnees->rue) }}">
                    @error('rue')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="bureau">Numéro de bureau/suite :</label>
                    <input type="text" class="form-control" id="bureau" placeholder="# suite" name="bureau" value="{{ old('bureau', $coordonnees->bureau) }}">
                    @error('bureau')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="ville">Ville :</label>
                    <input type="text" class="form-control" id="ville" placeholder="Montréal" name="ville" value="{{ old('ville', $coordonnees->ville) }}">
                    @error('ville')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="code_region">Code de la région :</label>
                    <input type="text" class="form-control" id="code_region" placeholder="code_region" name="code_region" value="{{ old('code_region', $coordonnees->code_region) }}">
                    @error('code_region')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="region_administrative">Région administrative:</label>
                    <input type="text" class="form-control" id="region_administrative" placeholder="region_administrative" name="region_administrative" value="{{ old('region_administrative', $coordonnees->region_administrative) }}">
                    @error('region_administrative')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="province">Province :</label>
                    <select class="form-control" id="province" name="province" required>
                        <option value="" disabled selected>Choisir une province</option>
                        <option value="Alberta" {{ old('province', $coordonnees->province) == 'Alberta' ? 'selected' : '' }}>Alberta</option>
                        <option value="Colombie-Britannique" {{ old('province', $coordonnees->province) == 'Colombie-Britannique' ? 'selected' : '' }}>Colombie-Britannique</option>
                        <option value="Manitoba" {{  old('province', $coordonnees->province) == 'Manitoba' ? 'selected' : '' }}>Manitoba</option>
                        <option value="Nouveau-Brunswick" {{  old('province', $coordonnees->province) == 'Nouveau-Brunswick' ? 'selected' : '' }}>Nouveau-Brunswick</option>
                        <option value="Terre-Neuve-et-Labrador" {{  old('province', $coordonnees->province) == 'Terre-Neuve-et-Labrador' ? 'selected' : '' }}>Terre-Neuve-et-Labrador</option>
                        <option value="Nouvelle-Écosse" {{  old('province', $coordonnees->province) == 'Nouvelle-Écosse' ? 'selected' : '' }}>Nouvelle-Écosse</option>
                        <option value="Ontario" {{  old('province', $coordonnees->province) == 'Ontario' ? 'selected' : '' }}>Ontario</option>
                        <option value="Île-du-Prince-Édouard" {{  old('province', $coordonnees->province) == 'Île-du-Prince-Édouard' ? 'selected' : '' }}>Île-du-Prince-Édouard</option>
                        <option value="Québec" {{  old('province', $coordonnees->province) == 'Québec' ? 'selected' : '' }}>Québec</option>
                        <option value="Saskatchewan" {{  old('province', $coordonnees->province) == 'Saskatchewan' ? 'selected' : '' }}>Saskatchewan</option>
                        <option value="Territoires du Nord-Ouest" {{  old('province', $coordonnees->province) == 'Territoires du Nord-Ouest' ? 'selected' : '' }}>Territoires du Nord-Ouest</option>
                        <option value="Nunavut" {{  old('province', $coordonnees->province) == 'Nunavut' ? 'selected' : '' }}>Nunavut</option>
                        <option value="Yukon" {{  old('province', $coordonnees->province) == 'Yukon' ? 'selected' : '' }}>Yukon</option>
                    </select>
                    @error('province')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="code_postal">Code postal :</label>
                    <input type="text" class="form-control" id="code_postal" placeholder="A1A 1A1" name="code_postal" value="{{ old('code_postal', $coordonnees->code_postal) }}">
                    @error('code_postal')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="siteweb">Site web :</label>
                    <input type="text" class="form-control" id="siteweb" placeholder="https://www.votresite.ca/" name="siteweb" value="{{ old('siteweb', $coordonnees->siteweb) }}">
                        @error('siteweb')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group pt-2">
                    <label for="num_telephone">Numéro de téléphone :</label>
                    <input type="text" class="form-control" id="num_telephone" placeholder="(514)123-4567" name="num_telephone" value="{{ old('num_telephone', $coordonnees->num_telephone) }}">
                    @error('num_telephone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="poste">Poste :</label>
                    <input type="text" class="form-control" id="poste" placeholder="Poste" name="poste" value="{{ old('poste', $coordonnees->poste) }}">
                    @error('poste')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group pt-2">
                    <label for="type_contact">Type de contact :</label>
                    <input type="text" class="form-control" id="type_contact" placeholder="Cellulaire" name="type_contact" value="{{ old('type_contact', $coordonnees->type_contact) }}">
                    @error('type_contact')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <!--SECTIONS FINANCE-->
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
    </body>
@else
    <script>
        window.location.href = '{{ route("Responsable.index") }}'; // Redirect to a specific route
    </script>
@endif
@endsection



