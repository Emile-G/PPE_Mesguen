<?php
session_start();

	//on recupere les varirable issue du formulaire
$LIEUNOM = $_GET['lieu'];
$rdvdate1 = $_GET['rdvdate1'];
$rdvdate2 = $_GET['rdvdate2'];
$dateprisecharge = $_GET['dateprisecharge'];
$commentaire = $_GET['commentaire'];
	//supprime les espaces avant et apres l'information

$trnnum = $_GET['tournee'];




if (!empty($LIEUNOM) && ($rdvdate1) && ($rdvdate2) && ($dateprisecharge) && ($commentaire)) {
    include "..\connexion\connectAD.php";

    $sql = "SELECT MAX(ETPID)
            FROM etape
            WHERE TRNNUM = '$trnnum' ";
    
    $cpt = champSQL($sql);

    $cpt++;
    
    $ETPID = $cpt;

    $sql = "INSERT INTO `ppemesguen`.`etape` (
         TRNNUM, ETPID,`LIEUID`, `ETPHREMIN`, `ETPHREMAX`, `ETPHREDEBUT`, `ETPHREFIN`, `ETPNBPALLIV`, `ETPNBPALLIVEUR`, `ETPNBPALVARCHARG`, `ETPNBPALVARCHARGEUR`, `ETPCHEQUE`, `ETPETATLIV`, `ETPCOMMENTAIRE`, `ETPVAL`, `ETPKM`) 
                 VALUES ('".$trnnum."','".$ETPID."','".$LIEUNOM."', '".$rdvdate1."', '".$rdvdate2."', '".$dateprisecharge."', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '".$commentaire."', NULL, NULL)";
    $result = executeSQL($sql);

    if ($result)
        echo "<meta http-equiv='refresh' content='0;url=OrgaTourneeFicheEtape.php?message=<font color=green> Ajout realise </font>'>";
    else
        echo "<meta http-equiv='refresh' content='0;url=OrgaTourneeFicheEtape.php?message=<font color=red>  " . erreurSQL($sql) . ".... </font>'>";

} else

    echo "<meta http-equiv='refresh' content='0;url=OrgaTourneeFicheEtape.php?message=<font color=red> Renseigner l&#039;information... </font>'>";


?>