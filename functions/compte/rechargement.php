<?php

// RECHARGER SON COMPTE :
// ID UTILISATEUR (3 chiffres) - & - PREMIERE LETTRE PRENOM - SOMME (5 chiffres)
// EX:
// ID: 470
// PRENOM : PAUL
// SOMME : 12345
// => 4 - 7 - 0 - & - P - 1 - 2 - 3 - 4 - 5

$userAccount = getUserAccount();
$userId = getUser()["ID"];
$userName = getUser()["firstname"];

if (isset($_POST['rechargement'])) {

    // On supprime les tirets
    $raw = str_replace("-", "", $_POST['code_input']);

    $amount = explode("&", $raw)[1];
    $key = explode("&", $raw)[0];

    if(substr($key, 0, 1) === "0"){
        $key = substr($key, 1, 2);
    }

    if(substr($key, 0, 1) === "0"){
        $key = substr($key, 1, 1);
    }

    if ($key == $userId) {
        if (strlen($amount) == 9) {
            if (strtolower(substr($amount, 0, 1)) == strtolower(substr($userName, 0, 1))) {
                $amount = substr($amount, 1, 8);
                if (is_numeric($amount)) {
                    $balance = $userAccount["balance"] + $amount;

                    $sql = "UPDATE account SET balance = :balance WHERE user = :userid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(":balance", $balance, PDO::PARAM_INT);
                    $query->bindParam(":userid", $userId, PDO::PARAM_INT);
                    $query->execute();

                    $message = "Rechargement de $amount € effectué !";

                    redirectNotification($message, getRoute("compte/compte"));
                } else {
                    // Montant non numérique
                    redirectNotification("Le code est incorrect", getRoute("compte/rechargement"), "danger");
                }
            } else {
                // Première lettre ne correspond pas
                redirectNotification("Le code est incorrect", getRoute("compte/rechargement"), "danger");
            }
        } else {
            // Le code est trop court
            redirectNotification("Le code n'est pas complet", getRoute("compte/rechargement"), "danger");
        }
    } else {
        // L'id utilisateur n'est pas bon
        redirectNotification("Le code est incorrect", getRoute("compte/rechargement"), "danger");
    }
}
