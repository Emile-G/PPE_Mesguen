<?php 

// SE CONNECTER A LA BDD
    include "C:\Program Files (x86)\EasyPHP-DevServer-14.1VC9\data\localweb\my portable files\SI6\AccesDonnees.php";
    $connexion=connexion("127.0.0.1","3306","mlr1","root","");

    if ($connexion) {
        echo "Connexion reussie 127.0.0.1 : 3306 <br />";
        echo "Base mlr1 selectionnee... <br />";
        echo "Mode acces : mysqli <br />";
    }
    echo "<br/><br/><br/><br/>"; 
    echo "Table vid&#233;e. <br>";

    $sql = "truncate table chauffeur;";

            echo "Sql : ".$sql."<br />";
            $result = executeSQL($sql);


        if ($result)
        echo "<meta http-equiv='refresh' content='0;url=interface.php?message2=<font color=green> Element supprimer </font>'>";
    else
        echo "<meta http-equiv='refresh' content='0;url=interface.php?message2=<font color=red> Echec !  </font>'>";






 ?>