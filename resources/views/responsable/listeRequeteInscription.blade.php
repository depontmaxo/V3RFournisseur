@extends('layouts.app')
 
@section('titre', 'Requêtes inscription')
  
@section('contenu')

@if (Auth::guard('user')->check() && (Auth::guard('user')->user()->role == 'commis' || Auth::guard('user')->user()->role == 'responsable'))

    <body>
    <h2>Liste des candidats:</h2>

        <form method="get" action="/responsable/rechercheCandidat" style="display-flex">
            @csrf
            <label for="nom">Nom :</label>
            <input type="checkbox" id="nom" name="nom"/>
            <label for="neq">NEQ :</label>
            <input type="checkbox" id="neq" name="neq"/>
            <label for="courriel">Courriel :</label>
            <input type="checkbox" id="courriel" name="courriel"/>


            <input type="text" placeholder="Rechercher" id="recherche" name="recherche"/>
            <button class="btn btn-primary no-border-button" type="submit">Rechercher</button>
        </form>


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
                    @if (isset($candidats))
                        @foreach ($candidats as $candidat)
                        <tr>
                            <th>{{ $test++ }}</th>
                            <td>{{ $candidat->nom_entreprise }}</td>
                            <td>{{ $candidat->neq }}</td>
                            <td>{{ $candidat->email }}</td>
                            <td><a href="{{ route('Responsable.visualiserCandidat', [$candidat]) }}">Évaluer</a></td>
                        </tr>
                        
                        @endforeach
                    @else
                        <p>Aucune requête d'inscription pour le moment</p>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
                    {{ $candidats->links() }}
        </div>
    </body>
@else
    <script>
        window.location.href = '{{ route("RefusAccess") }}';
    </script>
@endif

@endsection