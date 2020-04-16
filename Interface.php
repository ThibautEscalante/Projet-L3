<!DOCTYPE html>
<html>
<head>
<title>Interface</title>
<meta content="width=device-width" charset="UTF-8" />
<link rel="stylesheet" href= "StylePff.css" type="text/css" media="screen" />
<link href="StyleAll.css" rel="stylesheet">
<script src="Chart.bundle.js"></script>
</head>

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
				$date1 = $_GET['date1'];
				$date2 = $_GET['date2'];
				echo "<script src='cmap/france-map.js'></script><script>francefree();</script>";
				echo '<form action="Interface.php"></br>
						Sélectionnez un laps de temps : <input type="month" name="date1" id="date" min="2014-01" max="2019-12"> 
						à <input type="month" name="date2" id="date" min="2014-01" max="2019-12">
						<input type="hidden" name=region value="'.$region.'" /> 
						<input type="submit" value="envoyer" ></form>';
			
	$bdd=mysqli_connect('127.0.0.1', 'root', '', 'energie', '3308');
	if(!$bdd) {
		die('erreur de connexion : ' . mysqli_connect_error());
	}
	
	
	$nuc = mysqli_query($bdd, "SELECT SUM(production.QuantiteProd) FROM production WHERE production.typeProd='nucleaire' AND production.codeINSEE='".$region."' AND dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($nuc)
	{
	
		while ($prodnuc = mysqli_fetch_array($nuc))
		{
			$QuantiteProdNuc = $prodnuc[0];
			$DataNuc[] = $QuantiteProdNuc;
		
		$Data_Json_Nuc = json_encode($DataNuc, JSON_NUMERIC_CHECK);
		}
        
	}
	
	
	$eol = mysqli_query($bdd, "SELECT SUM(production.QuantiteProd) FROM production WHERE production.typeProd='eolien' AND production.codeINSEE='".$region."' AND dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($eol)
	{

		while ($prodeol = mysqli_fetch_array($eol))
		{
			$QuantiteProdEol = $prodeol[0];
			$DataEol[] = $QuantiteProdEol;
		
		$Data_Json_Eol = json_encode($DataEol, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$cha = mysqli_query($bdd, "SELECT SUM(production.QuantiteProd) FROM production WHERE production.typeProd='charbon' AND production.codeINSEE='".$region."' AND dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($cha)
	{
	
		while ($prodcha = mysqli_fetch_array($cha))
		{
			$QuantiteProdCha = $prodcha[0];
			
			$DataCha[] = $QuantiteProdCha;
		
		 
		$Data_Json_Cha = json_encode($DataCha, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$gaz = mysqli_query($bdd, "SELECT SUM(production.QuantiteProd) FROM production WHERE production.typeProd='gaz' AND production.codeINSEE='".$region."' AND dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($gaz)
	{
	
		while ($prodgaz = mysqli_fetch_array($gaz))
		{
			$QuantiteProdGaz = $prodgaz[0];
			
			$DataGaz[] = $QuantiteProdGaz;
		
		 
		$Data_Json_Gaz = json_encode($DataGaz, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$sol = mysqli_query($bdd, "SELECT SUM(production.QuantiteProd) FROM production WHERE production.typeProd='solaire' AND production.codeINSEE='".$region."' AND dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($sol)
	{
	
		while ($prodsol = mysqli_fetch_array($sol))
		{

			$QuantiteProdSol = $prodsol[0];
			$DataSol[] = $QuantiteProdSol;
		
		$Data_Json_Sol = json_encode($DataSol, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$hyd = mysqli_query($bdd, "SELECT SUM(production.QuantiteProd) FROM production WHERE production.typeProd='hydraulique' AND production.codeINSEE='".$region."' AND dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($hyd)
	{

		while ($prodhyd = mysqli_fetch_array($hyd))
		{
			$QuantiteProdHyd = $prodhyd[0];
			$DataHyd[] = $QuantiteProdHyd;
		
		$Data_Json_Hyd = json_encode($DataHyd, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$bio = mysqli_query($bdd, "SELECT SUM(production.QuantiteProd) FROM production WHERE production.typeProd='bio-energies' AND production.codeINSEE='".$region."' AND dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($bio)
	{
	
		while ($prodbio = mysqli_fetch_array($bio))
		{

			$QuantiteProdBio = $prodbio[0];
			$DataBio[] = $QuantiteProdBio;
		
		$Data_Json_Bio = json_encode($DataBio, JSON_NUMERIC_CHECK);
		}
        
	}
	}
?>
	
	<div style="width: 75%">
		<canvas id="myChart"></canvas>
	</div>

	<script>
		Chart.defaults.global.title.display = true;
		Chart.defaults.global.title.text = "La Production en Region";
		Chart.defaults.global.title.fontSize = 18;
		
	</script>


	<script>
		var ctx = document.getElementById('myChart').getContext('2d');
		
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: 'pie',

			// The data for our dataset
			data: {
				datasets: [{
					data : [
						<?php echo $Data_Json_Nuc; ?>,
						<?php echo $Data_Json_Eol; ?>,
						<?php echo $Data_Json_Cha; ?>,
						<?php echo $Data_Json_Gaz; ?>,
						<?php echo $Data_Json_Sol; ?>,
						<?php echo $Data_Json_Hyd; ?>,
						<?php echo $Data_Json_Bio; ?>,
					],
					backgroundColor : [
						'rgb(0, 0, 0)',
						'rgb(255, 255, 0)',
						'rgb(80, 20, 110)',
						'rgb(150, 150, 150)',
						'rgb(255, 0, 0)',
						'rgb(60, 100, 255)',
						'rgb(0, 255, 0)',
					],
					label: 'La production en Occitanie'
				}],
				labels: [
					'nucléaire',
					'éolien',
					'charbon',
					'gaz',
					'solaire',
					'hydraulique',
					'bio-énergies'
				]
			},
		// Configuration options go here
		options: {
			legend: {
				display: true,
				position: 'right'
			},
		}
	});
	</script>
			
			
			<footer>Mails :</footer>
	</body>
</html>
<?php
	mysqli_close($bdd);
?>