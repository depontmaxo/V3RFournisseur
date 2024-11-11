@extends('layouts.app')
 
@section('titre', 'Index')
  
@section('contenu')
@if (auth()->user() !== null) 
    <!-- tout le site ici -->
    @if (Auth::user()->role == 'responsable' || Auth::user()->role == 'commis')
        <h1>Page Index Responsables</h1>
        <a href="{{route('Responsable.listeFournisseur')}}">Afficher les fournisseurs actifs</a>
        </br>
        <a href="{{route('Responsable.listeInscripton')}}">Afficher la liste des inscriptions</a>
        </br>

    @elseif (Auth::user()->role == 'fournisseur')
        <h1>Page Index Fournisseur</h1>

    <a href="{{route('Fournisseur.fiche', [auth()->user()->id])}}">Afficher ma fiche fournisseur</a>
    </br>
    <a onclick="return confirm('Êtes-vous sûr de rendre votre compte inactif?')" href="{{ route('Fournisseur.inactif', [auth()->user()->id]) }}">
    Retirer sa fiche fournisseur
    </a>


    
@endif
@endsection