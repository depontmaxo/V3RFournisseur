@extends('layouts.inscriptionLayout')
 
@section('titre', 'Produits ou services offerts')

@section('contenu')
<body>
    <div class="container form-box">
        <div class="bg-titre">
            <div class="titre">Descriptions des produits et services offerts</div>
        </div>

        <div class="form">
            <form method="post" action="{{ route('Inscription.verificationProduits') }}">
                @csrf
                <div class="container-fluid">
                    <span class="sousTitres">Produits ou services offerts</span>
                    
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

                    <div class="d-flex justify-content-center">
                        <a class="btn btn-custom" href="{{ route('Inscription.Identification') }}">Précédent</a>
                        <button type="submit" class="btn btn-custom">Suivant</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
