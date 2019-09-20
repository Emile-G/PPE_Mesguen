<?php 


// SE CONNECTER A LA BDD
    include "..\PageAC12\connexion\AccesDonnees.php";
    $connexion=connexion("127.0.0.1","3306","mlr1","root","");

    if ($connexion) {
        echo "Connexion reussie 127.0.0.1<br />";
    }



    $sql = "truncate table vehicule;";
    $result = executeSQL($sql);

    	if ($result)
		echo "<meta http-equiv='refresh' content='0;url=interface.php?message=<font color=green> Element supprimer </font>'>";
	else
		echo "<meta http-equiv='refresh' content='0;url=interface.php?message=<font color=red> Echec !  </font>'>";






 ?>