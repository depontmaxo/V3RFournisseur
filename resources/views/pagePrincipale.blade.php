@extends('layouts.app')
 
@section('titre', 'Index')
  
@section('contenu')
@if (auth()->user() !== null) 
    <!-- tout le site ici -->
    <h1>Page Index Fournisseur</h1>

    <a href="{{route('Fournisseur.fiche', [auth()->user()->id])}}">Afficher ma fiche fournisseur</a>
    </br>
    <a onclick="return confirm('Êtes-vous sûr de rendre votre compte inactif?')" href="{{ route('Fournisseur.inactif', [auth()->user()->id]) }}">
    Retirer sa fiche fournisseur
    </a>
    </br>

    <div class="rechercheUNSPSC">
        <!-- Search Form -->
        <form method="get" action="/index/unspsc/recherche" style="display-flex">
            @csrf
            <label for="nature_contrat">Nature :</label>
            <input type="checkbox" id="nature_contrat" name="nature_contrat" {{ request()->has('nature_contrat') ? 'checked' : '' }} />
            
            <label for="code_unspsc">Code UNSPSC :</label>
            <input type="checkbox" id="code_unspsc" name="code_unspsc" {{ request()->has('code_unspsc') ? 'checked' : '' }} />
            
            <label for="desc_det_unspsc">Description :</label>
            <input type="checkbox" id="desc_det_unspsc" name="desc_det_unspsc" {{ request()->has('desc_det_unspsc') ? 'checked' : '' }} />

            <input type="text" placeholder="Rechercher" id="recherche" name="recherche" value="{{ request('recherche') }}" />
            <button class="btn btn-primary no-border-button" type="submit">Rechercher</button>
        </form>

        <!-- Selection Form -->
        <form method="get" action="/index/unspsc/choisit" style="display-flex">
            @csrf
            <p>Nature / Code UNSPSC / Description</p>

            <!-- Display the List of UNSPSC Codes with Their Selection State Preserved -->
            @foreach ($codeUNSPSCunite as $unscpsc)
                <div class="decisionUNSPSC">
                    <input type="checkbox" 
                        id="code_unspsc_choisit_{{ $unscpsc->code_unspsc }}" 
                        name="code_unspsc_choisit[]" 
                        value="{{ $unscpsc->code_unspsc }}" 
                        {{ in_array($unscpsc->code_unspsc, request('code_unspsc_choisit', [])) ? 'checked' : '' }}> <!-- Check if the code is selected -->
                    <p class="pUNSPSC">{{ $unscpsc->nature_contrat }} / {{ $unscpsc->code_unspsc }} / {{ $unscpsc->desc_det_unspsc }}</p>
                </div>
            @endforeach

            <!-- Pagination Links -->
            <div class="d-flex justify-content-between custom-pagination">
                {{ $codeUNSPSCunite->withQueryString()->links('pagination::bootstrap-4') }}
            </div>

            <button class="btn btn-primary no-border-button" type="submit">Complété sélection de mes codes UNSPSC</button>
        </form>
    </div>

   



    
@endif
@endsection