<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title", "Inscription")</title>
        <link rel="stylesheet" href="{{ asset('css/inscription.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
    <form method="post" action="{{ route('Inscription.verificationContact') }}">
    @csrf
    <div class="container-fluid">
        <p class="col-12 text-center my-3 titre">Contact(s) rejoignable(s)</p>
        <span class="sousTitres">Information contact</span>

        <div id="contacts">
            <div class="contact mb-3">
                <div class="row">
                    <label for="prenom[]" class="col-3">Prénom :</label>
                    <input type="text" class="col-9" name="prenom[]" placeholder="exemple: Connor" value="{{ old('prenom.0', session('user_data.prenom.0')) }}">
                    @error('prenom.*')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <label for="nom[]" class="col-3">Nom :</label>
                    <input type="text" class="col-9" name="nom[]" placeholder="exemple: McDavid" value="{{ old('nom.0', session('user_data.nom.0')) }}">
                    @error('nom.*')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <label for="poste[]" class="col-3">Poste/Fonction :</label>
                    <input type="text" class="col-9" name="poste[]" placeholder="Chef administration" value="{{ old('poste.0', session('user_data.poste.0')) }}">
                    @error('poste.*')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <label for="courrielContact[]" class="col-3">Courriel :</label>
                    <input type="email" class="col-9" name="courrielContact[]" placeholder="exemple@gmail.com" value="{{ old('courrielContact.0', session('user_data.courrielContact.0')) }}">
                    @error('courrielContact.*')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <label for="numContact[]" class="col-3">Numéro de téléphone :</label>
                    <input type="text" class="col-9" name="numContact[]" placeholder="(819)123-4567" value="{{ old('numContact.0', session('user_data.numContact.0')) }}">
                    @error('numContact.*')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <button type="button" onclick="addContact()">Ajouter un autre contact</button>

        <div class="row d-flex justify-content-center">
            <a class="btn btn-primary mb-3 col-auto precedent" href="{{ route('Inscription.Coordonnees') }}">Précédent</a>
            <button type="submit" class="btn btn-primary mb-3 col-auto">Suivant</button>
        </div>
    </div>
</form>

<script>
    function addContact() {
        const contactsDiv = document.getElementById('contacts');
        const index = contactsDiv.children.length; // Obtenir l'index du nouveau contact
        const newContact = `
            <div class="contact mb-3">
                <div class="row">
                    <label for="prenom[]" class="col-3">Prénom :</label>
                    <input type="text" class="col-9" name="prenom[]" placeholder="exemple: Connor">
                </div>
                <div class="row">
                    <label for="nom[]" class="col-3">Nom :</label>
                    <input type="text" class="col-9" name="nom[]" placeholder="exemple: McDavid">
                </div>
                <div class="row">
                    <label for="poste[]" class="col-3">Poste/Fonction :</label>
                    <input type="text" class="col-9" name="poste[]" placeholder="Chef administration">
                </div>
                <div class="row">
                    <label for="courrielContact[]" class="col-3">Courriel :</label>
                    <input type="email" class="col-9" name="courrielContact[]" placeholder="exemple@gmail.com">
                </div>
                <div class="row">
                    <label for="numContact[]" class="col-3">Numéro de téléphone :</label>
                    <input type="text" class="col-9" name="numContact[]" placeholder="(819)123-4567">
                </div>
            </div>
        `;
        contactsDiv.insertAdjacentHTML('beforeend', newContact);
    }
</script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>