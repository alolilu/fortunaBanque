<?php
include('functions/compte.php');
isGranted();
?>
<div class="container-fluid princCompte py-5">
    <div class="card my-5">
        <h1>Mon compte :</h1><br>
        <?php
        
        $card = getUserAccount()["card"];
        $amount = getUserAccount()["balance"] . " €";

        switch ($card) {
            case "black":
                echo '<div class="carte">
                <div class="nom">' . $result->firstname . " " . $result->lastname . '</div>
                <div class="date">01/2026</div>
                <div class="brand"><span>Fortuna</span> Banque</div>
                <img src="../assets/img/visa.png" alt="Logo visa" id="visa">
            </div>';
            break;
            case "gold":
                echo '<div class="carte gold">
                <div class="nom">' . $result->firstname . " " . $result->lastname . '</div>
                <div class="date">01/2026</div>
                <div class="brand"><span>Fortuna</span> Banque</div>
                <img src="../assets/img/visa.png" alt="Logo visa" id="visa">
            </div>';
            break;

            default:
                echo '<div class="carte blue">
                <div class="nom">' . $result->firstname . " " . $result->lastname . '</div>
                <div class="date">01/2026</div>
                <div class="brand"><span>Fortuna</span> Banque</div>
                <img src="../assets/img/visa.png" alt="Logo visa" id="visa">
            </div>';
            break;
} ?><br>
        <h3>Information personnelles :</h3>
        <div class="row">
            <div class="col-sm-6">
                <div class="table">
                    <div class="table-head">
                        <div class="table-col">Champ</div>
                        <div class="table-col">Information</div>
                    </div>
                    <div class="table-row">
                        <div class="table-col">Nom</div>
                        <div class="table-col"><?= $result->firstname ?></div>
                    </div>
                    <div class="table-row">
                        <div class="table-col">Prénom</div>
                        <div class="table-col"><?= $result->lastname ?></div>
                    </div>
                    <div class="table-row">
                        <div class="table-col">Civilité</div>
                        <div class="table-col"><?= $result->civility ?></div>
                    </div>
                    <div class="table-row">
                        <div class="table-col">Email</div>
                        <div class="table-col"><?= $result->email ?></div>
                    </div>
                    <div class="table-row">
                        <div class="table-col">Numéro de compte</div>
                        <div class="table-col">cp_<?= $result->ID ?>_<?= $accountId ?></div>
                    </div>
                    <div class="table-row">
                        <div class="table-col">Solde</div>
                        <div class="table-col"><?= $amount ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="table">
                    <div class="table-head">
                        <div class="table-col">Champ</div>
                        <div class="table-col">Information</div>
                    </div>
                    <div class="table-row">
                        <div class="table-col">Adresse</div>
                        <div class="table-col"><?= $result->address ?></div>
                    </div>
                    <div class="table-row">
                        <div class="table-col">Pays</div>
                        <div class="table-col"><?= $result->country ?></div>
                    </div>
                    <div class="table-row">
                        <div class="table-col">Date de naissance</div>
                        <div class="table-col"><?= $result->date_of_birth ?></div>
                    </div>
                    <div class="table-row">
                        <div class="table-col">Type de compte</div>
                        <div class="table-col"><?= $result->type ?></div>
                    </div>
                    <div class="table-row">
                        <div class="table-col">Date de création</div>
                        <div class="table-col"><?= $result->created_at ?></div>
                    </div>
                    <div class="table-row">
                        <div class="table-col">carte</div>
                        <div class="table-col">Visa <?= $card ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>