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



        <form method="get" action="/unspsc/recherche" style="display-flex">
            @csrf
            <label for="code_unspsc">Code UNSPSC :</label>
            <input type="checkbox" id="code_unspsc" name="code_unspsc"/>
            <label for="desc_det_unspsc">Description :</label>
            <input type="checkbox" id="desc_det_unspsc" name="desc_det_unspsc"/>
            <label for="nature">Nature :</label>
            <input type="checkbox" id="nature" name="nature"/>


            <input type="text" placeholder="Rechercher" id="recherche" name="recherche"/>
            <button class="btn btn-primary no-border-button" type="submit">Rechercher</button>
        </form>

        <p>Nature / Code UNSPSC / Description</p>
        @foreach ($codeUNSPSCunite as $unscpsc)
            <p>{{ $unscpsc->nature_contrat }} / {{ $unscpsc->code_unspsc }} / {{ $unscpsc->desc_det_unspsc }}</p>
        @endforeach
        
        <!-- Pagination Links -->
        <div class="d-flex justify-content-between custom-pagination">
            {{ $codeUNSPSCunite->withQueryString()->links('pagination::bootstrap-4')}}
        </div>

    
@endif
@endsection