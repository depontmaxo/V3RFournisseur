<!--
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


                    <p class="col-12 text-center my-3 titre">Coordonnées de votre entreprise</p>
                       
                       <span class="sousTitres">Coordonnées</span>

                       <div class="mb-3 row">

                            <div class="col-12 col-md-4 mb-2">
                                <label for="Ncivique" class="form-label">N° Civique</label>
                                <input type="text" class="form-control" id="Ncivique" placeholder="123 Street" name="Ncivique" value="{{ old('Ncivique', session('user_data.Ncivique', '')) }}">
                                

                                @error('Ncivique')
                                    <div class="alert alert-danger d-flex align-items-center mt-2">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>


                            <div class="col-12 col-md-4 mb-2">
                                <label for="rue" class="form-label">Rue :</label>
                                <input type="text" class="form-control" id="rue" placeholder="123 Street" name="rue" value="{{ old('rue', session('user_data.rue', '')) }}">
                                

                                @error('rue')
                                    <div class="alert alert-danger d-flex align-items-center mt-2">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            

                            <div class="col-12 col-md-4 mb-2">
                                <label for="bureau" class="form-label">Bureau :</label>
                                <input type="text" class="form-control" id="bureau" placeholder="Optionnel" name="bureau" value="{{ old('bureau', session('user_data.bureau', '')) }}">
                                

                                @error('bureau')
                                    <div class="alert alert-danger d-flex align-items-center mt-2">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>


                            @error('adresse')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
-->
                        <!--<div class="mb-3 row">
                           <label for="adresse" class="col-3" >Adresse :</label>
                           <input type="text" class="col-9" id="adresse" placeholder="123 Street" name="adresse" value="{{ old('adresse', session('user_data.adresse', '')) }}">
                       
                           @error('adresse')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>-->


                        <!--Bureau
                       <div class="mb-3 row">
                           <label for="bureau" class="col-3" >Bureau : </label>
                           <input type="text" class="col-9" id="bureau" placeholder="Optionnel" name="bureau" value="{{ old('bureau', session('user_data.bureau', '')) }}">
                       
                           @error('bureau')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>-->
<!--
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
                           <input type="text" class="col-9" id="codePostal" placeholder="A1A 1A1" name="codePostal" value="{{ old('codePostal', session('user_data.codePostal')) }}">
                       
                           @error('codePostal')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>

                       <div class="mb-3 row">
                           <label for="pays" class="col-3" >Pays :</label>
                           <input type="text" class="col-9" id="pays" placeholder="Canada" name="pays" value="{{ old('pays', session('user_data.pays')) }}">
                       
                           @error('pays')
                               <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>
                       
                       <span class="sousTitres">Autres</span>
                       <div class="mb-3 row">
                           <label for="site" class="col-3" >Site web :</label>
                           <input type="text" class="col-9" id="site" placeholder="Optionnel" name="site" value="{{ old('site', session('user_data.site')) }}">
                       
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
                           <button type="submit" class="btn btn-primary mb-3 mx-3 col-auto">Suivant</button>
                       </div>
                    
                </div>
            </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
-->



@extends('layouts.inscriptionLayout')
 
@section('titre', 'Coordonnées')

@section('contenu')
<body>
    <div class="container form-box">
        <div class="bg-titre">
            <div class="titre">Coordonnées de votre entreprise</div>
        </div>

        <div class="form">
            <form method="post" action="{{ route('Inscription.verificationCoordonnees') }}">
                @csrf
                <div class="container-fluid">
                    <span class="sousTitres">Emplacement de l'entreprise</span>

                    <div class="mb-3" style="position:relative;">

                        <!--<label for="entreprise" class="form-label txtPop">
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
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror-->

                        <div class="col-12 col-md-4 mb-2">
                            <label for="Ncivique" class="form-label">N° Civique</label>
                            <input type="text" class="form-control" id="Ncivique" placeholder="123 Street" name="Ncivique" value="{{ old('Ncivique', session('user_data.Ncivique', '')) }}">
                            

                            @error('Ncivique')
                                <div class="alert alert-danger d-flex align-items-center mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>


                        <div class="col-12 col-md-4 mb-2">
                            <label for="rue" class="form-label">Rue :</label>
                            <input type="text" class="form-control" id="rue" placeholder="123 Street" name="rue" value="{{ old('rue', session('user_data.rue', '')) }}">
                            

                            @error('rue')
                                <div class="alert alert-danger d-flex align-items-center mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>


                        <div class="col-12 col-md-4 mb-2">
                            <label for="bureau" class="form-label">Bureau :</label>
                            <input type="text" class="form-control" id="bureau" placeholder="Optionnel" name="bureau" value="{{ old('bureau', session('user_data.bureau', '')) }}">
                            

                            @error('bureau')
                                <div class="alert alert-danger d-flex align-items-center mt-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>


                        @error('adresse')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    

                    <div class="d-flex justify-content-center">
                        <a class="btn btn-custom" href="{{ route('Inscription.Produits') }}">Précédent</a>
                        <button type="submit" class="btn btn-custom">Suivant</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
