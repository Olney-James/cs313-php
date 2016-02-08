<?php
	function test() {
	
	$server  = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$database = 'retail_site';
	$username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	$dsn = 'mysql:host='.$server.';dbname='.$database;

	try{
		$g1db = new PDO($dsn, $username, $password);
		echo 'db has connected';
		return $g1db;
		
	}
	catch (PDOException $ex){
		echo 'Error!:' . $ex->getMessage();
		die();
	} 
		
	}
		
	$test = test();
	
	function viewitems() {
	global $test;
	$query = 'SELECT * FROM item
	ORDER BY item_id';
	$statement = $test->prepare($query);
	$statement->execute();
	$items = $statement->fetchAll();
	$statement->closeCursor();
	return $items;
}

$items = viewitems();
	
	/*function getItemName(int $item_id) {
	global $test;
	$query = 'SELECT item_name
	FROM item
	WHERE item_id = $item_id';
	$statement = $test->prepare($query);
	$statement->execute();
	$itemName = $statement->fetchAll();
	$statement->closeCursor();
	return $itemName;
	}

	function getPrice(int $item_id) {
		global $test;
		$query = 'SELECT price
		FROM item
		WHERE item_id = $item_id';
		$statement = $test->prepare($query);
		$statement->execute();
		$price = $statement->fetchAll();
		$statement->closeCursor();
		return $price;
	}
	
	function getUrl(int $item_id) {
		global $test;
		$query = 'SELECT url
		FROM item
		WHERE item_id = $item_id';
		$statement = $test->prepare($query);
		$statement->execute();
		$url = $statement->fetchAll();
		$statement->closeCursor();
		return $url;
	}
	
	function getImage_link(int $item_id) {
		global $test;
		$query = 'SELECT image_link
		FROM item
		WHERE item_id = $item_id';
		$statement = $test->prepare($query);
		$statement->execute();
		$image_link = $statement->fetchAll();
		$statement->closeCursor();
		return $image_link;
	}
	
	function getGenre(int $item_id) {
		global $test;
		$query = 'SELECT genre
		FROM item
		WHERE item_id = $item_id';
		$statement = $test->prepare($query);
		$statement->execute();
		$genre = $statement->fetchAll();
		$statement->closeCursor();
		return $genre;
	}
	
	function writeItemsToArray(){
		$items =  array();
		for($x = 1; $item_id != NULL; $x++) {
		$items[$x] = (string)getItemName($x).(string)getPrice($x).(string)getUrl($x).(string)getImage_link($x).(string)getGenre($x);
		}
		return $items;
	}
	
	$items = writeItemsToArray();
	*/
?>
<ARTICLE>
   <HEAD>
	   <style>
			body {
				background-color: #d0e4fe;
			}

			h1 {
				color: red;
				text-align: center;
				font-family: "Magneto"
			}
			
			div.user {
				height: 80px;
				width: 160px;
				box-shadow: 5px 5px 5px black;
				float: right;
				position:relative;
			}
			
			<!--below style table detail-->
			table {
				width:100%;
			}
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
			}
			th, td {
				padding: 5px;
				text-align: left;
			}
			table#t01 tr:nth-child(even) {
				background-color: #eee;
			}
			table#t01 tr:nth-child(odd) {
			   background-color:#fff;
			}
			table#t01 th	{
				background-color: black;
				color: white;
			}
		</style>
		
      <TITLE>
         WhyBuy
      </TITLE>
   </HEAD>
<BODY>
   <H1>WhyBuy</H1>
	<table id="t01">
		<?php foreach ($items as $item): ?>
			<tr>
				<th><?php echo $item["item_name"]; ?></th>
				<th><?php echo $item["price"]; ?></th>
				<th><?php echo $item["genre"]; ?></th>
			</tr>
		<?php endforeach; ?>
	</table>	
		
<!--	<div class='user'>

			print("user: ");
			print("\r\n");
			print("email: ");
	
	</div> -->
	
   <a href="index.html">
		<h3>Home</h3>
	</a>
</BODY>
</ARTICLE>
