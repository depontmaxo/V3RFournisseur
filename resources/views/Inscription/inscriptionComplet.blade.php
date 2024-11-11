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
                        <input type="text" class="col-9" id="entreprise" placeholder="Tech Innovators" name="entreprise" value="{{ old('entreprise', session('user_data.entreprise', '')) }}">
                        
                        @error('entreprise')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                        <div class="mb-3 row">
                            <label for="neq" class="col-3" >Numéro d'entreprise (NEQ) :</label>
                            <input type="text" class="col-9" id="neq" placeholder="12345678910" name="neq" value="{{ old('neq', session('user_data.neq', '')) }}">
                        
                            @error('neq')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                 
                        <span class="sousTitres">Authentification pour connexion</span> 
                        <div class="mb-3 row">
                            <label for="courrielConnexion" class="col-3" >Adresse courriel :</label>
                            <input type="email" class="col-9" id="courrielConnexion" placeholder="example@courriel.com" name="courrielConnexion" value="{{ old('courrielConnexion', session('user_data.courrielConnexion', '')) }}">
                        
                            @error('courrielConnexion')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!---------------------------SECTION PRODUITS/SERVICES--------------------------->
                        <p class="col-12 text-center my-3 titre">Descriptions des produits et services offerts</p>
                        <span class="sousTitres">Produits ou services offerts</span>
                        <div class="mb-3 row">
                            <label for="services" class="col-3">Produits / Services :</label>
                            <textarea placeholder="Description des produits/services offerts." class="col-9 description" id="services" name="services">{{ old('services', session('user_data.services', '')) }}</textarea>
                        
                            @error('services')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>
                    
                        <!---------------------------SECTION COORDONNEES--------------------------->

                        <p class="col-12 text-center my-3 titre">Coordonnées de votre entreprise</p>
                       
                       <span class="sousTitres">Coordonnées</span>

                       <div class="mb-3 row">
                           <label for="adresse" class="col-3" >Adresse :</label>
                           <input type="text" class="col-9" id="adresse" placeholder="123 Street" name="adresse" value="{{ old('adresse', session('user_data.adresse', '')) }}">
                       
                       
                           @error('adresse')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>

                       <div class="mb-3 row">
                           <label for="bureau" class="col-3" >Bureau (optionnel) : </label>
                           <input type="text" class="col-9" id="bureau" placeholder="suite 103" name="bureau" value="{{ old('bureau', session('user_data.bureau', '')) }}">
                       
                           @error('bureau')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>

                       <div class="mb-3 row">
                           <label for="ville" class="col-3" >Ville :</label>
                           <input type="text" class="col-9" id="ville" placeholder="Trois-Rivières" name="ville" value="{{ old('ville', session('user_data.ville')) }}">
                       
                           @error('ville')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>

                       <div class="mb-3 row">
                           <label for="province" class="col-3" >Province :</label>
                           <input type="text" class="col-9" id="province" placeholder="Québec" name="province" value="{{ old('province', session('user_data.province')) }}">
                       
                           @error('province')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>

                       <div class="mb-3 row">
                           <label for="codePostal" class="col-3" >Code postal :</label>
                           <input type="text" class="col-9" id="codePostal" placeholder="123 Street" name="codePostal" value="{{ old('codePostal', session('user_data.codePostal')) }}">
                       
                           @error('codePostal')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>

                       <div class="mb-3 row">
                           <label for="pays" class="col-3" >Pays :</label>
                           <input type="text" class="col-9" id="pays" placeholder="123 Street" name="pays" value="{{ old('pays', session('user_data.pays')) }}">
                       
                           @error('pays')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>
                       
                       <span class="sousTitres">Autres</span>
                       <div class="mb-3 row">
                           <label for="site" class="col-3" >Site web :</label>
                           <input type="text" class="col-9" id="site" placeholder="Lien URL" name="site" value="{{ old('site', session('user_data.site')) }}">
                       
                           @error('site')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>

                       <div class="mb-3 row">
                           <label for="numTel" class="col-3">Numéro de téléphone :</label>
                           <input type="text" class="col-9" id="numTel" placeholder="(819)123-4567" name="numTel" value="{{ old('numTel', session('user_data.numTel')) }}">
                           
                           @error('numTel')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                       
                       </div>


                       <!---------------------------SECTION CONTACTS------------------------>
                       <p class="col-12 text-center my-3 titre">Contact(s) rejoignable(s)</p>
                        
                        <span class="sousTitres">Information contact</span>
                        <div class="mb-3 row">
                            <label for="prenom" class="col-3">Prénom : </label>
                            <input type="text" class="col-9" id="prenom" placeholder="exemple: Connor" name="prenom" value="{{ old('prenom', session('user_data.prenom')) }}">
                        
                            @error('prenom')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3 row">
                            <label for="nom" class="col-3">Nom : </label>
                            <input type="text" class="col-9" id="nom" placeholder="exemple: McDavid" name="nom" value="{{ old('nom', session('user_data.nom')) }}">
                        
                            @error('nom')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3 row">
                            <label for="poste" class="col-3">Poste/Fonction :</label>
                            <input type="text" class="col-9" id="poste" placeholder="Chef administration" name="poste" value="{{ old('poste', session('user_data.poste')) }}">
                        
                            @error('poste')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>

                        <div class="mb-3 row">
                            <label for="courrielContact" class="col-3">Courriel :</label>
                            <input type="email" class="col-9" id="courrielContact" placeholder="exemple@gmail.com" name="courrielContact" value="{{ old('courrielContact', session('user_data.courrielContact')) }}">
                        
                            @error('courrielContact')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>

                        <div class="mb-3 row">
                            <label for="numContact" class="col-3">Numéro de téléphone :</label>
                            <input type="text" class="col-9" id="numContact" placeholder="(819)123-4567" name="numContact" value="{{ old('numContact', session('user_data.numContact')) }}">
                        
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
                                        <input type="text" class="col-9" id="prenom_{{ $index }}" placeholder="exemple: Connor" name="prenom[]" value="{{ old('prenom.' . $index, $contact['prenom']) }}">
                                        @error('prenom.' . $index)
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="nom_{{ $index }}" class="col-3">Nom :</label>
                                        <input type="text" class="col-9" id="nom_{{ $index }}" placeholder="exemple: McDavid" name="nom[]" value="{{ old('nom.' . $index, $contact['nom']) }}">
                                        @error('nom.' . $index)
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="poste_{{ $index }}" class="col-3">Poste/Fonction :</label>
                                        <input type="text" class="col-9" id="poste_{{ $index }}" placeholder="Chef administration" name="poste[]" value="{{ old('poste.' . $index, $contact['poste']) }}">
                                        @error('poste.' . $index)
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="courrielContact_{{ $index }}" class="col-3">Courriel :</label>
                                        <input type="email" class="col-9" id="courrielContact_{{ $index }}" placeholder="exemple@gmail.com" name="courrielContact[]" value="{{ old('courrielContact.' . $index, $contact['courrielContact']) }}">
                                        @error('courrielContact.' . $index)
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="numContact_{{ $index }}" class="col-3">Numéro de téléphone :</label>
                                        <input type="text" class="col-9" id="numContact_{{ $index }}" placeholder="(819)123-4567" name="numContact[]" value="{{ old('numContact.' . $index, $contact['numContact']) }}">
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