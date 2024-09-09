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

            <div>
                <p class="a">AlumniSans-Medium</p> </br>
                <p class="b">AlumniSans-ExtraBold</p> </br>

                <p class="c">Poppins-Light</p> </br>
                <p class="d">Poppins-Medium</p> </br>
                <p class="e">Poppins-Bold</p> </br>
            </div>

            <form>
                <div class="container">
                    <div>
                        <p class="col-12 text-center my-3 titre">Information de votre entreprise</p>
                        
                        <span class="sousTitres">Identification</span>
                        <div class="mb-3 row">
                            <label class="col-3">Nom du fournisseur :</label>
                            <input type="text" class="col-9">
                        </div>

                        <div class="mb-3 row">
                            <label class="col-3">Numéro d'entreprise (NEQ) :</label>
                            <input type="text" class="col-9">
                        </div>

                        <span class="sousTitres">Coordonnées</span>
                        <div class="mb-3 row">
                            <label class="col-3">Adresse :</label>
                            <input type="text" class="col-9">
                        </div>

                        <div class="mb-3 row">
                            <label class="col-3">Numéro de téléphone :</label>
                            <input type="text" class="col-9">
                        </div>

                        <div class="mb-3 row">
                            <label class="col-3">Site web :</label>
                            <input type="text" class="col-9">
                        </div>

                        <span class="sousTitres">Contacts</span>
                        <div class="mb-3 row">
                            <label class="col-3">Personne ressource :</label>
                            <input type="text" class="col-9">
                        </div>

                        <div class="mb-3 row">
                            <label class="col-3">Poste occupé au sein de l'entreprise :</label>
                            <input type="text" class="col-9">
                        </div>

                        <div class="mb-3 row">
                            <label class="col-3">Courriel de la personne ressource :</label>
                            <input type="text" class="col-9">
                        </div>


                        <p class="col-12 text-center my-3 titre">Descriptions des produits et services offerts</p>
                        <div class="mb-3 row">
                            <label class="col-3">Produits / Services :</label>
                            <textarea placeholder="Description des produits/services offerts." class="col-9 description"></textarea>
                        </div>

                        <div class="row">
                            <button type="submit" class="btn btn-primary mb-3 col-auto">Envoyer</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
