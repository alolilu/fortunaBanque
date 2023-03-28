<?php

    $slug = str_replace(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']),'',$_SERVER['REQUEST_URI']);
    $base = 'http://'. $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

    include "routes.php";

    if(strpos($slug,'/?')!==false){
        $slug = strstr($slug, '/?', true);
    }elseif(strpos($slug,'?')!==false){
        $slug = strstr($slug, '?', true);
    }

    $current_route = array_search($slug,$routes);

    if(!$current_route){
        if (empty($slug)){//Home page est vide mais le routeur contient la baseref
            $current_route = "home";
        }else{
            http_response_code(404);//Change le code de la page
            $current_route = "404";//Charge la page 404
        }
    }	
    
    $page = "pages/".$current_route.".php";

    $conf_title=$metas[$current_route][0];
    $conf_description=$metas[$current_route][1];
    $conf_keywords=$metas[$current_route][2];

?>