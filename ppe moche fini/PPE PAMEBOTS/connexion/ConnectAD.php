<?php
//version 0.9 du Jeudi 17 Janvier 2019 -- 14:50
include "AccesDonnees.php";

$ip=explode(".",$_SERVER['SERVER_ADDR']);

switch ($ip[0]) {
    
    case 127 :
        //local
        $host = "127.0.0.1";
        $user = "root";
        $password = "";
        $dbname = "ppemesguen";
        $port='3307'; //peut changer selon la version d'eazyphp  --> au lycée 3307
        break;
        
    default :
        exit ("Serveur non reconnu...");
        break;
}

$connexion=connexion($host,$port,$dbname,$user,$password);


?>