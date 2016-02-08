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
	
	function viewusers() {
	global $test;
	$query = 'SELECT * FROM user_name
	ORDER BY user_id';
	$statement = $test->prepare($query);
	$statement->execute();
	$users = $statement->fetchAll();
	$statement->closeCursor();
	return $users;
}

$users = viewusers();
	
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
				border: 1px solid red;
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
				background-color: red;
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
		<tr>
			<th>Item</th>
			<th>Price</th>		
			<th>Genre</th>
		  </tr>
		<?php foreach ($items as $item): ?>
			<tr>
				<td><?php echo $item["item_name"]; ?></td>
				<td>$<?php echo $item["price"]; ?></td>
				<td><?php echo $item["genre"]; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>	
		
	<div class='user'>

		print("user: ");
		print("\r\n");
		print("email: ");
	
	</div>
	
   <a href="index.html">
		<h3>Home</h3>
	</a>
</BODY>
</ARTICLE>
