<?php

// Pour créer les amis

$firstnames = [
    "Jules",
    "Ines",
    "Andre",
    "Mael",
    "Malo",
    "Soen",
    "Lya",
    "Louane",
    "Maxime",
    "Yanis",
    "Gael",
    "Jade",
    "Owen",
    "maxime",
    "ana",
    "lilou",
    "octave",
    "mégane",
    "émi",
    "arya",
    "batiste",
];

$lastnames = [
    "garcia",
    "daniel",
    "langlois",
    "mallet",
    "leveque",
    "remy",
    "brun",
    "roussel",
    "perrin",
    "renaud",
    "lemoine",
    "antoine",
    "pichon",
    "lejeune",
    "chevallier",
    "lacroix",
    "caron",
    "barbier",
    "maréchal",
    "laporte",
    "lecompte",
];

$civilities = [
    "Monsieur",
    "Madame",
    "Monsieur",
    "Madame",
    "Monsieur",
    "Monsieur",
    "Madame",
    "Madame",
    "Madame",
    "Madame",
    "Monsieur",
    "Madame",
    "Madame",
    "Monsieur",
    "Monsieur",
    "Madame",
    "Madame",
    "Madame",
    "Madame",
    "Madame",
    "Monsieur",
];

for ($i = 0; $i < count($firstnames); $i++) {

    $created_at = date("d/m/Y");
    $password = hash("sha256", "test", false);
    $role = "ROLE_USER";
    $type = "Compte individuel";
    $country = "France";
    $address = "6 rue de l'Hermite";
    $civility = $civilities[$i];
    $firstname = $firstnames[$i];
    $lastname = $lastnames[$i];
    $date_of_birth = "1990-02-03";
    $acc_nb = "NO_ACC_NUMBER";

    $lastname = str_replace(" ", "-", $lastnames[$i]);
    $email = $firstnames[$i] . "." . $lastname . "@gmail.com";

    $sql = "INSERT INTO user VALUES (NULL, :email, :password, :role, :created_at, :type, :country, :address, :civility, :firstname, :lastname, :date_of_birth, :acc_number)";

    $query = $dbh->prepare($sql);
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->bindParam(":created_at", $created_at, PDO::PARAM_STR);
    $query->bindParam(":password", $password, PDO::PARAM_STR);
    $query->bindParam(":role", $role, PDO::PARAM_STR);
    $query->bindParam(":type", $type, PDO::PARAM_STR);
    $query->bindParam(":country", $country, PDO::PARAM_STR);
    $query->bindParam(":address", $address, PDO::PARAM_STR);
    $query->bindParam(":civility", $civility, PDO::PARAM_STR);
    $query->bindParam(":firstname", $firstname, PDO::PARAM_STR);
    $query->bindParam(":lastname", $lastname, PDO::PARAM_STR);
    $query->bindParam(":date_of_birth", $date_of_birth, PDO::PARAM_STR);
    $query->bindParam(":acc_number", $acc_nb, PDO::PARAM_STR);

    $query->execute();

    $sql = "SELECT ID FROM user WHERE email = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->execute();
    $id = $query->fetch(PDO::FETCH_OBJ);

    $id = intval($id->ID);

    if ($i % 2 == 0) {
        $card = "basic";
    } else if ($i % 3 == 0) {
        $card = "gold";
    } else {
        $card = "black";
    }

    $sql = "INSERT INTO account (id, user, balance, card) VALUES (NULL, :userId, 0, :card_type)";
    $query = $dbh->prepare($sql);
    $query->bindParam(":userId", $id, PDO::PARAM_INT);
    $query->bindParam(":card_type", $card, PDO::PARAM_STR);
    $query->execute();

    $accountId = getUserAccount($id)['id'];
    $acc_nb = "cp_" . $id . "_" . $accountId;

    $sql = "UPDATE user SET account_nb = :acc_nb WHERE ID = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(":acc_nb", $acc_nb, PDO::PARAM_STR);
    $query->bindParam(":id", $id, PDO::PARAM_STR);
    $query->execute();

}

redirectNotification("Fixtures transfered to DB", getRoute("home"));