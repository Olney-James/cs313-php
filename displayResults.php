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
	echo "<br>";
	echo "<p>$balloonYesPercent% "." of people like balloons.</p>";
	echo "<p>$cakeYesPercent% of people like cake.</p>";
	echo "<p>$presentsYesPercent% of people like presents.</p>";
	echo "<p>$clownsYesPercent% of people like clowns.</p>";
	echo "<br>";
	
	if(isset($_SESSION['balloon'])){
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
			echo "<p>You don't like clowns.</p>";	
		}
	}
	echo "<a href='PhpSurvey.html'>
			<h3>Return to Vote</h3>
		</a>";
	echo "<a href='index.html'>
			<h3>Home</h3>
		</a>";
?>