<?php include("functions/connexion.php"); ?>

<div class="container-fluid pagePrinc">
    <div class="carteConnexion">
        <form method="post">
            <div class="row num1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                </svg>
            </div>
            <div class="row num2">
                <h3>Mon Identifiant</h3>
                <p>Veuillez toujours vérifier que vous êtes sur la bonne adresse</p>
            </div>
            <div class="row num3">
                <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                        <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                    </svg>clients.fortunaBanque.com</p>
            </div>
            <div class="row num4">
                <input type="text" name="email" class="form-control" placeholder="Saisissez votre E-mail">
                <input type="password" name="password" style="margin-top: 20px;" class="form-control" placeholder="Saisissez votre mot de passe">
            </div>
            <div class="row num5">
                <button type="submit" name="login">Connexion</button>
            </div>
        </form>
    </div>
</div>