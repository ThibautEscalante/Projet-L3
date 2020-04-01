<!DOCTYPE html>
<html>
<head>
<title>Interface</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href= "" type="text/css" media="screen" />

	<body>
			<div>
							
			</div>
			
			<h1> Emissions de gaz à effet de serres pour la production d'électricité en France	 </h1>
			<?php 
			include("../Interface/bd.php");
			$bdd = getBD();
			$rep = $bdd->query("select * from consommation where dateCons LIKE '2014-01'");
			
			while ($ligne = $rep -> fetch() ){
				echo "date : " . $ligne['dateCons']	. ", code région : " . $ligne['codeINSEE']	. ", consommation : " . $ligne['Consommation'] . "</br>";
			}
			?>
			
			<footer>Mails :</footer>
	</body>
</html>