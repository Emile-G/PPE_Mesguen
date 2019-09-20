<?php

	//on recupere les varirable issue du formulaire
$LIEUNOM = $_GET['lieu'];
$rdvdate1 = $_GET['rdvdate1'];
$rdvdate2 = $_GET['rdvdate2'];
$commentaire = $_GET['commentaire'];


$trnnum = $_GET['tournee'];
$ETPID = $_GET['etpid'];




if (!empty($LIEUNOM) && ($rdvdate1) && ($rdvdate2) && ($commentaire)) {
    include "..\connexion\connectAD.php";

    $sql = "SELECT ETPID
            FROM etape
            WHERE TRNNUM = '$trnnum' ";
    
    $result = executeSQL($sql);
    
    $cpt = compteSQL($sql);
    
    $sql = "UPDATE etape
            SET LIEUID = '$LIEUNOM',
            ETPHREDEBUT = '$rdvdate1',
            ETPHREFIN = '$rdvdate2',
            ETPCOMMENTAIRE = '$commentaire'
            WHERE ETPID = '$ETPID';";

    $result = executeSQL($sql);


    if ($result)
        echo "<meta http-equiv='refresh' content='0;url=..\PageAC11\Tableau.php?message=<font color=green> Ajout realise </font>'>";
    else
        echo "marche pas";

}

?>