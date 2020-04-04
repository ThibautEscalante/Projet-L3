<!DOCTYPE html>
<html>
<head>
<title>Interface</title>
<meta content="width=device-width" charset="UTF-8" />
<link rel="stylesheet" href= "" type="text/css" media="screen" />

	<body>
			<div>
							
			</div>
			
			<h1> Emissions de gaz à effet de serres pour la production d'électricité en France	 </h1>
			
			<?php 
			include("Interface/bd.php");
			$bdd = getBD();
			$rep = $bdd->query("select * from consommation where dateCons LIKE '2014-01'");
			
			while ($ligne = $rep -> fetch() ){
				echo "date : " . $ligne['dateCons']	. ", code région : " . $ligne['codeINSEE']	. ", consommation : " . $ligne['Consommation'] . "</br>";
			}
			$rep -> closeCursor();
			
			if ( isset($_GET['region']) == False ){
				echo "<script src='cmap/france-map.js'></script><script>francefree();</script>";
			} else {
				echo "<script src='cmap/france-map.js'></script><script>francefree();</script>";
				echo $_GET['region'];
			}
			
			?>
			<footer>Mails :</footer>
	</body>
</html>