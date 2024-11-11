@extends('layouts.app')
 
@section('titre', 'Index')
  
@section('contenu')
@if (auth()->user() !== null) 
    <!-- tout le site ici -->
    <h1>Ressource</h1>

    <p>Email : support@test.com</p>
    <p>Téléphone de support : 123-123-1234</p>
@endif
@endsection
