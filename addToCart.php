<?php 
	session_start();
	require_once("databaseconnection.php");
	//error_reporting(-1);

/*below are shopping-cart functions */
	function addToCart($item_id) {
		global $test;
		$user=getUserIdByUserName($_SESSION['user']);
		$query = "INSERT into shopping_cart(quantity, item_id, user_id) VALUES(1,".$item_id.",".$user['user_id'].")";
		$statement = $test->prepare($query);
		$statement->execute();
		if ($statement->rowCount()){
			$_SESSION['cart_msg'] = "item was successfully added";
		}
		else{
			$_SESSION['cart_msg'] = "Item wasn't added. See your database administrator";
		}
		$statement->closeCursor();	
	}
	
	function getUserIdByUserName($username){
		global $test;
		$query = "SELECT user_id FROM user_name WHERE user_name ='$username'";
		$statement = $test->prepare($query);
		$statement->execute();
		$user = $statement->fetch();
		$statement->closeCursor();
		return $user;
	}
	/*above are shopping-cart functions */
	addToCart($_GET['item']);
	
	header("Location: whybuy.php");
?>