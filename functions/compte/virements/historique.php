<?php

$user = "cp_" . intval(getUser()["ID"]);

$sql = "SELECT * FROM transaction WHERE from_account = :user";

$query = $dbh->prepare($sql);

$query->bindParam(":user", $user, PDO::PARAM_INT);
$query->execute();

$transactions = $query->fetchAll(PDO::FETCH_OBJ);