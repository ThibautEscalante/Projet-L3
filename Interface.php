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
						
    				</div>
    				
    			</div>	
    			
			</nav>
			
		</header>
			<div>
							
			</div>
			
			
			<?php 
			
			$bdd=mysqli_connect('127.0.0.1', 'root', '', 'energie', '3308');
			if(!$bdd) {
				die('erreur de connexion : ' . mysqli_connect_error());
			}
			
			if ( isset($_GET['region']) == False ){
				echo "<div id='maCarte'><h3>Cliquez sur une région.</h3><script src='cmap/france-map.js'></script><script>francefree();</script></div>";
			} else {
				$region = $_GET['region'];
				echo "<div id='maCarte'><h3>Cliquez sur une région.</h3><script src='cmap/france-map.js'></script><script>francefree();</script>";
				echo '<form action="Interface.php" id="calend"></br>
						Sélectionnez un laps de temps : </br><input type="month" name="date1" id="date" min="2014-01" max="2019-12"> 
						à <input type="month" name="date2" id="date" min="2014-01" max="2019-12">
						<input type="hidden" name=region value="'.$region.'" /> 
						<input type="submit" value="Envoyer" ></form></div>';
						
				if ( isset($_GET['date1']) == True){
					$date1 = $_GET['date1'];
					$date2 = $_GET['date2'];
			
	
	$reqRegion = mysqli_query($bdd, "SELECT region.Region FROM region WHERE region.CodeInsee='".$region."'");
	$arRegion = mysqli_fetch_array($reqRegion);
	$nomRegion = $arRegion[0];
	
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
	
	
	echo '<div id="graphes"><div">
		<canvas id="myChart"></canvas>
	</div>';

	echo '<script>
		Chart.defaults.global.title.display = true;
		Chart.defaults.global.title.text = "La production en '. $nomRegion.'";
		Chart.defaults.global.title.fontSize = 18;
		
	</script>';


	echo "<script>
		var ctx = document.getElementById('myChart').getContext('2d');
		
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: 'pie',

			// The data for our dataset
			data: {
				datasets: [{
					data : [
						".  $Data_Json_Nuc .",
						".  $Data_Json_Eol .",
						".  $Data_Json_Cha .",
						".  $Data_Json_Gaz .",
						".  $Data_Json_Sol .",
						".  $Data_Json_Hyd .",
						".  $Data_Json_Bio .",
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
					label: 'La production'
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
			responsive:false,
			legend: {
				display: true,
				position: 'right'
			},
			animation:{
				segmentShowStroke : false,
    			animateScale : true
    		},
    		
    	
		}
	});
	</script>";

			

	
	
	$nuc2 = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='nucleaire' AND production.codeINSEE='".$region."' AND production.dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($nuc2)
	{
		$Labels2 = array();
	
		while ($prodnuc2 = mysqli_fetch_array($nuc2))
		{
			$dateProd2 = $prodnuc2['dateProd'];
			$QuantiteProdNuc2 = $prodnuc2['QuantiteProd']*6;
			
			$Labels2[] = $dateProd2;
			$DataNuc2[] = $QuantiteProdNuc2;
		
		 
		$Labels_Json2 = json_encode($Labels2);
		$Data_Json_Nuc2 = json_encode($DataNuc2, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$eol2 = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='eolien' AND production.codeINSEE='".$region."' AND production.dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($eol2)
	{
		$Labels2 = array();
	
		while ($prodeol2 = mysqli_fetch_array($eol2))
		{
			$dateProd2 = $prodeol2['dateProd'];
			$QuantiteProdEol2 = $prodeol2['QuantiteProd']*15;
			
			$Labels2[] = $dateProd2;
			$DataEol2[] = $QuantiteProdEol2;
		
		 
		$Labels_Json2 = json_encode($Labels2);
		$Data_Json_Eol2 = json_encode($DataEol2, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$cha2 = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='charbon' AND production.codeINSEE=".$region." AND production.dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($cha2)
	{
		$Labels2 = array();
	
		while ($prodcha2 = mysqli_fetch_array($cha2))
		{
			$dateProd2 = $prodcha2['dateProd'];
			$QuantiteProdCha2 = $prodcha['QuantiteProd']*1060;
			
			$Labels2[] = $dateProd2;
			$DataCha2[] = $QuantiteProdCha2;
		
		 
		$Labels_Json2 = json_encode($Labels2);
		$Data_Json_Cha2 = json_encode($DataCha2, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$gaz2 = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='gaz' AND production.codeINSEE=".$region." AND production.dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($gaz2)
	{
		$Labels2 = array();
	
		while ($prodgaz2 = mysqli_fetch_array($gaz2))
		{
			$dateProd2 = $prodgaz2['dateProd'];
			$QuantiteProdGaz2 = $prodgaz2['QuantiteProd']*418;
			
			$Labels2[] = $dateProd2;
			$DataGaz2[] = $QuantiteProdGaz2;
		
		 
		$Labels_Json2 = json_encode($Labels2);
		$Data_Json_Gaz2 = json_encode($DataGaz2, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$sol2 = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='solaire' AND production.codeINSEE=".$region." AND production.dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($sol2)
	{
		$Labels2 = array();
	
		while ($prodsol2 = mysqli_fetch_array($sol2))
		{
			$dateProd2 = $prodsol2['dateProd'];
			$QuantiteProdSol2 = $prodsol2['QuantiteProd']*55;
			
			$Labels2[] = $dateProd2;
			$DataSol2[] = $QuantiteProdSol2;
		
		 
		$Labels_Json2 = json_encode($Labels2);
		$Data_Json_Sol2 = json_encode($DataSol2, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$hyd2 = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='hydraulique' AND production.codeINSEE=".$region." AND production.dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($hyd2)
	{
		$Labels2 = array();
	
		while ($prodhyd2 = mysqli_fetch_array($hyd2))
		{
			$dateProd2 = $prodhyd2['dateProd'];
			$QuantiteProdHyd2 = $prodhyd2['QuantiteProd']*6;
			
			$Labels2[] = $dateProd2;
			$DataHyd2[] = $QuantiteProdHyd2;
		
		 
		$Labels_Json2 = json_encode($Labels2);
		$Data_Json_Hyd2 = json_encode($DataHyd2, JSON_NUMERIC_CHECK);
		}
        
	}
	
	$bio2 = mysqli_query($bdd, "SELECT * FROM production WHERE typeProd='bio-energies' AND production.codeINSEE=".$region." AND production.dateProd BETWEEN '".$date1."' AND '".$date2."'");
	if($bio2)
	{
		$Labels2 = array();
	
		while ($prodbio2 = mysqli_fetch_array($bio2))
		{
			$dateProd2 = $prodbio2['dateProd'];
			$QuantiteProdBio2 = $prodbio2['QuantiteProd']*22;
			
			$Labels2[] = $dateProd2;
			$DataBio2[] = $QuantiteProdBio2;
		
		 
		$Labels_Json2 = json_encode($Labels2);
		$Data_Json_Bio2 = json_encode($DataBio2, JSON_NUMERIC_CHECK);
		}
        
	}
	$i = 0;
	$DataTot[] = array();
	while($i < sizeof($DataNuc2)){
		$DataTot[$i] = $DataBio2[$i] + $DataEol2[$i] + $DataCha2[$i] + $DataGaz2[$i] + $DataSol2[$i] + $DataHyd2[$i] + $DataNuc2[$i];
		$i++;
	}
   $Data_Json_Tot = json_encode($DataTot, JSON_NUMERIC_CHECK);
	
	echo '<div>
		<canvas id="myChart2"></canvas>
	</div>';

	echo '<script>
		Chart.defaults.global.title.display = true;
		Chart.defaults.global.title.text = "Evolution des émissions en CO2 en '.$nomRegion.'";
		Chart.defaults.global.title.fontSize = 18;
		
	</script>';


	echo "<script>
		var ctx = document.getElementById('myChart2').getContext('2d');
		
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: 'line',

			// The data for our dataset
			data: {
				labels: ". $Labels_Json2.",
				datasets: [{
					label: 'Nucléaire',
					fill: false,
					backgroundColor: 'rgb(0, 0, 0)',
					borderColor: 'rgb(0, 0, 0)',
					data: ". $Data_Json_Nuc2."
				}, {
					label: 'Eolien',
					fill: false,
					backgroundColor: 'rgb(255, 255, 0)',
					borderColor: 'rgb(255, 255, 0)',
					data: ". $Data_Json_Eol2."
				}, {
					label: 'Charbon',
					fill: false,
					backgroundColor: 'rgb(80, 20, 110)',
					borderColor: 'rgb(80, 20, 110)',
					data: ". $Data_Json_Cha2."
				}, {
					label: 'Gaz',
					fill: false,
					backgroundColor: 'rgb(150, 150, 150)',
					borderColor: 'rgb(150, 150, 150)',
					data: ". $Data_Json_Gaz2."
				}, {
					label: 'Solaire',
					fill: false,
					backgroundColor: 'rgb(255, 0, 0)',
					borderColor: 'rgb(255, 0, 0)',
					data: ". $Data_Json_Sol2."
				}, {
					label: 'Hydraulique',
					fill: false,
					backgroundColor: 'rgb(60, 100, 255)',
					borderColor: 'rgb(60, 100, 255)',
					data: ". $Data_Json_Hyd2."
				}, {
					label: 'Bio-Energies',
					fill: false,
					backgroundColor: 'rgb(0, 255, 0)',
					borderColor: 'rgb(0, 255, 0)',
					data: ". $Data_Json_Bio2."
				}, {
              label: 'Total',
              fill: false,
              backgroundColor: 'rgb(250, 150, 30)',
              borderColor: 'rgb(250, 150, 30)',
              data: ". $Data_Json_Tot."
              }]	
			},
		// Configuration options go here
		options: {
			responsive: false,
			legend: {
            display: true,
            labels: {
                boxWidth:20
                }
            },
			scales: {
			  xAxes: [
				{
				  scaleLabel: {
					display: true,
					labelString: 'Date'
				  },
				}
			  ],
			  yAxes: [
				{
				  scaleLabel: {
					display: true,
					labelString: 'Valeur en tonnes d équilavents CO2 par GWh'
				  }
				}
			  ]
			},
		}
	});
	</script></div>";

	mysqli_close($bdd);
		}
		}
?>
	</body>
</html>
