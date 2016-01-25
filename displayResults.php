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

	$balloonNoPercent = ($balloonNo/($balloonYes + $balloonNo)) * 100;
	$balloonYesPercent = ($balloonYes/($balloonYes + $balloonNo)) * 100;
	$cakeNoPercent = ($cakeNo/($cakeYes + $cakeNo)) * 100;
	$cakeYesPercent = ($cakeYes/($cakeYes + $cakeNo)) * 100;
	$presentsNoPercent = ($presentsNo/($presentsYes + $presentsNo)) * 100;
	$presentsYesPercent = ($presentsYes/($presentsYes + $presentsNo)) * 100;
	$clownsNoPercent = ($clownsNo/($clownsYes + $clownsNo)) * 100;
	$clownsYesPercent = ($clownsYes/($clownsYes + $clownsNo)) * 100;		

	echo "<p>$balloonYesPercent% "." of people like balloons</p>";
	echo "<p>$cakeYesPercent% of people like cake</p>";
	echo "<p>$presentsYesPercent% of people like presents</p>";
	echo "<p>$clownsYesPercent% of people like clowns</p>";
	echo "<p></p>";
	
	if(isset($_SESSION['balloon'])){
		if($_SESSION['balloon'] == 1) {
			echo "<p>You said you like balloons</p>";
		}
		else{
			echo "<p>You said you don't like balloons</p>";	
		}
		if($_SESSION['cake'] == 1) {
			echo "<p>You said you like cake</p>";
		}
		else{
			echo "<p>You said you don't like cake</p>";	
		}
		if($_SESSION['presents'] == 1) {
			echo "<p>You said you like presents</p>";
		}
		else{
			echo "<p>You said you don't like presents</p>";	
		}
		if($_SESSION['clowns'] == 1) {
			echo "<p>You said you like clowns</p>";
		}
		else{
			echo "<p>You said you don't like clowns</p>";	
		}
	}
	echo "<a href='PhpSurvey.html'>
			<h3>Return to Vote</h3>
		</a>";
	echo "<a href='index.html'>
			<h3>Home</h3>
		</a>";
?>