<?php


$user = getUser();
$userAccount = getUserAccount();

if($userAccount == null) header("location: " . getRoute("compte/nouveau"));

if(isset($_POST['transfer'])){
    if(!isset($_POST['amount']) || empty($_POST['amount']) || !isset($_POST['to']) || empty($_POST['to'])){
        redirectNotification("Veuillez remplir les champs du formulaire !", getRoute("compte/virements/nouveau"), "danger");
    } else {
        $to = $_POST['to'];
        $amount = $_POST['amount'];

        makeTransfer($user, $to, $amount);
    }
}

function makeTransfer($user, $to, $amount){
    global $dbh;
    global $userAccount;

    $to = explode("_", $to)[1];
    $to = intval($to);
    $userFromId = intval($user['ID']);
    $userFromAccount = getUserAccount();

    // La personne à il les fond nécéssaires
    if(intval($userFromAccount["balance"] + $amount) < 0){
        redirectNotification("Immpossible d'éffectuer le virement: <b>solde insuffisant</b>", "", "danger");
        die();
    }

    $userToAccount = getUserAccount($to);

    if(!getUser($to)){
        redirectNotification("Cet utilisateur n'éxiste pas !", "", "danger");
        die();
    } else if (!getUserAccount($to)) {
        redirectNotification("Le compte spécifié éxiste en tant qu'utilisateur mais n'as pas de compte bancaire associé !", "", "danger");
        die();
    } else if ($userFromId == $to){
        redirectNotification("Il est impossible de virer de l'argent vers votre compte personnel", "", "danger");
        die();
    }

    $date = date("d/m/Y H:m");

    $userFromBalance = intval($userFromAccount['balance']);
    $userFromBalance = $userFromBalance - intval($amount);

    $userFromCode = "cp_" . $userFromId . "_" . $userAccount["id"];

    $toCode = "cp_" . $to . "_" . $userToAccount["id"];

    $sql = "INSERT INTO `transaction` (`id`, `to_account`, `from_account`, `amount`, `created_at`) VALUES (NULL, :to_account, :from_account, :amount, NOW())";
    $query = $dbh->prepare($sql);
    $query->bindParam(":to_account", $toCode, PDO::PARAM_STR);
    $query->bindParam(":from_account", $userFromCode, PDO::PARAM_STR);
    $query->bindParam(":amount", $amount, PDO::PARAM_STR);

    $query->execute();

    $balanceFromSql = "UPDATE account SET balance = :balance WHERE user = :userId";
    $query = $dbh->prepare($balanceFromSql);
    $query->bindParam(":userId", $userFromId, PDO::PARAM_INT);
    $query->bindParam(":balance", $userFromBalance, PDO::PARAM_INT);
    $query->execute();

    $userToAccountBalance = intval($userToAccount['balance']);
    $userToAccountBalance += $amount;

    $balanceToSql = "UPDATE account SET balance = :balanceTo WHERE user = :userToId";
    $query = $dbh->prepare($balanceToSql);
    $query->bindParam(":userToId", $to, PDO::PARAM_INT);
    $query->bindParam(":balanceTo", $userToAccountBalance, PDO::PARAM_INT);
    $query->execute();

    redirectNotification("Le virement à bien été éffectué");
}