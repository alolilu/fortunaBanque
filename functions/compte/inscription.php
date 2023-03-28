<?php

if (isset($_POST['register'])) {
    // Si les champs sont bons
    if (
        isset($_POST['email']) && strlen($_POST['email']) > 0 &&
        isset($_POST['firstname']) && strlen($_POST['firstname']) > 0 &&
        isset($_POST['lastname']) && strlen($_POST['lastname']) > 0 &&
        isset($_POST['civility']) && strlen($_POST['civility']) > 0 &&
        isset($_POST['date_of_birth']) && strlen($_POST['date_of_birth']) > 0 &&
        isset($_POST['password']) && strlen($_POST['password']) > 0 &&
        isset($_POST['verify_password']) && strlen($_POST['verify_password']) > 0
    ) {
        $email = $_POST['email'];
        $created_at = date("d/m/Y");
        $role = "ROLE_USER";
        $country = $_POST['country'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $civility = $_POST['civility'];
        $type = $_POST['account_type'];
        $date_of_birth = $_POST['date_of_birth'];
        $card = $_POST['card-type-input'];
        // $CHAMP = $_POST['CHAMP'];

        $password = $_POST['password'];
        $password_verify = $_POST['verify_password'];

        if ($password === $password_verify) {
            $password = hash("sha256", $_POST['password'], false);

            $address = $_POST['number'] . " " . $_POST['street'] . " " . $_POST['city'];

            $sql = "SELECT * FROM user WHERE email = :email";

            $query = $dbh->prepare($sql);
            $query->bindParam(":email", $email, PDO::PARAM_STR);

            $query->execute();

            $result = $query->fetch(PDO::FETCH_OBJ);

            if (!$result) {
                $sql = "INSERT INTO user VALUES (NULL, :email, :password, :role, :created_at, :type, :country, :address, :civility, :firstname, :lastname, :date_of_birth, :acc_number)";
                // $sql = "INSERT INTO user VALUES (NULL, :email, :password, :role, :created_at, :type, :country, :address, :civility, :firstname, :lastname, :date_of_birth, :acc_number, :CHAMP)";

                $acc_nb = "NO_ACC_NUMBER";

                $query = $dbh->prepare($sql);
                $query->bindParam(":email", $email, PDO::PARAM_STR);
                $query->bindParam(":created_at", $created_at, PDO::PARAM_STR);
                $query->bindParam(":password", $password, PDO::PARAM_STR);
                $query->bindParam(":role", $role, PDO::PARAM_STR);
                $query->bindParam(":type", $type, PDO::PARAM_STR);
                $query->bindParam(":country", $country, PDO::PARAM_STR);
                $query->bindParam(":address", $address, PDO::PARAM_STR);
                // $query->bindParam(":CHAMP", $CHAMP, PDO::PARAM_STR);
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

                $sql = "UPDATE user SET account_nb = :acc_nb WHERE id = :id";
                $query = $dbh->prepare($sql);
                $query->bindParam(":acc_nb", $acc_nb, PDO::PARAM_STR);
                $query->bindParam(":id", $id, PDO::PARAM_STR);

                $sql = "INSERT INTO account (id, user, balance, card) VALUES (NULL, :userId, 0, :card_type)";
                $query = $dbh->prepare($sql);
                $query->bindParam(":userId", $id, PDO::PARAM_INT);
                $query->bindParam(":card_type", $card, PDO::PARAM_STR);
                $query->execute();

                $_SESSION['login'] = $email;
                $_SESSION['user-id'] = $id;

                $message = "Votre compte à bien été crée !";

                redirectNotification($message, getRoute("compte/compte"));
            } else {
                $message = "Erreur: cette addresse email est déja utilisée !";
                $redirect = getRoute('inscription-new');

                redirectNotification($message, $redirect);
            }
        } else {
            $message = "Erreur: Les mots de passe ne correspondent pas !";
            $redirect = getRoute('inscription-new');

            redirectNotification($message, $redirect);
        }
    } else {
        redirectNotification("Veuillez remplir tout les champs du formulaire !", getRoute("inscription"), "danger");
    }
}
