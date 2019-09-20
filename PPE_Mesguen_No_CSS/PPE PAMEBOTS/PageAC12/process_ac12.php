<?php 
session_start();
// SE CONNECTER A LA BDD
    include "..\connexion\connectAD.php";

    if ($connexion) {
        echo "Connexion reussie";
    }
    echo "<br/><br/>";


if ($_GET['action'] == 'ajouter') {

  echo "<meta http-equiv='refresh' content='0;url=..\PageAC13\OrgaTourneeFicheEtape.php'>";

} 
else if ($_GET['action'] == 'ajouterT') {


    $date = $_GET['date'];
    $chauffeur = $_GET['chauffeur'];
    $plaque = $_GET['plaque'];
    $datetime = $_GET['datetime'];
    $comment = $_GET['comment'];
    $remorque = $_GET['remorque'];

    //verifie sur le chaffeur a le permis remorque
    $sqlPermis = "SELECT `Permis` FROM chauffeur where CHFID = '$chauffeur';";
    $resultPermis = tableSQL($sqlPermis);

    foreach ($resultPermis as $ligne) {

                        $permisID = $ligne[0];

    }


    if ($remorque == "rien") {

                    $sql = "INSERT INTO `tournee`(`VEHIMMAT`,`CHFID`, `TRNCOMMENTAIRE`, `TRNPECCHAUFFEUR`, `TRNDTE`) VALUES ('$plaque','$chauffeur','$comment','$datetime','$date');";
                    $result = executeSQL($sql);
                    header('Location: ../PageAC11/Tableau.php'); 
    }else{

            if ($permisID == 1 or $permisID == 3) {

                    $sql = "INSERT INTO `tournee`(`VEHIMMAT`,`remorque`,`CHFID`, `TRNCOMMENTAIRE`, `TRNPECCHAUFFEUR`, `TRNDTE`) VALUES ('$plaque','$remorque','$chauffeur','$comment','$datetime','$date');";
                    $result = executeSQL($sql);
                    header('Location: ../PageAC11/Tableau.php'); 
        
            }else{

                echo "<meta http-equiv='refresh' content='0;url=form_ac12_ajouter.php?message=<font color=red> Le chaffeur n a pas de permis Remorque ! </font>'>";
        

            }
    }
    







}  else {
    //invalid action!
}

    

 ?>