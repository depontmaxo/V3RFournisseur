<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de mail</title>
</head>
<body>
    <h1>{{ $nom_entreprise }}, Svp reinitialiser votre mot de passe</h1>

    <p>Nous avons recu votre demande de changement de mot de passe.
        Si vous n'etes pas a l'origine de cette requete, laissez nous savoir pour la securite de votre compte.
    <br>Si vous etes a l'origine cliquez sur le lien ci dessous pour changer de mot de passe<br>
    <a href="{{route('app_changepassword',['token' => $activation_token])  }}" target="_blank">Changez de mot de passe</a>
    </p>

    <p>
        V3RFournisseur team.
    </p>

</body>
</html>
