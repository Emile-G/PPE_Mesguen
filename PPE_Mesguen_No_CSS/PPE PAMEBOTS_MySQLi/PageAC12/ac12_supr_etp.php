<?php 
//connexion
include "..\connexion\connectAD.php";


//data
$trnnum = $_GET['id'];
$ETPID = $_GET['test'];

	$sql = "DELETE FROM etape
			WHERE TRNNUM = $trnnum 
			AND ETPID = $ETPID";

			$result = executeSQL($sql);

if ($result)
			echo "<meta http-equiv='refresh' content='0;url=..\PageAC11\Tableau.php?message=<font color=green> Suppression réalisée ! </font>'>";
        else
			echo "<meta http-equiv='refresh' content='0;url=..\PageAC11\Tableau.php?message=<font color=red> Problème de suppression ... </font>'>";

 ?>