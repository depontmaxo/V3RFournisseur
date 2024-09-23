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
            <form method="post" action="{{ route('Inscription.verificationProduits') }}">
                @csrf
                <div class="container-fluid">                                           
                        <p class="col-12 text-center my-3 titre">Descriptions des produits et services offerts</p>
                        
                        <div class="mb-3 row">
                            <label for="services" class="col-3">Produits / Services :</label>
                            <textarea placeholder="Description des produits/services offerts." class="col-9 description" id="services" name="services">{{ old('services', session('user_data.services', '')) }}</textarea>
                        
                            @error('services')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        
                        </div>

                        <div class="row d-flex justify-content-center">
                            <a class="btn btn-primary mb-3 col-auto precedent" href="{{ route('Inscription.Identification') }}">Précédent</a>
                            <button type="submit" class="btn btn-primary mb-3 col-auto">Suivant</button>
                            <p class="text-center"> Vous êtes déjà inscrit? 
                                <a href="{{ route('Connexion.connexionEmail') }}">Se connecter</a> 
                            </p>
                        </div>
                    
                </div>
            </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
