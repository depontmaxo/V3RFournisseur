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
            <form method="post" action="{{ route('Inscription.verificationCoordonnees') }}">
                @csrf
                <div class="container-fluid">
                    <!--Si on a le temps, essaye de le faire recherche sur google map pour autoremplir infos-->

                    <p class="col-12 text-center my-3 titre">Information de votre entreprise</p>
                       
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


                       <div class="row d-flex justify-content-center">
                            <a class="btn btn-primary mb-3 col-auto precedent" href="{{ route('Inscription.Produits') }}">Précédent</a>
                           <button type="submit" class="btn btn-primary mb-3 col-auto">Suivant</button>
                       </div>
                    
                </div>
            </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
