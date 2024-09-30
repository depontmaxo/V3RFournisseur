@extends('layouts.app')
 
@section('titre', 'Index')
  
@section('contenu')
@if (auth()->user() !== null) 
    <!-- tout le site ici -->
    <body>
        <nav class="sub-nav">
            <form action="{{ route('logout') }}" method="post">
            @csrf
            <button id="bouton1" type="submit">Déconnecter</button>
            </form>
        </nav>

        <h1>Page Index Fournisseur</h1>

        <a href="{{route('Fournisseur.fiche', [auth()->user()->id])}}">Afficher ma fiche fournisseur</a>
        </br>
        <a onclick="return confirm('Êtes-vous sûr de rendre votre compte inactif?')" href="{{ route('Fournisseur.inactif', [auth()->user()->id]) }}">
        Retirer sa fiche fournisseur
        </a>
        </br> 
        <a>Liste des contrats disponible (afficher sur la page)</a>
        </br>
        <a>Historique de mes contracts</a>
        </br>
        <a>Contact support</a>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        @if (Auth::user()->role == 'responsable')
            <a href="{{route('Responsable.index')}}">Mode Responsable</a>
        @else
        @endif
        </br>
        </br>
        </br>
        </br>

    </body>   
    
@else
    <p>Accès non authorisé</p>
@endif
@endsection