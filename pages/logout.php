<?php 

$_SESSION['login'] = "";
$_SESSION['user-id'] = "";

session_unset();
session_destroy();

$message = "Vous avez été déconnecté !";

redirectNotification($message, getRoute('home'));