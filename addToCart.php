<?php 
	session_start();
	require_once("databaseconnection.php");
	//error_reporting(-1);
	function viewitemsbyuserbyitem(){
		global $test;
		$query = "SELECT item_name, price, genre, image_link, item.item_id FROM item
				INNER JOIN shopping_cart
				ON item.item_id = shopping_cart.item_id
				INNER JOIN user_name
				ON shopping_cart.user_id = user_name.user_id
				WHERE user_name.user_name = '".$_SESSION['user']."'
				AND shopping_cart.item_id =".$_GET['item'];
		$statement = $test->prepare($query);
		$statement->execute();
		$doubles = $statement->fetchAll();
		$statement->closeCursor();
		return $doubles;
	}
	$doubles = viewitemsbyuserbyitem();

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
	if (isset($doubles)) {
		$_SESSION['cart_msg'] = "this item is already in your wish list cart";
	}else{
		addToCart($_GET['item']);
	}
	header("Location: whybuy.php");
?>