<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Connexion</title>
    </head>
    <body>
        <header>
            <div>
                <h5 class="compagny">Fournisseur</h5>
            </div>
            <nav class="sub-nav">                
                <a>Créer un compte</a>  
            </nav>    
        </header>
        
        <div>
            <h1>Connexion</h1>
        </div>
        <div class="container-fluid text-center">
            <h1 class="titre2">Connexion</h1>
        </div>
        <form method="post" action="{{ route('Tutorat.index_login') }}">
            @csrf
            <div class="d-flex row justify-content-center py-5">
                <div class="form-group">
                <label for="email" class="titre2">Email</label>
                <input type="email" class="form-control" id="email" placeholder="email" name="email">
                </div> 
                <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <label for="password" class="titre2">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="password" name="password">
                </div> 
                </div> 
                <div class="d-flex row justify-content-center">
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary">Connexion</button>
                </div> 
            </div> 
        </form>

    </body>
</html>
