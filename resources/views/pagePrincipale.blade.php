@extends('layouts.app')
 
@section('titre', 'Page principale')

@push('styles')
    <!-- Page-specific CSS file -->
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
@endpush
  
@section('contenu')

@if (Auth::guard('web')->check())

    <?php
    //dd(Auth::guard('web')->check());
    ?>
    <body>

        <!-- tout le site ici -->
        @if (Auth::user()->role == 'responsable' || Auth::user()->role == 'commis')
            <h1>Page Index Responsables</h1>
            <a href="{{route('Responsable.listeFournisseur')}}">Afficher les fournisseurs actifs</a>
            </br>
            <a href="{{route('Responsable.listeInscripton')}}">Afficher la liste des inscriptions</a>
            </br>

        @else
        <div class="dashboard-container">
            <header class="dashboard-header">
                <h1>Bonjour</h1>
                <p>Bienvenu au portail de connexion des fournisseurs à la ville de Trois-Rivières.</p>
            </header>


            <!-- Next Steps Section -->
            <section class="next-steps">
                <h3>Prochaines étapes</h3>
                <ul>
                    @if(auth()->user()->statut == 'En attente')
                        <li>Vérifiez que toutes vos informations sont complètes.</li>
                        <li>Si nécessaire, téléchargez les documents manquants.</li>
                        <li>Une fois votre demande acceptée, vous recevrez une notification par email.</li>
                    @elseif(auth()->user()->statut == 'Refusé')
                        <li>Votre demande a été rejetée.</li>
                        <li>Nous vous invitons à revoir vos informations et à soumettre à nouveau votre demande.</li>
                    @elseif(auth()->user()->statut == 'Accepté')
                        <li>Votre demande a été acceptée!</li>
                        <li>Vous pouvez maintenant accéder à votre compte fournisseur et commencer à travailler avec nous.</li>
                    @endif
                </ul>
            </section>

            
            <section class="actions">
                <h3>Actions disponibles</h3>
                <ul>
                    <li><a href="{{ route('Fournisseur.fiche', [auth()->user()->id]) }}" class="btn">Voir ma fiche</a></li>
                    <li><a href="{{ route('Fournisseur.statut', [auth()->user()->id]) }}" class="btn">Voir l'état de ma demande</a></li>
                </ul>
            </section>
            <!-- 
            Resources Section 
            <section class="resources">
                <h3>Ressources utiles</h3>
                <ul>
                    <li><a href="#">Guide d'utilisation du formulaire</a></li>
                    <li><a href="#">FAQ sur le processus d'inscription</a></li>
                    <li><a href="mailto:support@v3r.net">Contactez-nous pour de l'aide</a></li>
                </ul>
            </section>

             Testimonials Section 
            <section class="testimonials">
                <h3>Témoignages</h3>
                <blockquote>
                    "Le processus d'inscription a été facile à suivre et rapide. Je suis heureux d'être un fournisseur approuvé !"
                </blockquote>
                <blockquote>
                    "Merci pour la transparence et la clarté des étapes. J'ai été informé à chaque étape de ma demande."
                </blockquote>
            </section>
            -->
        </div>
        @endif

    </body>
@else
    <script>
        window.location.href = '{{ route("RefusAccess") }}';
    </script>
@endif
@endsection