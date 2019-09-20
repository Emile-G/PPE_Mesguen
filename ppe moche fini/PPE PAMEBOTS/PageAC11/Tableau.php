
<?php
include "..\connexion\connectAD.php";


$sql = "SELECT *
        FROM tournee,vehicule
        WHERE tournee.vehimmat=vehicule.vehimmat;"; 

$cpt = compteSQL($sql);
$results = tableSQL($sql);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="content-language" content="fr" />
    <link rel="stylesheet"
          type="text/css"
          href="" />
    <title>TEST TABLEAU</title>
</head>

<body>
<table border='2' width='500'>

    <caption> PAGE AC11 TABLEAU: </caption>
        <tr>
            <th>TRNNUM</th>
             <th>VEHIMMAT</th>
             <th>Remorque</th>
             <th>CHFID</th>
             <th>TRNCOMMENTAIRE</th>
             <th>TRNPECCHAUFFEUR</th>
             <th>TRNDTE</th>
             <th>Départ</th>
             <th>Arrivée</th>
             <th>Modifier</th>
             <th>Supprimer</th>
         </tr>

         <?php  



                foreach ($results as $ligne) {
                    //on extrait chaque valeur de la ligne courante
                    $trnum = $ligne[0];
                    $vehimmat = $ligne[1];
                    $remorque = $ligne[2];
                    $chfid = $ligne[3];
                    $trncommentaire = $ligne[4];
                    $trnpechauffeur = $ligne[5];
                    $trndte = $ligne[6];
                    //on affiche la ligne courante dans le select


                    //lieu de la première étape de la tournée
                    $sqlpreetp = "SELECT lieu.LIEUNOM FROM `etape`
                        INNER JOIN lieu
                        ON etape.LIEUID = lieu.LIEUID
                        WHERE `TRNNUM` = $trnum AND ETPID = (select MIN(ETPID) FROM etape where TRNNUM = $trnum);";

                    $resultpreetp = champSQL($sqlpreetp);

                    //lieu de la dernière étape de la tournée
                    $sqlderetp = "SELECT lieu.LIEUNOM FROM `etape`
                        INNER JOIN lieu
                        ON etape.LIEUID = lieu.LIEUID
                        WHERE `TRNNUM` = $trnum AND ETPID = (select MAX(ETPID) FROM etape where TRNNUM = $trnum);";

                    $resultderetp = champSQL($sqlderetp);

                    echo "<tr>
                            <th>$trnum</th>
                            <th>$vehimmat</th>
                            <th>$remorque</th>
                            <th>$chfid</th>
                            <th>$trncommentaire</th>
                            <th>$trnpechauffeur</th>
                            <th>$trndte</th>
                            <th>$resultpreetp</th>
                            <th>$resultderetp</th>

                            <th><a href=\"../PageAC12/form_ac12.php?id=$trnum\"> <img src=\"edit.png\" title=\"Modifier...\" /></a></th>

                            <th><a href=\"Tableau_supr.php?id=$trnum\"> <img src=\"delete.png\"  onclick=\"if(!confirm('Voulez-vous Supprimer')) return false;\" title=\"Supprimer...\" /></a></th>
                        </tr>";



                }                         

        ?>

    </table>
<br><br>
<button type="submit" name="action" value="ajouter" onclick="window.location='../PageAC12/form_ac12_ajouter.php'">Ajouter</button>

</body>



</html>