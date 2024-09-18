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
        <div>
            <!--

            <div>
                <p class="a">AlumniSans-Medium</p> </br>
                <p class="b">AlumniSans-ExtraBold</p> </br>

                <p class="c">Poppins-Light</p> </br>
                <p class="d">Poppins-Medium</p> </br>
                <p class="e">Poppins-Bold</p> </br>
            </div>
            

            @if(isset($errors) && $errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            
            @if(session('message'))
            <div class="alert alert-success">
                <p>{{ session('message') }}</p>
            </div>
            @endif

            -->

            <form method="post" action="{{ route('Inscription.store') }}">
                @csrf
                <div class="container">
                    <div>
                        <p class="col-12 text-center my-3 titre">Information de votre entreprise</p>
                        
                        <span class="sousTitres">Identification</span>
                        <div class="mb-3 row">
                            <label for="nom" class="col-3" >Nom du fournisseur :</label>
                            <input type="text" class="col-9" id="nom" placeholder="exemple: Liam Turner" name="nom" value="{{ old('nom') }}">
                            @error('nom')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        

                        <div class="mb-3 row">
                            <label for="neq" class="col-3" >Numéro d'entreprise (NEQ) :</label>
                            <input type="text" class="col-9" id="neq" placeholder="12345678910" name="neq" value="{{ old('neq') }}">
                        
                            @error('neq')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        
                        </div>

                        <span class="sousTitres">Coordonnées</span>
                        <!--Adresse
                        <div class="mb-3">
                            <label for="adresse" class="col-3" >Adresse :</label>
                            <input type="text" class="col-9" id="adresse" placeholder="123 Street" name="adresse">
                        </div>

                        <div class="mb-3">
                            <label for="ville" class="col-3" >Ville :</label>
                            <input type="text" class="col-9" id="ville" placeholder="123 Street" name="ville">
                        </div>

                        <div class="mb-3">
                            <label for="codePostal" class="col-3" >Code postal :</label>
                            <input type="text" class="col-9" id="codePostal" placeholder="123 Street" name="codePostal">
                        </div>
                        --------------------------------------------->

                        <div class="mb-3 row">
                            <label for="numTel" class="col-3">Numéro de téléphone :</label>
                            <input type="text" class="col-9" id="numTel" placeholder="(819)123-4567" name="numTel" value="{{ old('numTel') }}">
                            
                            @error('numTel')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>

                        <div class="mb-3 row">
                            <label for="site" class="col-3">Site web :</label>
                            <input type="text" class="col-9" id="site" placeholder="Lien URL?" name="site" value="{{ old('site') }}">
                        
                            @error('site')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <span class="sousTitres">Contacts</span>
                        <div class="mb-3 row">
                            <label for="nomContact" class="col-3">Personne ressource :</label>
                            <input type="text" class="col-9" id="nomContact" placeholder="exemple: Liam Turner" name="nomContact" value="{{ old('nomContact') }}">
                        
                            @error('nomContact')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3 row">
                            <label for="poste" class="col-3">Poste occupé au sein de l'entreprise :</label>
                            <input type="text" class="col-9" id="poste" placeholder="Chef administration" name="poste" value="{{ old('poste') }}">
                        
                            @error('poste')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>

                        <div class="mb-3 row">
                            <label for="courriel" class="col-3">Courriel de la personne ressource :</label>
                            <input type="text" class="col-9" id="courriel" placeholder="exemple@gmail.com" name="courriel" value="{{ old('courriel') }}">
                        
                            @error('courriel')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>

                        <span class="sousTitres">Autres</span>
                        <div class="mb-3 row">
                            <label for="rbq" class="col-3">Licence(s) RBQ valide(s) :</label>
                            <input type="text" class="col-9" id="rbq" placeholder="???" name="rbq" value="{{ old('rbq') }}">
                        
                            @error('rbq')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>

                        <p class="col-12 text-center my-3 titre">Descriptions des produits et services offerts</p>
                        <div class="mb-3 row">
                            <label for="services" class="col-3">Produits / Services :</label>
                            <textarea placeholder="Description des produits/services offerts." class="col-9 description" id="services" name="services">{{ old('services') }}</textarea>
                        
                            @error('services')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>

                        <p class="col-12 text-center my-3 titre">Brochures et cartes d'affaires</p>
                        <div class="mb-3 row">
                            <label for="fichiersJoints" class="form-label">Joindres les fichiers (docx, pdf, jpg ou xlsx seulement)</label>
                            <input type="file" class="form-control" id="fichiersJoints" multiple>
                        
                            @error('fichiersJoints')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>

                        <div class="row d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mb-3 col-auto">Confirmer et envoyer le formulaire</button>
                            <p class="text-center"> Vous êtes déjà inscrit? 
                                <a href="{{ route('Connexion.connexionEmail') }}">Se connecter</a> 
                            </p>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
