@extends('layouts.inscriptionLayout')
 
 @section('titre', 'Révision des informations entrées')
 
 @section('contenu')
 
 <body>
    <div class="container form-box">
        <div class="bg-titre">
            <div class="titre">Révision finale</div>
        </div>
        <div class="form">
            <form method="post" action="{{ route('Inscription.verificationComplet') }}">
                @csrf
                <fieldset disabled>
                    <div class="container-fluid">
                        <!---------------------------SECTION IDENTIFICATION--------------------------->
                        <div>
                            <div class="sousTitres">Identification</div>
                            
                            <!----Nom de l'entreprise---->
                            <div class="mb-3" style="position:relative;">
                                <label for="entreprise" class="form-label txtPop">
                                    <span class="text-danger">* </span>
                                    Nom de l'entreprise
                                    <span class="info-icon" onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                                        <i class="fa-sharp fa-regular fa-circle-question"></i>
                                    </span> :
                                </label>
                                <div class="custom-tooltip">
                                    <ul class="critere">
                                        <li>Obligatoire.</li>
                                        <li>Doit contenir entre 5 et 75 caractères.</li>
                                    </ul>
                                </div>

                                <input type="text" class="form-control" id="entreprise" placeholder="Tech Innovators" name="entreprise" value="{{ old('entreprise', session('user_data.entreprise', '')) }}">
                                                
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
                                    <ul class="critere">
                                        <li>Obligatoire si le champ "courriel" est vide.</li>
                                        <li>Composé exactement de 10 chiffres.</li>
                                        <li>Doit commencer par 11, 22, 33 ou 88.</li>
                                    </ul>
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
                        </div>


                        <!---------------------------SECTION PRODUITS/SERVICES--------------------------->
                        <div>
                            <div class="mb-3" style="position:relative;">
                                <label for="entreprise" class="form-label txtPop">
                                    Produits / Services
                                    <span class="info-icon" onmouseover="showTooltip(this)" onmouseout="hideTooltip(this)">
                                        <i class="fa-sharp fa-regular fa-circle-question"></i>
                                    </span> :
                                </label>
                                <div class="custom-tooltip">
                                    <ul>
                                        <li>Obligatoire.</li>
                                        <li>Maximum 64 caractères</li>
                                        <li>Doit être le nom officiel de votre entreprise.</li>
                                        <li>Ne peut pas contenir de caractères spéciaux.</li>
                                    </ul>
                                </div>

                                <textarea placeholder="Description des produits/services offerts." class="form-control description" id="services" name="services">{{ old('services', session('user_data.services', '')) }}</textarea>
                                                
                                @error('services')
                                    <div class="text-danger">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>


                        <!---------------------------SECTION COORDONNEES--------------------------->
                        <div>
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

                            <!--Input pays
                            <div class="mb-3" style="position:relative;">
                                <label for="pays" class="form-label txtPop"><span class="text-danger">* </span>Pays :</label>
                                <input type="text" class="form-control" id="pays" placeholder="Canada" name="pays" value="{{ old('pays', session('user_data.pays')) }}" required>
                            
                                @error('pays')
                                    <div class="text-danger">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>-->

                            <!--Input province-->
                            <div class="mb-3" style="position:relative;">
                                <label for="province" class="form-label txtPop" ><span class="text-danger">* </span>Province :</label>
                                <input type="text" class="form-control" id="province" placeholder="Québec" name="province" value="{{ old('province', session('user_data.province')) }}" required>
                            
                                @error('province')
                                    <div class="text-danger">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                
                            <!--Input ville-->
                            <div class="mb-3" style="position:relative;">
                                <label for="ville" class="form-label txtPop" ><span class="text-danger">* </span>Ville :</label>
                                <input type="text" class="form-control" id="ville" placeholder="Trois-Rivières" name="ville" value="{{ old('ville', session('user_data.ville')) }}" required>
                            
                                @error('ville')
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
                                <div class="mb-3 col-12 col-md-5" style="position:relative;">
                                    <label for="posteTel" class="form-label txtPop">Poste :</label>
                                    <input type="text" class="form-control" id="posteTel" placeholder="" name="posteTel" value="{{ old('posteTel', session('user_data.posteTel')) }}">
                                    
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
                                    <option value="Bureau">Bureau</option>
                                    <option value="Télécopieur">Télécopieur</option>
                                    <option value="Cellulaire">Cellulaire</option>
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
                        </div>


                        <!---------------------------SECTION CONTACTS------------------------>
                        <div>
                            <div class="sousTitres">Information contact</div>

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
                        </div>



                        <!---------------------------SECTION RBQ ET DOCUMENTS------------------------>
                        <div>
                            <div class="sousTitres">Licence(s)</div>
                            <div class="mb-3" style="position:relative;">
                                <label for="rbq" class="form-label txtPop">Licence(s) RBQ valide(s) (optionnel):</label>
                                <input type="text" class="form-control" id="rbq" placeholder="####-####-##" name="rbq" value="{{ old('rbq', session('user_data.rbq')) }}">
                                
                                @error('rbq')
                                    <div class="text-danger">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="sousTitres">Fichier(s) joint(s)</div>
                            <div class="mb-3" style="position:relative;">
                                <label for="documents[]" class="form-label">Joindres les fichiers (docx, doc, pdf, jpg, jpeg, xls, xlsx seulement)</label>
                                <input type="file" class="form-control" name="documents[]" multiple>
                                
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
                        </div>
                    </fieldset>

                    <!---------------------------BOUTONS ENVOYER------------------------>
                    <div class="d-flex justify-content-center pt-3">
                        <a class="btn btn-custom mx-3" href="{{ route('Inscription.RBQ') }}">Précédent</a>
                        <button type="submit" class="btn btn-custom mx-3">Envoyer</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</body>
@endsection