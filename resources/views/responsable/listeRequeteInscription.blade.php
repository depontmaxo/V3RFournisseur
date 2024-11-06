@extends('layouts.app')
 
@section('titre', 'Requêtes inscription')
  
@section('contenu')
<body>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Entreprise</th>
                <th scope="col">NEQ</th>
                <th scope="col">Courriel</th>
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
                        <td>{{ $candidat->nom_entreprise }}</td>
                        <td>{{ $candidat->neq }}</td>
                        <td>{{ $candidat->email }}</td>
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