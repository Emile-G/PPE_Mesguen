<?php 
session_start();
// SE CONNECTER A LA BDD
include "..\connexion\connectAD.php";


//seconde requete
$trnnum = $_GET['id'];

$sql2 = "SELECT * FROM tournee WHERE `tournee`.`TRNNUM` = '$trnnum';";	
$result = tableSQL($sql2);
$cpt = compteSQL($sql2);



foreach ($result as $ligne) {



	                    $vehimmat = $ligne['VEHIMMAT'];
	                    $chfid = $ligne['CHFID'];
	                    $trncommentaire = $ligne['TRNCOMMENTAIRE'];
	                    $trnpechauffeur = $ligne['TRNPECCHAUFFEUR'];
	                    $trndte = $ligne['TRNDTE'];

}



//requete pour nom du chaffeur
$sql3 = "SELECT CHFNOM FROM `chauffeur` WHERE CHFID = '$chfid';";
$result3 = champSQL($sql3);



$_SESSION["trnnum"] = $trnnum;



$sqlchauffeurs = "SELECT * FROM chauffeur"; 
	$cptchauffeurs = compteSQL($sqlchauffeurs);
	$resultschauff = tableSQL($sqlchauffeurs);


?>

<html>
<head>
	<title>AC12 -  ORGANISER UNE TOURNEE – FICHE TOURNEE</title>
</head>
<body>
		<form id="form0" action="modiftournee.php" method="GET">
			<fieldset style="width:330px">
				<legend> TOURNEE </legend>


					<label for="date" >Date</label>
					<input id="date" name="date"  value="<?php echo $trndte; ?>" size="50"  />
					<br><br>
					<label for="chauffeur">Chauffeur</label>
						<select name="chauffeur" id="chauffeur" <?php if ($cptchauffeurs==0) echo "disabled=\"disabled\""; ?>>
							<?php 
								echo "<option value=$chfid>$result3</option>";

								if ($cptchauffeurs>0) {						
									foreach ($resultschauff as $ligne) {
										//on extrait chaque valeur de la ligne courante
										$CHFID = $ligne[0];
										$CHFNOM = $ligne[1];
										//on affiche la ligne courante dans le select
										echo "<option value=$CHFID>$CHFNOM</option>";
									}											
								} else {
									echo "<option>BDD vide...</option>";
								}
							?>							
						</select>

						<br><br>

						<?php 
							$sql = "SELECT * FROM vehicule"; 
							$cpt = compteSQL($sql);
							$results = tableSQL($sql);		
						 ?>

					<label for="plaque">Vehicule</label>
						<select name="plaque" id="plaque"<?php if ($cpt==0) echo "disabled=\"disabled\""; ?>>

							<?php 
								echo "<option value=\"$vehimmat\" selected >$vehimmat</option>";
								if ($cpt>0) {						
									foreach ($results as $ligne) {
										//on extrait chaque valeur de la ligne courante
										$VEHIMAT = $ligne[0];
										//on affiche la ligne courante dans le select
										echo "<option value=$VEHIMAT>$VEHIMAT</option>";
									}											
								} else {
									echo "<option>BDD vide...</option>";
								}
							?>
						</select>


						<br><br>
						<label for="prisecharge">Pris en charge</label>
						<input type="datetime-local" disabled="disabled" name="prisecharge" id="prisecharge" value="<?php echo $trnpechauffeur; ?>" min="2000-06-07T00:00" max="2040-06-14T00:00">
						<br><br>
						<label for="comment">Commentaire</label>
						<textarea id="comment" name="comment" ><?php echo $trncommentaire; ?></textarea>
						<br>
						<button type="submit" name="action" value="valider" onclick="window.location='../PageAC12/modiftournee.php'">Valider<img src="../images/forward_48.png" style="width: 19px"></button>

						<button type="reset"  value="reset">Annuler<img src="../images/delete_24.png" style="width: 19px" disabled="disabled"></button>


			</fieldset>
		</form>

		<form id="form" action="process_ac12.php" method="GET">

			<fieldset style="width:330px">
				<legend>ETAPES</legend>

				<?php 
					$sql = "SELECT ETPID, LIEUNOM 
						FROM commune, lieu, etape 
						WHERE commune.VILID = lieu.VILID 
						AND etape.LIEUID = lieu.LIEUID 
						AND TRNNUM = $trnnum";
							$results = tableSQL($sql);	
						 

									foreach ($results as $ligne) {
										//on extrait chaque valeur de la ligne courante
										$ETPID = $ligne[0];
										$lieuNom = $ligne[1];
										//on affiche la ligne courante dans le select
										echo $ETPID." ".$lieuNom."    <a href=\"ac12_supr_etp.php?id=$trnnum&test=$ETPID\">  <img src=\"../images/delete_24.png\" style=\"width:19px; float: right;\"></a><a href=\"..\PageAC13\ModifierEtape.php?id=$trnnum&test=$ETPID\"><img src=\"../images/edit.png\" style=\"height:19px; float: right;\"></a><br><br>";
									}

?>
			<button type="submit" name="action" value="ajouter"><img src="../images/plus_24.png" style="width: 19px">  Ajouter</button>
			</fieldset>	

		</form>

<style type="text/css">

	label{
	display: block;
	width: 150px;
	float: left;
	}

	#action{
		float: right;
	}


	input, select{
	width: 160px;
	}

</style>

</body>
</html>