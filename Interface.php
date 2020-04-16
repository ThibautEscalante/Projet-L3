<!DOCTYPE html>
<html>
<head>
<title>Interface</title>
<meta content="width=device-width" charset="UTF-8" />
<link rel="stylesheet" href= "StylePff.css" type="text/css" media="screen" />
<link href="StyleAll.css" rel="stylesheet">

	<body>
		<header>
		
			<nav class="menu"> 
			
				<div class="conteneur">
				
    				<div class="left">	
    					
						<h1 class="logo"> <i class="fas fa-bolt"></i> WattsonEnergie </h1>
						
					</div>	
					
					<div class="left">
					
						<a href="AccF.html" class="liensMenu" > Accueil</a>
						<a href="AProposDeNous.html" class="liensMenu" > A Propos De Nous</a>
						<a href="Contact.html" class="liensMenu" > Contact</a>
						<a href="SeConnecter.php" class="liensMenu" > Se Connecter</a>
						
    				</div>
    				
    			</div>	
    			
			</nav>
			
		</header>
			<div>
							
			</div>
			
			<h1> Emissions de gaz à effet de serres pour la production d'électricité en France	 </h1>
			
			<?php 
			include("Interface/bd.php");
			$bdd = getBD();
			
			if ( isset($_GET['region']) == False ){
				echo "<script src='cmap/france-map.js'></script><script>francefree();</script>";
			} else {
				$region = $_GET['region'];
				echo "<script src='cmap/france-map.js'></script><script>francefree();</script>";
				echo '<form action="Interface.php"></br>
						Sélectionnez un laps de temps : <input type="month" name="date1" id="date" min="2014-01" max="2019-12"> 
						à <input type="month" name="date2" id="date" min="2014-01" max="2019-12">
						<input type="hidden" name=region value="'.$region.'" /> 
						<input type="submit" value="envoyer" ></form>';
							
				
				
			}
			
			?>
			<footer>Mails :</footer>
	</body>
</html>