@extends('layouts.app')
 
@section('titre', 'Requêtes inscription')
  
@section('contenu')
<body>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Entreprise</th>
                <th scope="col">Visualiser</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $test = 1;
                ?>
                @if (count($candidats))
                    @foreach ($candidats as $candidat)
                    <tr>
                        <th>{{ $test++ }}</th>
                        <td>{{ $candidat->prenom }}</td>
                        <td>{{ $candidat->nom }}</td>
                        <td>{{ $candidat->entreprise }}</td>
                        <td><a href="{{ route('Fournisseur.visualiserCandidat', [$candidat]) }}">Évaluer</a></td>
                    </tr>
                    
                    @endforeach
                @else
                    <p>Aucune requête d'inscription pour le moment</p>
                @endif
            </tbody>
        </table>
    </div>


</body>
@endsection