<html lang="fr">
<head>

	<script src="dist/Chart.bundle.js"></script>
	<title>Graphiques</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

</head>
	<body>
	
	<h1>Production d'énergie</h1>
	
<?php
	$bdd=mysqli_connect('127.0.0.1', 'root', '', 'energie', '3308');
	if(!$bdd) {
		die('erreur de connexion : ' . mysqli_connect_error());
	}
	
	
	$nuc = mysqli_query($bdd, "SELECT production.QuantiteProd FROM production WHERE production.typeProd='nucleaire' AND production.codeINSEE='".$_GET['region']."' AND dateProd BETWEEN '".$_GET['date1']."' AND '".$_GET['date2']."'");
	if($nuc)
	{
	
		while ($prodnuc = mysqli_fetch_array($nuc))
		{
			$QuantiteProdNuc = $prodnuc['QuantiteProd'];
			$DataNuc[] = $QuantiteProdNuc;
		
		$Data_Json_Nuc = json_encode($DataNuc, JSON_NUMERIC_CHECK);
		}
        
	}
	
	
	$eol = mysqli_query($bdd, "SELECT production.QuantiteProd FROM production WHERE production.typeProd='eolien' AND production.codeINSEE='".$_GET['region']."' AND dateProd BETWEEN '".$_GET['date1']."' AND '".$_GET['date2']."'");
	if($eol)
	{

		while ($prodeol = mysqli_fetch_array($eol))
		{
			$QuantiteProdEol = $prodeol['QuantiteProd'];
			$DataEol[] = $QuantiteProdEol;
		
		$Data_Json_Eol = json_encode($DataEol, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$cha = mysqli_query($bdd, "SELECT production.QuantiteProd FROM production WHERE production.typeProd='charbon' AND production.codeINSEE='".$_GET['region']."' AND dateProd BETWEEN '".$_GET['date1']."' AND '".$_GET['date2']."'");
	if($cha)
	{
	
		while ($prodcha = mysqli_fetch_array($cha))
		{
			$QuantiteProdCha = $prodcha['QuantiteProd'];
			
			$DataCha[] = $QuantiteProdCha;
		
		 
		$Data_Json_Cha = json_encode($DataCha, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$gaz = mysqli_query($bdd, "SELECT production.QuantiteProd FROM production WHERE production.typeProd='gaz' AND production.codeINSEE='".$_GET['region']."' AND dateProd BETWEEN '".$_GET['date1']."' AND '".$_GET['date2']."'");
	if($gaz)
	{
	
		while ($prodgaz = mysqli_fetch_array($gaz))
		{
			$QuantiteProdGaz = $prodgaz['QuantiteProd'];
			
			$DataGaz[] = $QuantiteProdGaz;
		
		 
		$Data_Json_Gaz = json_encode($DataGaz, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$sol = mysqli_query($bdd, "SELECT production.QuantiteProd FROM production WHERE production.typeProd='solaire' AND production.codeINSEE='".$_GET['region']."' AND dateProd BETWEEN '".$_GET['date1']."' AND '".$_GET['date2']."'");
	if($sol)
	{
	
		while ($prodsol = mysqli_fetch_array($sol))
		{

			$QuantiteProdSol = $prodsol['QuantiteProd'];
			$DataSol[] = $QuantiteProdSol;
		
		$Data_Json_Sol = json_encode($DataSol, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$hyd = mysqli_query($bdd, "SELECT production.QuantiteProd FROM production WHERE production.typeProd='hydraulique' AND production.codeINSEE='".$_GET['region']."' AND dateProd BETWEEN '".$_GET['date1']."' AND '".$_GET['date2']."'");
	if($hyd)
	{
	
		while ($prodhyd = mysqli_fetch_array($hyd))
		{
			$QuantiteProdHyd = $prodhyd['QuantiteProd'];
			$DataHyd[] = $QuantiteProdHyd;
		
		$Data_Json_Hyd = json_encode($DataHyd, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$bio = mysqli_query($bdd, "SELECT production.QuantiteProd FROM production WHERE production.typeProd='bio-energies' AND production.codeINSEE='".$_GET['region']."' AND dateProd BETWEEN '".$_GET['date1']."' AND '".$_GET['date2']."'");
	if($bio)
	{
	
		while ($prodbio = mysqli_fetch_array($bio))
		{

			$QuantiteProdBio = $prodbio['QuantiteProd'];
			$DataBio[] = $QuantiteProdBio;
		
		$Data_Json_Bio = json_encode($DataBio, JSON_NUMERIC_CHECK);
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
</body>
</html>
<?php
	mysqli_close($bdd);
?>