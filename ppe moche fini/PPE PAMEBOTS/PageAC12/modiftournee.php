<?php 
session_start();
// SE CONNECTER A LA BDD
include "..\connexion\connectAD.php";

//on récupère l'id de la tournée
$trnnum = $_SESSION["trnnum"];

echo "<br>";

//on récupère les modifications de la tournée
$date = $_GET['date'];
$chauffeur = $_GET['chauffeur'];
$plaque = $_GET['plaque'];
$comment = $_GET['comment'];

echo $date." ".$chauffeur." ".$plaque." ".$comment;

$sql="UPDATE `tournee` SET `VEHIMMAT`='$plaque' ,`CHFID`='$chauffeur',`TRNCOMMENTAIRE`='$comment',`TRNDTE`='$date' WHERE `TRNNUM` = $trnnum ";
$result = executeSQL($sql);

header('Location: ../PageAC11/Tableau.php'); 








 ?>