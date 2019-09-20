<?php 

//connexion
include "..\connexion\connectAD.php";


//data
$trnnum = $_GET['id'];
$ETPID = $_GET['test'];

$sql = "SELECT `LIEUID`,`ETPHREDEBUT`,`ETPHREFIN`,`ETPCOMMENTAIRE` FROM etape where trnnum = $trnnum AND etpid = $ETPID;";
$result = tableSQL($sql);


foreach ($result as $ligne) {

	                    $lieuid = $ligne['LIEUID'];
	                    $etphredebut = $ligne['ETPHREDEBUT'];
	                    $etphrefin = $ligne['ETPHREFIN'];
	                    $etpcommentaire = $ligne['ETPCOMMENTAIRE'];

}

$sqllieu = "SELECT LIEUNOM from lieu where LIEUID = $lieuid";
$resultlieu = champSQL($sqllieu);
 ?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="fr" />
	<link rel="stylesheet"
		  type="text/css"
		  href="..\..\CSS\OrgaTourneeFicheEtap.css" />
	<title>ORGANISER UNE TOURNEE – FICHE ETAPE</title>
</head>

<body>
	
	<p>
		<form id="" action="process_ModifierEtape.php" method="get" style=width:35%>

			<input id="tournee" name="tournee" type="hidden" value="<?php echo "$trnnum" ?>" />
			<input id="etpid" name="etpid" type="hidden" value="<?php echo "$ETPID" ?>" />
			<fieldset>
				<legend>AC 13 - Organiser les tournées - Tournée
					<!-- Insert numéro tournée --> Etape
					<!-- Numéro etape-->
				</legend>
				<label for="lieu">Lieu</label> <!-- Menu déroulant + image fleche verte vers le bas (Images/arrow_down_24.png)-->
				<?php
				$sql = "SELECT * FROM lieu"; 
				$cpt = compteSQL($sql);
				$results = tableSQL($sql);
				?>
					<select size="1" 
			        name="lieu" 
			        id="lieu"
					class="lieu"
					style="width:192px"
			        <?php 
                 		if ($cpt==0) 
                   			echo "disabled=\"disabled\""; 
                 	?>	     									>
                <optgroup label="Choisissez un lieu"> 	
				<!-- Remplissage le la liste deroulante -->
				<?php 
					if ($cpt>0) {

						echo "<option value=\"$lieuid\" selected>$resultlieu</option>";					
						foreach ($results as $ligne) {
							//on extrait chaque valeur de la ligne courante
							$lieuid = $ligne[0];
							$vilid = $ligne[1];
							$lieunom = $ligne[2];
							$lieucoordgps = $ligne[3];
							//on affiche la ligne courante dans le select
							echo "<option value=$lieuid>$lieunom</option>";
						}											
					} else {
						echo "<option>Aucune information...</option>";
					}
				?>
				</optgroup>
			</select>	
				<br /><br>





				<label for="rdvdate1">Rendez vous entre</label> <!-- Selection Date + heures-->
				<input class="rdvdate1" name="rdvdate1" type="datetime-local" value="<?php echo $etphredebut; ?>" size="10" maxlength="80" /><br/>
				<br>
				<label for="rdvdate2">Et le</label> <!-- Selection Date + heures-->
				<input class="rdvdate2" name="rdvdate2" type="datetime-local" value="" size="10" maxlength="80" /> <br /><br>
				<label for="dateprisecharge">Pris en charge le</label> <!-- Selection Date + heures-->
				<input class="dateprisecharge" name="dateprisecharge" disabled="disabled" type="datetime-local" value="" size="10" maxlength="80" /> <br /><br>
				<!-- Zone texte large-->
				Commentaire <div id="text"><textarea class="commentaire" name="commentaire" type="text" value="" cols="24" rows="10"><?php echo $etpcommentaire ?></textarea></div>
				<br /> <!-- Zone texte large-->
				<?php
								if (isset($_GET['message']))
									echo $_GET['message'];
								else
									echo "&nbsp;";
								?><br/><br/>
				<button class="valider" name="valider" type="submit" value="Valider" title="" onclick="if(!confirm('Voulez-vous confirmez?')) return false;"> <img src="..\..\Images\check_mark_24.png" width="14" height="14"/> Valider </button> <!--image check vert (Images/check_mark_24.png) -->
				<button class="annuler" name="annuler" type="reset" value="Annuler" title="" onclick="window.location='../PageAC11/Tableau.php'"> <img src="..\..\Images\delete_24.png" width="14" height="14"/> Annuler </button> <!-- + image croix rouge (Images/delete_24.png)-->
		</form>
		
	</p>
</body>

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

</html>