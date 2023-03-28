<?php

    $routes = array(
        "home" => "",
        "inscription" => "inscription",
        "connexion" => "connexion",
        "compte/compte" => "compte/compte",
        "mescartes" => "mescartes",
        "logout" => "deconnexion",
        "compte/compte" => "compte/compte",
        "compte/virements/nouveau" => "compte/virements/nouveau",
        "compte/virements/historique" => "compte/virements/historique",
        "trouver-mes-amis" => "trouver-mes-amis",
        "compte/rechargement" => "compte/rechargement",

        "404" => "404",
        /* "fixtures" => "fixtures" */
    );

    $description_default = "";
    $keyword_default = "";
    $metas = array(
        //page => meta title, meta description, meta keywords
        "home" => array("Accueil - Fortnua banque", "Accueil - Fortnua banque", "Accueil - Fortnua banque"),
        "inscription" => array("Inscription", "Ouvrez votre compte", ""),
        "logout" => array("Déconnexion", "Déconnexion", ""),
        "connexion" => array("Connexion", "Connectez vous !", ""),
        "compte/compte" => array("compte", "Afficher les informations de votre compte", ""),
        "deconnexion" => array("Se déconnecter", "Déconnectez vous de votre compte", ""),
        "compte/virements/nouveau" => array("Effectuer un nouveau virement", "Effectuer un nouveau virement", "nouveau virement"),
        "compte/virements/historique" => array("Historique de vos transactions", "Historique de vos transactions", ""),
        "trouver-mes-amis" => array("Trouvez vos contacts via la recherche !", "Trouvez vos contacts via la recherche !", "recherche"),
        "compte/rechargement" => array("rechargez votre compte", "rechargez votre compte via un code", ""),

        "404" => array("Erreur 404", "Erreur 404", ""),
        /* "fixtures" => array("Erreur 404", "Erreur 404", ""), */
    );
