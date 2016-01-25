<?php
	session_start();
		echo "<style>
			body {
				background-color: whitesmoke;
				text-align: center;
			}

			h1 {
				color: red;
				text-align: center;
				font-family: 'Magneto';
			}
		</style>";
		echo "<h1>Results</h1>";
		
		$myfile = fopen("results.txt", "r+");
		$balloonYes = trim(fgets($myfile));
		$balloonNo = trim(fgets($myfile));
		$cakeYes = trim(fgets($myfile));
		$cakeNo = trim(fgets($myfile));
		$presentsYes = trim(fgets($myfile));
		$presentsNo = trim(fgets($myfile));
		$clownsYes = trim(fgets($myfile));
		$clownsNo = trim(fgets($myfile));

		$balloonNoPercent = round((($balloonNo/($balloonYes + $balloonNo)) * 100), 2);
		$balloonYesPercent = round((($balloonYes/($balloonYes + $balloonNo)) * 100), 2);
		$cakeNoPercent = round((($cakeNo/($cakeYes + $cakeNo)) * 100), 2);
		$cakeYesPercent = round((($cakeYes/($cakeYes + $cakeNo)) * 100), 2);
		$presentsNoPercent = round((($presentsNo/($presentsYes + $presentsNo)) * 100), 2);
		$presentsYesPercent = round((($presentsYes/($presentsYes + $presentsNo)) * 100), 2);
		$clownsNoPercent = round((($clownsNo/($clownsYes + $clownsNo)) * 100), 2);
		$clownsYesPercent = round((($clownsYes/($clownsYes + $clownsNo)) * 100), 2);
			
		if(isset($_SESSION['clowns'])){
			echo "You have already voted. Thank you.";
			displayResults();
		}
		else{				
			$balloon = $_REQUEST['balloon'];
			$_SESSION['balloon'] = $balloon;
			if($_SESSION['balloon'] == 1) {
				$balloonYes = $balloonYes + 1;
			}
			else{
				$balloonNo = $balloonNo + 1;	
			}
			
			$cake = $_REQUEST['cake'];
			$_SESSION['cake'] = $cake;
			if($_SESSION['cake'] == 1) {
				$cakeYes = $cakeYes + 1;
			}
			else{
				$cakeNo = $cakeNo + 1;	
			}
			
			$presents = $_REQUEST['presents'];
			$_SESSION['presents'] = $presents;
			if($_SESSION['presents'] == 1) {
				$presentsYes = $presentsYes + 1;
			}
			else{
				$presentsNo = $presentsNo + 1;	
			}
			
			$clowns = $_REQUEST['clowns'];
			$_SESSION['clowns'] = $clowns;
			if($_SESSION['clowns'] == 1) {
				$clownsYes = $clownsYes + 1;
			}
			else{
				$clownsNo = $clownsNo + 1;	
			}
			
			$myfile = fopen("results.txt", "w");
			fwrite($myfile, "$balloonYes\n$balloonNo\n$cakeYes\n$cakeNo\n$presentsYes\n$presentsNo\n$clownsYes\n$clownsNo");
			$balloonNoPercent = round((($balloonNo/($balloonYes + $balloonNo)) * 100), 2);
			$balloonYesPercent = round((($balloonYes/($balloonYes + $balloonNo)) * 100), 2);
			$cakeNoPercent = round((($cakeNo/($cakeYes + $cakeNo)) * 100), 2);
			$cakeYesPercent = round((($cakeYes/($cakeYes + $cakeNo)) * 100), 2);
			$presentsNoPercent = round((($presentsNo/($presentsYes + $presentsNo)) * 100), 2);
			$presentsYesPercent = round((($presentsYes/($presentsYes + $presentsNo)) * 100), 2);
			$clownsNoPercent = round((($clownsNo/($clownsYes + $clownsNo)) * 100), 2);
			$clownsYesPercent = round((($clownsYes/($clownsYes + $clownsNo)) * 100), 2);
			displayResults();
		}

		
		function displayResults(){
			global $balloonYes, $balloonNo, $balloonNoPercent, $balloonYesPercent,
			$cakeYes, $cakeNo, $cakeNoPercent, $cakeYesPercent,
			$presentsYes, $presentsNo, $presentsNoPercent, $presentsYesPercent,
			$clownsYes, $clownsNo, $clownsNoPercent, $clownsYesPercent;
			echo "<br>";			
			echo "<p>$balloonYesPercent% "." of people like balloons.</p>";
			echo "<p>$cakeYesPercent% of people like cake.</p>";
			echo "<p>$presentsYesPercent% of people like presents.</p>";
			echo "<p>$clownsYesPercent% of people like clowns.</p>";
			echo "<br>";
			
			if($_SESSION['balloon'] == 1) {
			echo "<p>You like balloons.</p>";
			}
			else{
				echo "<p>You don't like balloons.</p>";	
			}
			if($_SESSION['cake'] == 1) {
			echo "<p>You like cake.</p>";
			}
			else{
				echo "<p>You don't like cake.</p>";	
			}
			if($_SESSION['presents'] == 1) {
			echo "<p>You like presents.</p>";
			}
			else{
				echo "<p>You don't like presents.</p>";	
			}
			if($_SESSION['clowns'] == 1) {
			echo "<p>You like clowns.</p>";
			}
			else{
				echo "<p>You like clowns.</p>";	
			}
		}
		echo "<a href='index.html'>
			<h3>Home</h3>
		</a>";
?>
