@extends('layouts.app')
 
@section('titre', 'Statut demande inscription')
  
@section('contenu')

@if (Auth::guard('web')->check())

    <body>
        <div class="page-header">
            <h1 class="titre-medium">Statut de votre demande</h1>
            <p class="texte">Vérifiez l'état actuel de votre demande d'inscription et suivez sa progression.</p>
        </div>

        <div class="status-container">
            <!-- Pending -->
            @if (isset( $utilisateur))
                @if ($utilisateur->statut == 'En attente')
                <div class="status-card pending">
                    <i class="fas fa-clock"></i>
                    <h3 class="soustitre">En attente d'approbation</h3>
                    <p class="texte">Votre demande est en attente d'approbation. S'il vous plaît soyez patient.</p>
                </div>
                
                <!-- Accepted -->
                @elseif ($utilisateur->statut == 'Actif' || $utilisateur->statut == 'Inactif')
                <div class="status-card accepted">
                    <i class="fas fa-check-circle"></i>
                    <h3 class="soustitre">Accepté</h3>
                    <p class="texte">Félicitations! Votre demande a été acceptée.</p>
                </div>
                
                <!-- Refused -->
                @elseif ($utilisateur->statut == 'Refusé')
                <div class="status-card refused">
                    <i class="fas fa-times-circle"></i>
                    <h3 class="soustitre">Refusé</h3>
                    <p class="texte">Malheureusement, votre demande a été refusée.</p>
                </div>
                @endif
            @endif
        </div>

        <div class="status-info">
            <h4 class="soustitre">Que signifie chaque statut?</h4>
            <ul>
                <li><strong >En attente d'approbation: </strong> Votre demande est en attente d'examen. S'il vous plaît soyez patient.</li>
                <li><strong>Accepté: </strong> Votre demande a été approuvée! Félicitations.</li>
                <li><strong>Refusé: </strong> Malheureusement, votre demande a été rejetée.</li>
            </ul>
        </div>

        <div class="cta-container">
            <p>Pour plus d'aide concernant votre demande, veuillez contacter notre support</p>
            <a href="https://www.v3r.net/nous-joindre" class="cta-button">Contacter Support</a>
        </div>

    </body>

@else
    <script>
        window.location.href = '{{ route("RefusAccess") }}';
    </script>
@endif

@endsection