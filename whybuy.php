<?php
	session_start();
	//success msg or failure
	if(isset($_SESSION['cart_msg'])){
        $message = $_SESSION['cart_msg'];
        echo "<script type='text/javascript'>alert('$message');</script>";
		unset($_SESSION['cart_msg']);
	}
	
	
	if(isset($_SESSION['user'])) {
		$user=$_SESSION['user'];
		if(isset($_SESSION['loginsuccess'])) {
			$message=$_SESSION['loginsuccess'];
			echo "<script type='text/javascript'>alert('$message');</script>";
			unset($_SESSION['loginsuccess']);
		}
	}
	else{
		header("Location: login.php");
	}

	require_once("databaseconnection.php");
	
	function viewitems() {
		global $test;
		$query = 'SELECT * FROM item
		ORDER BY item_name ASC';
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
		ORDER BY item_name ASC';
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
		ORDER BY item_name ASC';
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
		ORDER BY item_name ASC';
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
		ORDER BY item_name ASC';
		$statement = $test->prepare($query);
		$statement->execute();
		$users = $statement->fetchAll();
		$statement->closeCursor();
		return $users;
	}

	$users = viewusers();

    function viewitemsbyuser(){
        global $test;
        $query = "SELECT * FROM item
        INNER JOIN shopping_cart
        ON item.item_id = shopping_cart.item_id
        INNER JOIN user_name
        ON shopping_cart.user_id = user_name.user_id
		WHERE user_name.user_name = '".$_SESSION['user']."'
		ORDER BY item_name ASC";
        $statement = $test->prepare($query);
        $statement->execute();
        $wishes = $statement->fetchAll();
        $statement->closeCursor();
        return $wishes;
    }

$wishes = viewitemsbyuser();

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
				background-color: #FFF8DC;
			}

			h1 {
				color: red;
				text-align: center;
				font-family: "Magneto";
				font-size: 50;
			}
			
			h3 {
				text-align: center;
			}
			
			p {
				text-align: left;
				foreground: red;
			}

			div.user {
				position: absolute;
				right: 100px;
				top: 10px;
				width: 300px;
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
				background-color: #FFF8DC;
			}
			table#t01 tr:nth-child(odd) {
			   background-color:	#FFFFF0;
			}
			table#t01 th	{
				background-color: red;
				color: white;
			}
			a.whybuy:hover{
				text-decoration: none;
			}
		   strong{
			   foreground-color:red;
		   }
		</style>
		
      <TITLE>
         WhyBuy
      </TITLE>
   </HEAD>
<BODY>

	<a class="whybuy" href="whybuy.php"><H1>WhyBuy</H1></a>
	   <!-- below here is the tabs -->
	   <div class="container">
		  <h2>Items</h2>
		  <ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#home">All</a></li>
			<li><a data-toggle="tab" href="#menu1">Books</a></li>
			<li><a data-toggle="tab" href="#menu2">Games</a></li>
			<li><a data-toggle="tab" href="#menu3">Gadgets</a></li>
              <li><a data-toggle="tab" href="#menu4"><span class="glyphicon glyphicon-shopping-cart"></span> Wish List</a></li>
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
							<th> + </th>
						  </tr>
						<?php foreach ($items as $item): ?>
							<!--<?php //$_SESSION['item'] = $item["item_id"]; ?>-->
							<tr>
								<td><strong><?php echo $item["item_name"]; ?></strong><a href="comment.php?item=<?php echo $item["item_id"]; ?>"> Read/Write review...</a></td>
								<td>$<?php echo $item["price"]; ?></td>
								<td><?php echo $item["genre"]; ?></td>
								<td><?php echo $item["image_link"]; ?></td>
								<td><a href="addToCart.php?item=<?php echo $item["item_id"]; ?>"><span class="glyphicon glyphicon-shopping-cart"></span></a></td>
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
							<th> + </th>
						  </tr>
						<?php foreach ($books as $book): ?>
							<tr>
								<td><strong><?php echo $book["item_name"]; ?></strong><a href="comment.php?item=<?php echo $book["item_id"]; ?>"> Read/Write review...</a></td>
								<td>$<?php echo $book["price"]; ?></td>
								<td><?php echo $book["genre"]; ?></td>
								<td><?php echo $book["image_link"]; ?></td>
								<td><a href="addToCart.php?item=<?php echo $book["item_id"]; ?>"><span class="glyphicon glyphicon-shopping-cart"></span></a></td>
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
							<th> + </th>
						  </tr>
						<?php foreach ($games as $game): ?>
							<tr>
								<td><strong><?php echo $game["item_name"]; ?></strong><a href="comment.php?item=<?php echo $game["item_id"]; ?>"> Read/Write review...</a></td>
								<td>$<?php echo $game["price"]; ?></td>
								<td><?php echo $game["genre"]; ?></td>
								<td><?php echo $game["image_link"]; ?></td>
								<td><a href="addToCart.php?item=<?php echo $game["item_id"]; ?>"><span class="glyphicon glyphicon-shopping-cart"></span></a></td>
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
							<th> + </th>
						  </tr>
						<?php foreach ($gadgets as $gadget): ?>
							<tr>
								<td><strong><?php echo $gadget["item_name"]; ?></strong><a href="comment.php?item=<?php echo $gadget["item_id"]; ?>"> Read/Write review...</a></td>
								<td>$<?php echo $gadget["price"]; ?></td>
								<td><?php echo $gadget["genre"]; ?></td>
								<td><?php echo $gadget["image_link"]; ?></td>
								<td><a href="addToCart.php?item=<?php echo $gadget["item_id"]; ?>"><span class="glyphicon glyphicon-shopping-cart"></span></a></td>
							</tr>
						<?php endforeach; ?>
					</table>
			</div>
              <div id="menu4" class="tab-pane fade">
                  <h3>Wish List</h3>
                  <table id="t01">
                      <tr>
                          <th>Item</th>
                          <th>Price</th>
                          <th>Genre</th>
                          <th>Image</th>
                      </tr>
                      <?php foreach ($wishes as $wish): ?>
                          <tr>
                              <td><strong><?php echo $wish["item_name"]; ?></strong><a href="comment.php?item=<?php echo $wish["item_id"]; ?>"> Read/Write review...</a></td>
                              <td>$<?php echo $wish["price"]; ?></td>
                              <td><?php echo $wish["genre"]; ?></td>
                              <td><?php echo $wish["image_link"]; ?></td>
                          </tr>
                      <?php endforeach; ?>
                  </table>
              </div>
		  </div>
		</div>
	   <!-- above here is the tabs setup -->

	<a href="index.html">
		<h3><span class="glyphicon glyphicon-home"></span> Home</h3>
	</a>

		<div class="user">
			<p><i class="glyphicon glyphicon-user"></i><strong>  Account: <?php echo $_SESSION['user']; ?>  </strong>

			<a href="login.php">
				<strong>Logout</strong>
			</a></p>
		</div>


</BODY>
</ARTICLE>
