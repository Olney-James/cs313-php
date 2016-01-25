<?php
	$name     = filter_input(INPUT_POST, 'name',     FILTER_SANITIZE_STRING);
	$email    = filter_input(INPUT_POST, 'email',    FILTER_VALIDATE_EMAIL );
	$major    = filter_input(INPUT_POST, 'major',    FILTER_SANITIZE_STRING);
	$visited  = filter_input(INPUT_POST, 'visited',  FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
	$comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);

	$name=$_REQUEST['name'];
	$email=$_REQUEST['email'];
	$major=$_REQUEST['major'];
	$comments=$_REQUEST['comments'];
	echo "<h1>Greetings, $name </h1>";

	echo "<p>Name: $name</p>";
	echo "<a href='mailto:$email?Subject=HandleForm' target='_top'>$email</a>";
	echo "<p>Major: $major</p>";

	if(!empty($_POST['visited']))
	{
		foreach($_POST['visited'] as $place)
		{
			echo "You have visited " . $place . '<br/>';
		}
	}
	else
		echo 'You have not visited any where!';

	echo "<br/><br/>" . 'Your Comments: ' . $comments;

?>