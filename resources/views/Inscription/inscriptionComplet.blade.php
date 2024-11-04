<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title", "Inscription")</title>
        <link rel="stylesheet" href="{{ asset('css/inscription.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
            <form method="post" action="{{ route('Inscription.verificationComplet') }}">
                
            @csrf
            <div class="container-fluid">
                <fieldset disabled>
                    <!---------------------------SECTION IDENTIFICATION--------------------------->
                    <p class="col-12 text-center my-3 titre">Information de votre entreprise</p>
                        
                    <span class="sousTitres">Identification</span>      
                    <div class="mb-3 row">
                        <label for="entreprise" class="col-3" >Nom de l'entreprise :</label>
                        <input type="text" class="col-9" id="entreprise" placeholder="Aucun" name="entreprise" value="{{ old('entreprise', session('user_data.entreprise', '')) }}">
                        
                        @error('entreprise')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                        <div class="mb-3 row">
                            <label for="neq" class="col-3" >Numéro d'entreprise (NEQ) :</label>
                            <input type="text" class="col-9" id="neq" placeholder="Aucun" name="neq" value="{{ old('neq', session('user_data.neq', '')) }}">
                        
                            @error('neq')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                 
                        <span class="sousTitres">Authentification pour connexion</span> 
                        <div class="mb-3 row">
                            <label for="courrielConnexion" class="col-3" >Adresse courriel :</label>
                            <input type="email" class="col-9" id="courrielConnexion" placeholder="Aucun" name="courrielConnexion" value="{{ old('courrielConnexion', session('user_data.courrielConnexion', '')) }}">
                        
                            @error('courrielConnexion')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!---------------------------SECTION PRODUITS/SERVICES--------------------------->
                        <p class="col-12 text-center my-3 titre">Descriptions des produits et services offerts</p>
                        <span class="sousTitres">Produits ou services offerts</span>
                        <div class="mb-3 row">
                            <label for="services" class="col-3">Produits / Services :</label>
                            <textarea placeholder="Aucun" class="col-9 description" id="services" name="services">{{ old('services', session('user_data.services', '')) }}</textarea>
                        
                            @error('services')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>
                    
                        <!---------------------------SECTION COORDONNEES--------------------------->

                        <p class="col-12 text-center my-3 titre">Coordonnées de votre entreprise</p>
                       
                       <span class="sousTitres">Coordonnées</span>

                       <div class="mb-3 row">
                           <label for="adresse" class="col-3" >Adresse :</label>
                           <input type="text" class="col-9" id="adresse" placeholder="Aucun" name="adresse" value="{{ old('adresse', session('user_data.adresse', '')) }}">
                       
                       
                           @error('adresse')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>

                       <div class="mb-3 row">
                           <label for="bureau" class="col-3" >Bureau (optionnel) : </label>
                           <input type="text" class="col-9" id="bureau" placeholder="Aucun" name="bureau" value="{{ old('bureau', session('user_data.bureau', '')) }}">
                       
                           @error('bureau')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>

                       <div class="mb-3 row">
                           <label for="ville" class="col-3" >Ville :</label>
                           <input type="text" class="col-9" id="ville" placeholder="Aucun" name="ville" value="{{ old('ville', session('user_data.ville')) }}">
                       
                           @error('ville')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>

                       <div class="mb-3 row">
                           <label for="province" class="col-3" >Province :</label>
                           <input type="text" class="col-9" id="province" placeholder="Aucun" name="province" value="{{ old('province', session('user_data.province')) }}">
                       
                           @error('province')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>

                       <div class="mb-3 row">
                           <label for="codePostal" class="col-3" >Code postal :</label>
                           <input type="text" class="col-9" id="codePostal" placeholder="Aucun" name="codePostal" value="{{ old('codePostal', session('user_data.codePostal')) }}">
                       
                           @error('codePostal')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>

                       <div class="mb-3 row">
                           <label for="pays" class="col-3" >Pays :</label>
                           <input type="text" class="col-9" id="pays" placeholder="Aucun" name="pays" value="{{ old('pays', session('user_data.pays')) }}">
                       
                           @error('pays')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>
                       
                       <span class="sousTitres">Autres</span>
                       <div class="mb-3 row">
                           <label for="site" class="col-3" >Site web :</label>
                           <input type="text" class="col-9" id="site" placeholder="Aucun" name="site" value="{{ old('site', session('user_data.site')) }}">
                       
                           @error('site')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>

                       <div class="mb-3 row">
                           <label for="numTel" class="col-3">Numéro de téléphone :</label>
                           <input type="text" class="col-9" id="numTel" placeholder="Aucun" name="numTel" value="{{ old('numTel', session('user_data.numTel')) }}">
                           
                           @error('numTel')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                       
                       </div>


                       <!---------------------------SECTION CONTACTS------------------------>
                       <p class="col-12 text-center my-3 titre">Contact(s) rejoignable(s)</p>
                        
                        <span class="sousTitres">Information contact</span>
                        <div class="mb-3 row">
                            <label for="prenom" class="col-3">Prénom : </label>
                            <input type="text" class="col-9" id="prenom" placeholder="Aucun" name="prenom" value="{{ old('prenom', session('user_data.prenom')) }}">
                        
                            @error('prenom')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3 row">
                            <label for="nom" class="col-3">Nom : </label>
                            <input type="text" class="col-9" id="nom" placeholder="Aucun" name="nom" value="{{ old('nom', session('user_data.nom')) }}">
                        
                            @error('nom')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3 row">
                            <label for="poste" class="col-3">Poste/Fonction :</label>
                            <input type="text" class="col-9" id="poste" placeholder="Aucun" name="poste" value="{{ old('poste', session('user_data.poste')) }}">
                        
                            @error('poste')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>

                        <div class="mb-3 row">
                            <label for="courrielContact" class="col-3">Courriel :</label>
                            <input type="email" class="col-9" id="courrielContact" placeholder="Aucun" name="courrielContact" value="{{ old('courrielContact', session('user_data.courrielContact')) }}">
                        
                            @error('courrielContact')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>

                        <div class="mb-3 row">
                            <label for="numContact" class="col-3">Numéro de téléphone :</label>
                            <input type="text" class="col-9" id="numContact" placeholder="Aucun" name="numContact" value="{{ old('numContact', session('user_data.numContact')) }}">
                        
                            @error('numContact')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div> 

                        <!--<p class="col-12 text-center my-3 titre">Contact(s) rejoignable(s)</p>

                        <span class="sousTitres">Information contact</span>

                         Vérifie si des contacts existent dans la session 
                        @if(session('user_data.contacts'))
                            @foreach(session('user_data.contacts') as $index => $contact)
                                <fieldset disabled>
                                    <div class="mb-3 row">
                                        <label for="prenom_{{ $index }}" class="col-3">Prénom :</label>
                                        <input type="text" class="col-9" id="prenom_{{ $index }}" placeholder="Aucun" name="prenom[]" value="{{ old('prenom.' . $index, $contact['prenom']) }}">
                                        @error('prenom.' . $index)
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="nom_{{ $index }}" class="col-3">Nom :</label>
                                        <input type="text" class="col-9" id="nom_{{ $index }}" placeholder="Aucun" name="nom[]" value="{{ old('nom.' . $index, $contact['nom']) }}">
                                        @error('nom.' . $index)
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="poste_{{ $index }}" class="col-3">Poste/Fonction :</label>
                                        <input type="text" class="col-9" id="poste_{{ $index }}" placeholder="Aucun" name="poste[]" value="{{ old('poste.' . $index, $contact['poste']) }}">
                                        @error('poste.' . $index)
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="courrielContact_{{ $index }}" class="col-3">Courriel :</label>
                                        <input type="email" class="col-9" id="courrielContact_{{ $index }}" placeholder="Aucun" name="courrielContact[]" value="{{ old('courrielContact.' . $index, $contact['courrielContact']) }}">
                                        @error('courrielContact.' . $index)
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="numContact_{{ $index }}" class="col-3">Numéro de téléphone :</label>
                                        <input type="text" class="col-9" id="numContact_{{ $index }}" placeholder="Aucun" name="numContact[]" value="{{ old('numContact.' . $index, $contact['numContact']) }}">
                                        @error('numContact.' . $index)
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </fieldset>
                            @endforeach
                        @else
                            <p>Aucun contact n'a été ajouté.</p>
                        @endif -->

                       <!---------------------------SECTION RBQ ET FICHIERS--------------------------->
                    
                    </fieldset>
                    
                    <div class="row d-flex justify-content-center">
                        <a class="btn btn-primary mb-3 col-auto precedent" href="{{ route('Inscription.RBQ') }}">Précédent</a>
                        <button type="submit" class="btn btn-primary mb-3 mx-3 col-auto">Confirmer et envoyer le formulaire</button>
                    </div>
                
                </div>
                


                
            </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>