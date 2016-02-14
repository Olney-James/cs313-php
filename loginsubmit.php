<?php 
	function selectUsers($user){
		global $test;
		$query = 'SELECT * FROM user_name
			WHERE user_name = '. $user;
		$statement = $test->prepare($query);
		$statement->execute();
		$user_name = $statement->fetchAll();
		$statement->closeCursor();
		return $user_name;
	}
	function userExists($user){
		$isUser = selectUsers($user); 
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
	if(userExists() == TRUE){
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