<?php 

// SE CONNECTER A LA BDD
include "..\connexion\connectAD.php";



// on va chercher tous les infos de la table test
$sql = "SELECT * FROM chauffeur"; 
	$cpt = compteSQL($sql);
						
// on recupere le resultat sous forme d'un tableau
$results = tableSQL($sql);		

?>

<html>
<head>
	<title>AC12 -  ORGANISER UNE TOURNEE – FICHE TOURNEE</title>
</head>
<body>

		<form id="form" action="process_ac12.php" method="GET">
			<fieldset style="width:330px">
				<legend> TOURNEE </legend>


					<label for="date" >Date</label>
					<input id="date" name="date" type="date" value="" size="10"  />
					<br><br>
					<label for="chauffeur">Chauffeur</label>
						<select  name="chauffeur" id="chauffeur" <?php if ($cpt==0) echo "disabled=\"disabled\""; ?>>
							<?php 
								if ($cpt>0) {						
									foreach ($results as $ligne) {
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

						<!-- Remorque  -->
						<?php 
							$sql = "SELECT * FROM remorque";
							$cpt = compteSQL($sql);
							$results = tableSQL($sql);
						 ?>
						<label for="remorque">Remorque:</label>
						<select name="remorque" id="remorque"<?php if ($cpt==0) echo "disabled=\"disabled\""; ?>>

							<option value="rien">Pas de remorque</option>

							<?php 
								if ($cpt>0) {						
									foreach ($results as $ligne) {
										//on extrait chaque valeur de la ligne courante
										$idRemorque = $ligne[0];
										//on affiche la ligne courante dans le select
										echo "<option value=$idRemorque>$idRemorque</option>";
									}											
								} else {
									echo "<option>BDD vide...</option>";
								}
							?>
						</select>

						<br><br>
						<label for="datetime">Pris en charge</label>
						<input type="datetime-local" name="datetime" value="2018-06-12T19:30"min="2018-06-07T00:00" max="2030-06-14T00:00">
						<br><br>
						<label for="comment">Commentaire</label>
						<textarea id="comment" name="comment"></textarea>
						<br>
						<button type="submit" name="action" value="ajouterT">Ajouter une tournee<img src="../images/forward_48.png" style="width: 19px"></button>
						<button type="reset"  value="reset" onclick="window.location='../PageAC11/Tableau.php'">Annuler<img src="../images/delete_24.png" style="width: 19px"></button>


			</fieldset>	
				<?php
								if (isset($_GET['message']))
									echo $_GET['message'];
								else
									echo "&nbsp;";
								?>
		</form>

<style type="text/css">

	label{
	display: block;
	width: 150px;
	float: left;
	}

	#test{
		float: right;
	}


	input, select{
	width: 160px;
	}

</style>

</body>
</html>