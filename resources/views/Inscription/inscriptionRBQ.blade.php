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
            <form method="post" action="{{ route('Inscription.store') }}">
                @csrf
                <div class="container-fluid">
                
                        <span class="sousTitres">Autres</span>
                        <div class="mb-3 row">
                            <label for="rbq" class="col-3">Licence(s) RBQ valide(s) :</label>
                            <input type="text" class="col-9" id="rbq" placeholder="???" name="rbq" value="{{ old('rbq') }}">
                        
                            @error('rbq')
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
                            <button type="submit" class="btn btn-primary mb-3 col-auto">Réviser les informations fournies</button>
                            <button class="btn btn-primary mb-3 col-auto"><a>Précédent</a></button>
                        </div>
                    
                </div>
            </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
