<?php
	session_start();
	require_once("databaseconnection.php");


	function userExists(){
		$isUser = selectUsers();
		
		if (isset($isUser)) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	

	function selectUsers(){
			global $test;
			$user=filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
			$password=filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
			//echo $user;
			//$test->beginTransaction();
			$query = "SELECT user_name FROM user_name
				WHERE user_name='$user'";
			$statement = $test->prepare($query);
			$statement->execute();
			$user_name = $statement->fetchAll();
			$statement->closeCursor();
			return $user_name;
		}
		$user_name=selectUsers();
		//print_r($user_name);

	//$username = userExists($user);
	//echo $user;
	//$user_name = selectUsers($user);
	//echo $user_name;
	//foreach($user_name as $u){
	//	echo $u['user_name'];
	//}
	if(userExists() == TRUE){
		echo "user exists";


		if(verifyPassword() == TRUE){
			$_SESSION['user']=$user;
			$location = "Location: whybuy.php";
			//$_SESSION['password']=$password;
			//$_SESSION['user_level']=$user_level;
			echo "password is correct";
		}
		else{
			$_SESSION["login_msg"] = "invalid password";
			$location = "Location: login.php";
			echo "password is invalid";
		}
	}
	else{
		$_SESSION["login_msg"] = "user does not exist";
		$location = "Location: login.php";
	}
	
		function selectPassword() {
			global $test;
			$user=filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
			$password=filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
			//echo $user;
			//$test->beginTransaction();
			$query = "SELECT user_name FROM user_name
				WHERE user_name='$user'
				AND password=AES_ENCRYPT('$password', 'test')";
			$statement = $test->prepare($query);
			$statement->execute();
			$user_name = $statement->fetchAll();
			$statement->closeCursor();
			return $user_name;
	}


		function verifyPassword(){
			$user=filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
			$password=filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
			echo $user.$password;
			$password = selectPassword();

			if ($password)) {
				return TRUE;
				echo "password is correct";
			}
			else{
				return FALSE;
				echo "password is incorrect";
			}
		}
	//header($location);
?>