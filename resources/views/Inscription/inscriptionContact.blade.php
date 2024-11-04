<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title", "Inscription")</title>
        <link rel="stylesheet" href="{{ asset('css/inscription.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body onload="loadContacts off()">
    <form method="post" action="{{ route('Inscription.verificationContact') }}">
    @csrf
    <div class="container-fluid">
        <p class="col-12 text-center my-3 titre">Contact(s) rejoignable(s)</p>

        <div id="contacts">
        <div class="contact mb-3">
            <span class="sousTitres">Contact 1</span>
                <div class="row">
                    <label for="prenom" class="col-3">Prénom :</label>
                    <input type="text" class="col-9" name="prenom" placeholder="Connor" value="{{ old('prenom', session('user_data.prenom', '')) }}">
                    @error('prenom')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <label for="nom" class="col-3">Nom :</label>
                    <input type="text" class="col-9" name="nom" placeholder="McDavid" value="{{ old('nom', session('user_data.nom', '')) }}">
                    @error('nom')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <label for="poste" class="col-3">Poste/Fonction :</label>
                    <input type="text" class="col-9" name="poste" placeholder="Centre" value="{{ old('poste', session('user_data.poste', '')) }}">
                    @error('poste')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <label for="courrielContact" class="col-3">Courriel :</label>
                    <input type="email" class="col-9" name="courrielContact" placeholder="exemple@gmail.com" value="{{ old('courrielContact', session('user_data.courrielContact', '')) }}">
                    @error('courrielContact')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <label for="numContact" class="col-3">Numéro de téléphone :</label>
                    <input type="text" class="col-9" name="numContact" placeholder="(819)123-4567" value="{{ old('numContact', session('user_data.numContact', '')) }}">
                    @error('numContact')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <button type="button" onclick="addContact off()">Ajouter un autre contact</button>
        <button type="button" onclick="removeContact off()">Retirer un contact</button>
        <button type="button" onclick="info off()">Voire info fournit</button>

        <div class="row d-flex justify-content-center">
            <a class="btn btn-primary mb-3 col-auto precedent" href="{{ route('Inscription.Coordonnees') }}">Précédent</a>
            <button type="submit" class="btn btn-primary mb-3 mx-3 col-auto">Suivant</button>
        </div>
    </div>
</form>

<script>
    let index = localStorage.getItem('contactCount') ? parseInt(localStorage.getItem('contactCount')) : 0;

    function nouveauContact(nb){
        return `
            <div class="contact mb-3">
            <span class="sousTitres">Contact ${nb+1}</span>
                <div class="row">
                    <label for="prenom[]" class="col-3">Prénom :</label>
                    <input type="text" class="col-9" name="prenom[]" placeholder="exemple: Connor" value="{{ old('prenom.${nb}', session('user_data.prenom.${nb}')) }}">
                    @error('prenom.0')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <label for="nom[]" class="col-3">Nom :</label>
                    <input type="text" class="col-9" name="nom[]" placeholder="exemple: McDavid" value="{{ old('nom.${nb}', session('user_data.nom.${nb}')) }}">
                    @error('nom.*')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <label for="poste[]" class="col-3">Poste/Fonction :</label>
                    <input type="text" class="col-9" name="poste[]" placeholder="Chef administration" value="{{ old('poste.*', session('user_data.poste.${nb}')) }}">
                    @error('poste.*')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <label for="courrielContact[]" class="col-3">Courriel :</label>
                    <input type="email" class="col-9" name="courrielContact[]" placeholder="exemple@gmail.com" value="{{ old('courrielContact.*', session('user_data.courrielContact.${nb}', '')) }}">
                    @error('courrielContact.*')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <label for="numContact[]" class="col-3">Numéro de téléphone :</label>
                    <input type="text" class="col-9" name="numContact[]" placeholder="(819)123-4567" value="{{ old('numContact.*', session('user_data.numContact.${nb}')) }}">
                    @error('numContact.*')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        `;}

        

    function addContact() {
        index += 1;
        const formContact = document.getElementById('contacts');
        
        formContact.insertAdjacentHTML('beforeend', nouveauContact(index));
        localStorage.setItem('contactCount', index);
    }

    function removeContact() {
        const formContact = document.getElementById('contacts');
        if(index > 0){
            index -= 1;
            formContact.removeChild(formContact.lastElementChild);
            localStorage.setItem('contactCount', index);
        }
        /*else if (index == 1){
            document.getElementById("remove").disabled = true;
        }*/
    }

    function info() {
        const prenoms = document.querySelectorAll('input[name="prenom[]"]');
        const prenomValues = Array.from(prenoms).map(input => input.value);
        console.log(prenomValues);
    }

    /*function loadContacts() {
        const formContact = document.getElementById('contacts');
        for (let i = 0; i <= index; i++) {
            formContact.insertAdjacentHTML('beforeend', nouveauContact(i));
        }
    }/*

</script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>