<!DOCTYPE html>
<html>
<head>
	<title>Panel De Commande</title>
</head>
<body>

<form id="someForm" action="" method="" target="">
	<fieldset style="width: 350px">
		<legend>Vider ou Remplir la BDD Chauffeur:</legend>
					<style type="text/css">

								.button2 {background-color: #008CBA;
									  border: none;
								  color: white;
								  padding: 15px 32px;
								  text-align: center;
								  text-decoration: none;
								  display: inline-block;
								  font-size: 16px;
								  margin: 4px 2px;
								  cursor: pointer;} /* Blue */
								  
								.button3 {background-color: #f44336;
									  border: none;
								  color: white;
								  padding: 15px 32px;
								  text-align: center;
								  text-decoration: none;
								  display: inline-block;
								  font-size: 16px;
								  margin: 4px 2px;
								  cursor: pointer;} /* Red */ 

								

					</style>
								

				<button class="button2" onclick="remplir()">Remplir</button>
				<button class="button3" onclick="vider()">Vider</button></style>

							<?php		   
            
					    			if (isset($_GET['message2']))
					    				echo $_GET['message2'];
					    			else
					    				echo "&nbsp;";
    						?>														
	</fieldset>

<br>


	<fieldset style="width: 350px">
		<legend>Vider ou Remplir IMMATRICULATION:</legend>
					

				<button class="button2" onclick="remplirIM()">Remplir</button>
				<button class="button3" onclick="viderIM()">Vider</button></style>	

			<?php		   
            
    			if (isset($_GET['message']))
    				echo $_GET['message'];
    			else
    				echo "&nbsp;";
    		?>													
	</fieldset>

</form>



	<script type="text/javascript">

			form=document.getElementById("someForm");
			

					function remplir() {
					    form.action="remplirBDD.php";
						form.submit();
					}

					function vider() {
						form.action="viderBDD.php";
						form.submit();
					}


						function remplirIM() {
					    form.action="remplirIMBDD.php";
						form.submit();
					}

					function viderIM() {
						form.action="viderIMBDD.php";
						form.submit();
					}
														 
	</script>

</body>
</html>