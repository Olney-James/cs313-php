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

	function viewbooks() {
		global $test;
		$query = 'SELECT * FROM item
		WHERE genre = "BOOK"
		ORDER BY item_id';
		$statement = $test->prepare($query);
		$statement->execute();
		$books = $statement->fetchAll();
		$statement->closeCursor();
		return $books;
	}

	$books = viewbooks();
	
	function viewgames() {
		global $test;
		$query = 'SELECT * FROM item
		WHERE genre = "GAME"
		ORDER BY item_id';
		$statement = $test->prepare($query);
		$statement->execute();
		$games = $statement->fetchAll();
		$statement->closeCursor();
		return $games;
	}

	$games = viewgames();
	
	function viewgadgets() {
		global $test;
		$query = 'SELECT * FROM item
		WHERE genre = "GADGET"
		ORDER BY item_id';
		$statement = $test->prepare($query);
		$statement->execute();
		$gadgets = $statement->fetchAll();
		$statement->closeCursor();
		return $gadgets;
	}

	$gadgets = viewgadgets();
	
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
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	   <style>
			body {
				background-color: #d0e4fe;
			}

			h1 {
				color: red;
				text-align: center;
				font-family: "Magneto"
			}
			
			h3 {
				text-align: center;
			}
			
			p {
				text-align: center;
			}
			
			div.user {
				height: 80px;
				width: 160px;
				box-shadow: 5px 5px 5px black;
				float: right;
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
	   <!-- below here is the tabs -->
	   <div class="container">
		  <h2>Items</h2>
		  <ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#home">All</a></li>
			<li><a data-toggle="tab" href="#menu1">Books</a></li>
			<li><a data-toggle="tab" href="#menu2">Games</a></li>
			<li><a data-toggle="tab" href="#menu3">Gadgets</a></li>
		  </ul>

		  <div class="tab-content">
			<div id="home" class="tab-pane fade in active">
			  <h3>All Items</h3>
				  <table id="t01">
						<tr>
							<th>Item</th>
							<th>Price</th>		
							<th>Genre</th>
							<th>Image</th>
						  </tr>
						<?php foreach ($items as $item): ?>
							<tr>
								<td><?php echo $item["item_name"]; ?></td>
								<td>$<?php echo $item["price"]; ?></td>
								<td><?php echo $item["genre"]; ?></td>
								<td><?php echo $item["image_link"]; ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
			</div>
			<div id="menu1" class="tab-pane fade">
			  <h3>Books</h3>
			  <table id="t01">
						<tr>
							<th>Item</th>
							<th>Price</th>		
							<th>Genre</th>
							<th>Image</th>
						  </tr>
						<?php foreach ($books as $book): ?>
							<tr>
								<td><?php echo $book["item_name"]; ?></td>
								<td>$<?php echo $book["price"]; ?></td>
								<td><?php echo $book["genre"]; ?></td>
								<td><?php echo $book["image_link"]; ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
			</div>
			<div id="menu2" class="tab-pane fade">
				<h3>Games</h3>
				<table id="t01">
						<tr>
							<th>Item</th>
							<th>Price</th>		
							<th>Genre</th>
							<th>Image</th>
						  </tr>
						<?php foreach ($games as $game): ?>
							<tr>
								<td><?php echo $game["item_name"]; ?></td>
								<td>$<?php echo $game["price"]; ?></td>
								<td><?php echo $game["genre"]; ?></td>
								<td><?php echo $game["image_link"]; ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
			</div>
			<div id="menu3" class="tab-pane fade">
			  <h3>Gadgets</h3>
			  <table id="t01">
						<tr>
							<th>Item</th>
							<th>Price</th>		
							<th>Genre</th>
							<th>Image</th>
						  </tr>
						<?php foreach ($gadgets as $gadget): ?>
							<tr>
								<td><?php echo $gadget["item_name"]; ?></td>
								<td>$<?php echo $gadget["price"]; ?></td>
								<td><?php echo $gadget["genre"]; ?></td>
								<td><?php echo $gadget["image_link"]; ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
			</div>
		  </div>
		</div>
	   <!-- above here is the tabs setup -->
			
	
   <a href="index.html">
		<h3>Home</h3>
		<p>User:<?php echo $users[user_name][1]; ?></p>
	</a>
</BODY>
</ARTICLE>
