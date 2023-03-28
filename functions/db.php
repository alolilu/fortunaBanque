<?php

$db_user = "root";
$db_pass = "root";

try{
    $dbh = new PDO('mysql:host=localhost;dbname=banque', $db_user, $db_pass);
} catch (PDOException $e) {
    print "Erreur PDO : " . $e->getMessage() . "<br/>";
    die();
}