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
		 
	$Get_Infos_Prod = mysqli_query($bdd, "SELECT * FROM production");
	if($Get_Infos_Prod)
	{
		$Labels = array();
		while ($production = mysqli_fetch_array($Get_Infos_Prod))
		{
			$dateProd = $production['dateProd'];
			$QuantiteProd = $production['dateProd'];
			 
			$Labels[] = $dateProd;
			$Data[] = $QuantiteProd;
		}
		 
		$Labels_Json = json_encode($Labels);
		$Data_Json = json_encode($Data, JSON_NUMERIC_CHECK);
	}
?>
	
	<div style="width: 75%">
		<canvas id="myChart"></canvas>
	</div>

	<script>
		Chart.defaults.global.title.display = true;
		Chart.defaults.global.title.text = "Evolution des émissions en CO2";
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
					label: 'bio-energies',
					backgroundColor: 'rgb(71, 170, 211, 0.25)',
					borderColor: 'rgb(71, 170, 211)',
					data: <?php echo $Data_Json; ?>
				}]
			},
		// Configuration options go here
		options: {}
	});
	</script>
</body>
</html>
<?php
	mysqli_close($bdd);
?>