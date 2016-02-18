<?php
	session_start();
	require_once("databaseconnection.php");

	function selectUsers(){
		global $test;
		$user=filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
		$query = "SELECT user_name FROM user_name
			WHERE user_name='$user'";
		$statement = $test->prepare($query);
		$statement->execute();
		if ($statement->rowCount()) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	$user_name=selectUsers();

	function selectPassword() {
		global $test;
		$user=filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
		$password=filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
		$query = "SELECT user_name FROM user_name
			WHERE user_name='$user'
			AND password=AES_ENCRYPT('$password', 'test')";
		$statement = $test->prepare($query);
		$statement->execute();
		if ($statement->rowCount()) {
			return TRUE;
			echo "password is correct";
		}
		else{
			return FALSE;
			echo "password is incorrect";
		}
	}
	$password = selectPassword();

	if($user_name == TRUE){
		echo "user exists";
		if($password == TRUE){
			$user=filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
			$_SESSION['user']=$user;
			$location = "Location: whybuy.php";
			$_SESSION['loginsuccess']="Welcome $user!";
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

	header($location);
?>