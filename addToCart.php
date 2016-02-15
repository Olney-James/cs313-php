<?php 
	function test() {
		$server  = getenv('OPENSHIFT_MYSQL_DB_HOST');
		$database = 'retail_site';
		$username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
		$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
		$dsn = 'mysql:host='.$server.';dbname='.$database;

		try{
			$g1db = new PDO($dsn, $username, $password);
			return $g1db;
			
		}
		catch (PDOException $ex){
			echo 'Error!:' . $ex->getMessage();
			die();
		} 
		
	}
		
	$test = test();
/*below are shopping-cart functions */
	function addToCart($item_id) {
		global $test;
		$user_id=getUserIdByUserName($_SESSION['user']);
		$query = 'INSERT into shopping-cart(quantity, item_id, user_id) VALUES(1,'. $item_id .','. $user_id .')';
		$statement = $test->prepare($query);
		$statement->execute();
		$statement->closeCursor();	
	}
	
	function getUserIdByUserName($username){
		global $test;
		$query = 'SELECT user_id FROM user_name WHERE user_name = '. $username;
		$statement = $test->prepare($query);
		$statement->execute();
		$user = $statement->fetch();
		$statement-closeCursor();
		return $user;
	}
	/*above are shopping-cart functions */
	addToCart($_SESSION['item']);
	echo $_SESSION['item'];
?>