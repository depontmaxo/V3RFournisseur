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
            <form method="post" action="{{ route('Inscription.verificationContact') }}">
                @csrf
                <div class="container-fluid">
                    
                        <p class="col-12 text-center my-3 titre">Information de votre entreprise</p>
                        
                        <span class="sousTitres">Contacts</span>
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



                        <div class="row d-flex justify-content-center">
                            <a class="btn btn-primary mb-3 col-auto precedent" href="{{ route('Inscription.Coordonnees') }}">Précédent</a>
                           <button type="submit" class="btn btn-primary mb-3 col-auto">Suivant</button>
                       </div>
                    
                </div>
            </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
