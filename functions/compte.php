<?php 

    $email = $_SESSION['login'];
    $sql = "SELECT * FROM user WHERE email = :email";
    $query = $dbh->prepare($sql);
    $query ->bindParam(":email", $email, PDO::PARAM_STR);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_OBJ);

    var_dump($result);

    $accountId = (isset(getUserAccount()["id"])) ? getUserAccount()["id"] : false;

    
    if($result->account_nb == "NO_ACC_NUMBER"){
        $id = $result->ID;
        $acc_nb = "cp_" . $result->ID . "_$accountId";

        $sql = "UPDATE user SET account_nb = :acc_nb WHERE ID = :id";
        $query = $dbh->prepare($sql);
        $query->bindParam(":acc_nb", $acc_nb, PDO::PARAM_STR);
        $query->bindParam(":id", $id, PDO::PARAM_STR);
        $query->execute();
    }
