<!DOCTYPE html>

<html>  

    <head>

        <meta charset="utf-8" />

        <title>Titre</title>

        <link href="StyleAll.css" rel="stylesheet">

        <link href="StylePff.css" rel="stylesheet">

        

        <script src="Chart.bundle.js"> </script>

        

        <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>

        

    </head>



    <body>

    

    	<h1>Mon Camembert Statistique</h1>

    	

    	<?php

    	

    	include("Interface/bd.php");

		$db=getBD();

    	
		
		if(!isset($_GET['mois'])) {
		
			$annee = $_GET['annee'];

			$eProd=$db->query("SELECT SUM(QuantiteProd) FROM production AND production.codeINSEE=44" AND dateProd=LIKE‘$annee%’);

			$eNuk=$db->query("SELECT SUM(QuantiteProd) FROM production WHERE production.typeProd='nucleaire' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee%’);

			$eCha=$db->query("SELECT SUM(QuantiteProd) FROM production WHERE production.typeProd='charbon' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee%’);

			$eFio=$db->query("SELECT SUM(QuantiteProd) FROM production WHERE production.typeProd='fioul' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee%’);

			$eGaz=$db->query("SELECT SUM(QuantiteProd) FROM production WHERE production.typeProd='gaz' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee%’);

			$eHyd=$db->query("SELECT SUM(QuantiteProd) FROM production WHERE production.typeProd='hydraulique' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee%’);

			$eEol=$db->query("SELECT SUM(QuantiteProd) FROM production WHERE production.typeProd='eolien' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee%’);

			$eSol=$db->query("SELECT SUM(QuantiteProd) FROM production WHERE production.typeProd='solaire' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee%’);

			$eBio=$db->query("SELECT SUM(QuantiteProd) FROM production WHERE production.typeProd='bio-energies' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee%’); }

		else  {
		
			$mois = $_GET['mois'];
			
			$annee = $_GET['annee'];
			
			$eProd=$db->query("SELECT QuantiteProd FROM production AND production.codeINSEE=44" AND dateProd=LIKE‘$annee-$mois’);

			$eNuk=$db->query("SELECT QuantiteProd FROM production WHERE production.typeProd='nucleaire' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee-$mois’);

			$eCha=$db->query("SELECT QuantiteProd FROM production WHERE production.typeProd='charbon' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee-$mois’);

			$eFio=$db->query("SELECT QuantiteProd FROM production WHERE production.typeProd='fioul' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee-$mois’);

			$eGaz=$db->query("SELECT QuantiteProd FROM production WHERE production.typeProd='gaz' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee-$mois’);

			$eHyd=$db->query("SELECT QuantiteProd FROM production WHERE production.typeProd='hydraulique' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee-$mois’);

			$eEol=$db->query("SELECT QuantiteProd FROM production WHERE production.typeProd='eolien' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee-$mois’);

			$eSol=$db->query("SELECT QuantiteProd FROM production WHERE production.typeProd='solaire' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee-$mois’);

			$eBio=$db->query("SELECT QuantiteProd FROM production WHERE production.typeProd='bio-energies' AND production.codeINSEE=44" AND dateProd=LIKE‘$annee-$mois’);
			
		}

		$neweProd=json_encode($eProd);

		$neweNuk=json_encode($eNuk);

		$neweCha=json_encode($eCha);

		$neweFio=json_encode($eFio);

		$neweGaz=json_encode($eGaz);

		$neweHyd=json_encode($eHyd);

		$neweEol=json_encode($eEol);

		$neweSol=json_encode($eSol);

		$neweBio=json_encode($eBio);	

		

		?>

    	

    	

    	<div style= "{width="256" height="250"}" > </div>

    	<canvas id="mycanvas"> </canvas>

    	<script>

			    	

    		var ctx = document.getElementById('mycanvas').getContext('2d');

    		

			var chart = new Chart(ctx, {

    		

    		type: 'pie',



    		

   		data: {

        		labels: ['nucléaire','charbon','fioul','gaz','hydraulique','éolien','solaire','bio-énergies'],

        		datasets: [{

            		label: 'My First dataset',

            		backgroundColor: ['#E91E63', '#673AB7', '#CDDC39', '#FFC107', '#2196F3' , '#607D8B' ],

            		borderColor: 'black',

            		hoverBackgroundColor: ['#F06292','#9575CD','#DCE775','#FFD54F', '#90CAF9' ,'#B0BEC5'],

            		data: [<?php echo $eNuk; ?>,<?php echo $eCha; ?>,<?php echo $eFio; ?>,<?php echo $eGaz; ?>,<?php echo $eHyd; ?>,<?php echo $eEol; ?>,<?php echo $eSol; ?>,<?php echo $eBio; ?>]

        		}]

    		},



    		options: {

				title : {

				text:"Production",

				display : true, 

				fontSize :35,

				fontFamily :"'Lato', sans-serif",

				



				},

				

    		

    		}

				    		

    		

    		

			});

    	

    	</script>

    </body>

</html>