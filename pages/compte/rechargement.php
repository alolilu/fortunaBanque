<?php
include('functions/compte/rechargement.php');
isGranted();
?>
<div class="container-fluid princCompte py-5">
    <div class="card my-5">
        <h1 class="text-center">Recharger le compte</h1><br>
        <hr>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <form method="post">
                    <p class="text-center">Vous avez reçu lors de votre dépot un code à 12 caractères ; veuillez le renseigner.</p>
                    <input type="text" name="code_input" id="code_input" class="form-control mt-5 text-center" placeholder="1-2-3-&-X-4-5-6-7-8-9-0">
                    <p class="text-center"><small>Rechargement maxi de 9 999 999 €, contactez votre conseiller pour un montant supérieur</small></p>
                    <div class="text-right">
                        <input type="submit" value="Confirmer" id="btn" class="btn btn-outline-primary mt-5 disabled" name="rechargement">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control {
        letter-spacing: 10px;
        text-transform: uppercase;
        font-size: 28px;
    }
</style>

<script>
    let input = document.getElementById('code_input');
    input.focus();

    input.addEventListener("keyup", (e) => {
        if (e.code != "Backspace" && input.value.length > 0 && input.value.length < 24) {
            input.value += "-";
            if (input.value.length == 6) {
                input.value += "&";
                input.value += "-";
            }
        } else if (input.value.length > 25) {
            input.value = input.value.slice(0, -1);
        }
        if (input.value.length == 25) {
            document.getElementById("btn").classList.remove("disabled");
        }
    })
</script>