<?php
	function test() {
		$server  = getenv('OPENSHIFT_MYSQL_DB_HOST');
		$database = 'retail_site';
		$username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
		$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
		$dsn = 'mysql:host='.$server.';dbname='.$database;

		try{
			$g1db = new PDO($dsn, $username, $password);
			//echo "database connected";
			return $g1db;
		}
		catch (PDOException $ex){
			echo 'Error!:' . $ex->getMessage();
			die();
		} 	
	}	
	$test = test();
	
	function selectUsers($user){
		global $test;
		$query = 'SELECT user_name FROM user_name
			WHERE user_name='.$user;
		$statement = $test->prepare($query);
		$statement->execute();
		$user_name = $statement->fetch();
		$statement->closeCursor();
		echo $user_name;
		return $user_name;
	}

	function userExists($username){
		$isUser = selectUsers($username);
		
		if ($isUser == NULL) {
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	function verifyPassword() {
		
	}
	session_start();
	$password=filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
	$user=filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
	$username = userExists($user);
	//echo $user;
	$user_name = selectUsers($user);
	foreach($user_name as $u){
		echo $u['user_name'];
	}
	if(userExists($user) == TRUE){
		echo "user exists";
		//if(verifyPassword() == TRUE){
			//$user_level=
			//$_SESSION['user']=$user;

			//$_SESSION['password']=$password;
			//$_SESSION['user_level']=$user_level;
		//}
		//else{
		//	echo "invalid password";
		//}
	}
	else{
		echo "user does not exist";
	}
	

?>