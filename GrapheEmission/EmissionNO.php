<html lang="fr">
<head>

	<script src="dist/Chart.bundle.js"></script>
	<title>Graphiques</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

</head>
	<body>
	
	<h1> Emissions CO2</h1>
	
<?php
	$bdd=mysqli_connect('127.0.0.1', 'root', '', 'energie', '3308');
	if(!$bdd) {
		die('erreur de connexion : ' . mysqli_connect_error());
	}
	
	
	$nuc = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='nucleaire' AND production.codeINSEE=28 ORDER BY dateProd ASC");
	if($nuc)
	{
		$Labels = array();
	
		while ($prodnuc = mysqli_fetch_array($nuc))
		{
			$dateProd = $prodnuc['dateProd'];
			$QuantiteProdNuc = $prodnuc['QuantiteProd'];
			
			$Labels[] = $dateProd;
			$DataNuc[] = $QuantiteProdNuc;
		
		 
		$Labels_Json = json_encode($Labels);
		$Data_Json_Nuc = json_encode($DataNuc, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$fio = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='fioul' AND production.codeINSEE=28 ORDER BY dateProd ASC");
	if($fio)
	{
		$Labels = array();
	
		while ($prodfio = mysqli_fetch_array($fio))
		{
			$dateProd = $prodfio['dateProd'];
			$QuantiteProdFio = $prodfio['QuantiteProd'];
			
			$Labels[] = $dateProd;
			$DataFio[] = $QuantiteProdFio;
		
		 
		$Labels_Json = json_encode($Labels);
		$Data_Json_Fio = json_encode($DataFio, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$eol = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='eolien' AND production.codeINSEE=28 ORDER BY dateProd ASC");
	if($eol)
	{
		$Labels = array();
	
		while ($prodeol = mysqli_fetch_array($eol))
		{
			$dateProd = $prodeol['dateProd'];
			$QuantiteProdEol = $prodeol['QuantiteProd'];
			
			$Labels[] = $dateProd;
			$DataEol[] = $QuantiteProdEol;
		
		 
		$Labels_Json = json_encode($Labels);
		$Data_Json_Eol = json_encode($DataEol, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$cha = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='charbon' AND production.codeINSEE=28 ORDER BY dateProd ASC");
	if($cha)
	{
		$Labels = array();
	
		while ($prodcha = mysqli_fetch_array($cha))
		{
			$dateProd = $prodcha['dateProd'];
			$QuantiteProdCha = $prodcha['QuantiteProd'];
			
			$Labels[] = $dateProd;
			$DataCha[] = $QuantiteProdCha;
		
		 
		$Labels_Json = json_encode($Labels);
		$Data_Json_Cha = json_encode($DataCha, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$gaz = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='gaz' AND production.codeINSEE=28 ORDER BY dateProd ASC");
	if($gaz)
	{
		$Labels = array();
	
		while ($prodgaz = mysqli_fetch_array($gaz))
		{
			$dateProd = $prodgaz['dateProd'];
			$QuantiteProdGaz = $prodgaz['QuantiteProd'];
			
			$Labels[] = $dateProd;
			$DataGaz[] = $QuantiteProdGaz;
		
		 
		$Labels_Json = json_encode($Labels);
		$Data_Json_Gaz = json_encode($DataGaz, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$sol = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='solaire' AND production.codeINSEE=28 ORDER BY dateProd ASC");
	if($sol)
	{
		$Labels = array();
	
		while ($prodsol = mysqli_fetch_array($sol))
		{
			$dateProd = $prodsol['dateProd'];
			$QuantiteProdSol = $prodsol['QuantiteProd'];
			
			$Labels[] = $dateProd;
			$DataSol[] = $QuantiteProdSol;
		
		 
		$Labels_Json = json_encode($Labels);
		$Data_Json_Sol = json_encode($DataSol, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$hyd = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='hydraulique' AND production.codeINSEE=28 ORDER BY dateProd ASC");
	if($hyd)
	{
		$Labels = array();
	
		while ($prodhyd = mysqli_fetch_array($hyd))
		{
			$dateProd = $prodhyd['dateProd'];
			$QuantiteProdHyd = $prodhyd['QuantiteProd'];
			
			$Labels[] = $dateProd;
			$DataHyd[] = $QuantiteProdHyd;
		
		 
		$Labels_Json = json_encode($Labels);
		$Data_Json_Hyd = json_encode($DataHyd, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$bio = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='bio-energies' AND production.codeINSEE=28 ORDER BY dateProd ASC");
	if($bio)
	{
		$Labels = array();
	
		while ($prodbio = mysqli_fetch_array($bio))
		{
			$dateProd = $prodbio['dateProd'];
			$QuantiteProdBio = $prodbio['QuantiteProd'];
			
			$Labels[] = $dateProd;
			$DataBio[] = $QuantiteProdBio;
		
		 
		$Labels_Json = json_encode($Labels);
		$Data_Json_Bio = json_encode($DataBio, JSON_NUMERIC_CHECK);
		}
        
	}
	
?>
	
	<div style="width: 75%">
		<canvas id="myChart"></canvas>
	</div>

	<script>
		Chart.defaults.global.title.display = true;
		Chart.defaults.global.title.text = "Evolution des émissions en CO2 en Normandie";
		Chart.defaults.global.title.fontSize = 18;
		
	</script>


	<script>
		var ctx = document.getElementById('myChart').getContext('2d');
		
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: 'line',

			// The data for our dataset
			data: {
				labels: <?php echo $Labels_Json; ?>,
				datasets: [{
					label: 'Nucléaire',
					fill: false,
					backgroundColor: 'rgb(0, 0, 0)',
					borderColor: 'rgb(0, 0, 0)',
					data: <?php echo $Data_Json_Nuc; ?>
				}, {
					label: 'Fioul',
					fill: false,
					backgroundColor: 'rgb(140, 170, 211, 0.25)',
					borderColor: 'rgb(140, 170, 211)',
					data: <?php echo $Data_Json_Fio; ?>
				}, {
					label: 'Eolien',
					fill: false,
					backgroundColor: 'rgb(255, 255, 0)',
					borderColor: 'rgb(255, 255, 0)',
					data: <?php echo $Data_Json_Eol; ?>
				}, {
					label: 'Charbon',
					fill: false,
					backgroundColor: 'rgb(80, 20, 110)',
					borderColor: 'rgb(80, 20, 110)',
					data: <?php echo $Data_Json_Cha; ?>
				}, {
					label: 'Gaz',
					fill: false,
					backgroundColor: 'rgb(150, 150, 150)',
					borderColor: 'rgb(150, 150, 150)',
					data: <?php echo $Data_Json_Gaz; ?>
				}, {
					label: 'Solaire',
					fill: false,
					backgroundColor: 'rgb(255, 0, 0)',
					borderColor: 'rgb(255, 0, 0)',
					data: <?php echo $Data_Json_Sol; ?>
				}, {
					label: 'Hydraulique',
					fill: false,
					backgroundColor: 'rgb(60, 100, 255)',
					borderColor: 'rgb(60, 100, 255)',
					data: <?php echo $Data_Json_Hyd; ?>
				}, {
					label: 'Bio-Energies',
					fill: false,
					backgroundColor: 'rgb(0, 255, 0)',
					borderColor: 'rgb(0, 255, 0)',
					data: <?php echo $Data_Json_Bio; ?>
				}]	
			},
		// Configuration options go here
		options: {
			responsive: true,
			scales: {
			  xAxes: [
				{
				  scaleLabel: {
					display: true,
					labelString: "Date"
				  },
				}
			  ],
			  yAxes: [
				{
				  scaleLabel: {
					display: true,
					labelString: "Valeur"
				  }
				}
			  ]
			},
		}
	});
	</script>
</body>
</html>
<?php
	mysqli_close($bdd);
?>