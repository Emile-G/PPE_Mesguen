<?php 

//connexion
include "..\connexion\connectAD.php";


//data
$trnnum = $_GET['id'];


//requete sql
$sqletp = "DELETE FROM ETAPE WHERE TRNNUM = $trnnum";
$sql = "DELETE FROM `ppemesguen`.`tournee` WHERE `tournee`.`TRNNUM` = '$trnnum';";


//execution
$resultetp = executeSQL($sqletp);
$result = executeSQL($sql);


//redirection
header('Location: ../PageAC11/Tableau.php');



 ?>