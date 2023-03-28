<?php include("functions/compte/inscription.php"); ?>

<div id="content-wrap">
    <form method="post" id="register-form">
        <h1>Créer un compte</h1>
        <div class="step show" id="card-step">
            <h2>Choisissez votre carte</h2>
            <div class="card-body">
                <div class="carte blue" onclick="setCard('basic')">
                    <div class="nom">Jhon Doe</div>
                    <div class="date">01/2026</div>
                    <div class="brand"><span>Fortuna</span> Banque</div>
                    <img src="assets/img/visa.png" alt="Logo visa" id="visa">
                </div>
                <h2>Carte Basique</h2>
                <hr>
                <ul class="list">
                    <li>Paiements et retraits gratuits en France et en zone euro. (1)</li>
                    <li>Actualisation du solde de votre compte en temps réel. (2)</li>
                    <li>Blocage temporaire de la carte en cas de besoin. (3)</li>
                    <li>Code secret de carte personnalisable.</li>
                </ul>
            </div>
            <div class="card-body">
                <div class="carte gold" onclick="setCard('gold')">
                    <div class="nom">Jhon Doe</div>
                    <div class="date">01/2026</div>
                    <div class="brand"><span>Fortuna</span> Banque</div>
                    <img src="assets/img/visa.png" alt="Logo visa" id="visa">
                </div>
                <h2>Carte Gold</h2>
                <hr>
                <ul class="list">
                    <li>Paiements et retraits gratuits en France et partout dans le monde. (4)</li>
                    <li>Assurance protection des achats incluse pour vous et vos proches. (5)</li>
                    <li>Assurances voyage et assistance incluses pour vous et vos proches.</li>
                    <li>Cashback sur vos achats (6) et factures. (7)</li>
                    <li>Accès aux programmes privilèges Mastercard.</li>
                </ul>
            </div>
            <div class="card-body">
                <div class="carte" onclick="setCard('black')">
                    <div class="nom">Jhon Doe</div>
                    <div class="date">01/2026</div>
                    <div class="brand"><span>Fortuna</span> Banque</div>
                    <img src="assets/img/visa.png" alt="Logo visa" id="visa">
                </div>
                <h2>Carte Black</h2>
                <hr>
                <ul class="list">
                    <li>Paiements et retraits gratuits en France et partout dans le monde. (4)</li>
                    <li>Assurance protection des achats incluse pour vous et vos proches. (5)</li>
                    <li>Assurances voyage et assistance incluses pour vous et vos proches.</li>
                    <li>Cashback sur vos achats (6) et factures. (7)</li>
                    <li>Accès aux programmes privilèges Mastercard.</li>
                    <li>Application de gestion complète</li>
                </ul>
            </div>
        </div>
        <div class="step hide">
            <h3>&nbsp;</h3>
            <h3>Je souhaite ouvrir un :</h3>
            <label for="account_type" class="form-label">Type de compte</label>
            <select name="account_type" id="account_type" class="form-control">
                <option value="Compte individuel">Compte individuel</option>
                <option value="Compte joint">Compte joint</option>
            </select>
            <label for="country" class="form-label">Pays de naissance</label>
            <select name="country" id="country" class="form-control">
                <option value="France">France</option>
                <option value="Autre">Autre</option>
            </select>
            <label for="city" class="form-label">Ville</label>
            <input type="text" name="city" id="city" placeholder="Ville" class="form-control">
            <label for="street" class="form-label">Rue</label>
            <input type="text" name="street" id="street" placeholder="Rue" class="form-control">
            <label for="number" class="form-label">Numéro</label>
            <input type="number" name="number" id="number" placeholder="Numéro" class="form-control">
            <!-- <label for="number" class="form-label">CHAMP</label>
            <input type="text" name="CHAMP" id="number" placeholder="CHAMP" class="form-control"> -->
            <div class="btn-box">
                <a onclick="lastStep()" class="btn btn-outline-secondary ml-auto">Retour</a>
                <a onclick="nextStep()" class="btn btn-outline-primary">Suivant</a>
            </div>
        </div>
        <div class="step hide">
            <h3>Titulaire :</h3>
            <label for="civility" class="form-label">Civilité</label>
            <select name="civility" id="civility" class="form-control">
                <option value="Monsieur">Monsieur</option>
                <option value="Madame">Madame</option>
            </select>
            <label for="firstname" class="form-label">Prénom</label>
            <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Prénom">
            <label for="lastname" class="form-label">Nom</label>
            <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Nom">
            <label for="date_of_birth" class="form-label">Date de naissance</label>
            <input type="date" name="date_of_birth" class="form-control" id="date">
            <label for="email" class="form-label">Adresse E-mail</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="E-mail">
            <label for="password" class="form-label">Mot de passe</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="Mot2p4s5eC@mpl1qu3">
            <label for="verify_password" class="form-label">Vérification du mot de passe</label>
            <input class="form-control" type="password" name="verify_password" id="password_verification" placeholder="Mot2p4s5eC@mpl1qu3">
            <div class="btn-box">
                <a onclick="lastStep()" class="btn btn-outline-secondary ml-auto">Retour</a>
                <button type="submit" name="register" class="btn btn-outline-primary">S'inscrire</button>
            </div>
        </div>
        <input type="hidden" name="card-type-input" id="card-type-input">
    </form>
</div>

<script>
    function setCard(type) {
        let cardInput = document.getElementById("card-type-input");
        cardInput.value = type;
        nextStep();
    }

    let steps = document.getElementsByClassName("step");
    let currentStep = 0;

    function nextStep() {
        steps[currentStep].classList.remove("show");
        steps[currentStep].classList.add("hide");
        if (currentStep++ < steps.length) {
            steps[currentStep].classList.remove("hide");
            steps[currentStep].classList.add("show");
        }
    }

    function lastStep() {
        steps[currentStep].classList.remove("show");
        steps[currentStep].classList.add("hide");
        if (currentStep-- >= 0) {
            steps[currentStep].classList.remove("hide");
            steps[currentStep].classList.add("show");
        }
    }
</script>