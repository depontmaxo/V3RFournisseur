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


    
@endif
@endsection