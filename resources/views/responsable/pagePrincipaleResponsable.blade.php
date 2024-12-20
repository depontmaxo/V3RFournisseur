@extends('layouts.app')
 
@section('titre', 'Index Responsable')
  
@section('contenu')

@if (Auth::guard('user')->check() && (Auth::guard('user')->user()->role == 'commis' || Auth::guard('user')->user()->role == 'responsable'))

    <body>
        <h2>Liste des fournisseurs:</h2>

        <form method="get" action="/responsable/rechercheFournisseur" style="display-flex">
            @csrf
            <label for="nom">Nom Entreprise:</label>
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
                <!-- Rechercher, trier et sélectionner des fiches de fournisseurs par ville, région, produits et services -->
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Entreprise</th>
                    <th scope="col">Courriel</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Province</th>
                    <th scope="col">Catégorie de production</th>
                    <th scope="col">Visualiser</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $test = 1;
                    ?>
                    @if (count($utilisateurs))
                        @foreach ($utilisateurs as $utilisateur)
                        <tr>
                            <th>{{ $test++ }}</th>
                            <td>{{ $utilisateur->nom_entreprise }}</td>
                            <td>{{ $utilisateur->email }}</td>
                            <td>{{ $utilisateur->coordonnees->ville ?? 'N/A' }}</td></td>
                            <td>{{ $utilisateur->coordonnees->province ?? 'N/A' }}</td></td>
                            <td>{{ $utilisateur->most_common_category->desc_cat ?? 'N/A' }}</td></td>
                            <td><a href="{{ route('Fournisseur.fiche', [$utilisateur]) }}">Ouvrir</a></td>
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
                    {{ $utilisateurs->links() }}
        </div>
    </body>


@else
    <script>
        window.location.href = '{{ route("RefusAccess") }}';
    </script>
@endif
@endsection