<?php 

// SE CONNECTER A LA BDD
    include "..\PageAC12\connexion\AccesDonnees.php";
    $connexion=connexion("127.0.0.1","3306","mlr1","root","");

    if ($connexion) {
        echo "Connexion reussie 127.0.0.1<br />";
    }

$voiture = array("renault", "porshe", "mercedes", "fiat", "lada");


function plaque() {
    return chr(rand(65,90)).chr(rand(65,90))."-".rand(0,9).rand(0,9).rand(0,9)."-".chr(rand(65,90)).chr(rand(65,90));
}


    for($x=0;$x<15;$x++) {

    			$i = rand(0, 4);
                 $sql="INSERT INTO `vehicule`(`VEHIMMAT`, `VEHNOM`) VALUES ('".plaque()."','".$voiture[$i]."')";

        echo "Sql : ".$sql."<br />";
        $result = executeSQL($sql);    
    }



?>