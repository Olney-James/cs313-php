<?php
	function test() {
		
		$server  = getenv('OPENSHIFT_MYSQL_DB_HOST');
		$database = 'scriptures';
		$username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
		$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
		$dsn = 'mysql:host='.$server.';dbname='.$database;

		try{
			$g1db = new PDO($dsn, $username, $password);
			//echo "database connected";
			return $g1db;
		}
		catch (PDOException $ex){
			echo 'Error!:' . $ex->getMessage();
			die();
		} 		
	}	
	$test = test();

	function viewScriptures() {
		global $test;
		$query = 'SELECT DISTINCT scriptures.scripture_id, scriptures.chapter, scriptures.verse, scriptures.content, books.name
		FROM scriptures
		INNER JOIN books
		ON scriptures.book_id = books.book_id
		ORDER BY books.name';
		$statement = $test->prepare($query);
		$statement->execute();
		$scriptures = $statement->fetchAll();
		$statement->closeCursor();
		return $scriptures;
	}
	
	function viewScripturesByTopic($topic) {
		global $test;
		$query = 'SELECT books.name, scriptures.chapter, scriptures.verse, scriptures.content, topics.topic_name
			FROM scriptures
			INNER JOIN link ON scriptures.scripture_id = link.scripture_id
			INNER JOIN books ON scriptures.book_id = books.book_id
			INNER JOIN topics ON link.topic_id = topics.topic_id
			WHERE link.topic_id =' . $topic;
		$statement = $test->prepare($query);
		$statement->execute();
		$scriptures = $statement->fetchAll();
		$statement->closeCursor();
		return $scriptures;
	}

	
	function findTopicByScripture($scripture){
		global $test;
		$query = 'SELECT link.topic_id, topics.topic_name FROM link
		INNER JOIN topics
		ON link.topic_id = topics.topic_id
		WHERE link.scripture_id ='. $scripture;
		$statement = $test->prepare($query);
		$statement->execute();
		$topics = $statement->fetchAll();
		$statement->closeCursor();
		return $topics;
	}
	function insertScripture($scripture, $topics) {
		global $test;
		$book=filter_input(INPUT_POST, "book", FILTER_SANITIZE_STRING);
		$chapter=filter_input(INPUT_POST, "chapter", FILTER_SANITIZE_STRING);
		$verse=filter_input(INPUT_POST, "verse", FILTER_SANITIZE_NUMBER_INT);
		$content=filter_input(INPUT_POST, "content", FILTER_SANITIZE_STRING);
		$topics=filter_input(INPUT_POST, "topic", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);/*array*/
		
	//	echo " ".$book." ".$chapter." ".$verse." ".$content;
	//	foreach ($topics as $topic){
	//		echo $topic['topic_id'];
	//		echo $topic['token_name'];
	//	}
		// Begin a new Transaction -->
		$test->beginTransaction();
		
		
		// First insert the scripture -->
		$query = '	INSERT INTO scriptures
							(book_id, chapter, verse, content)
						VALUES
							(:book_id, :chapter, :verse, :content)';
		$statement = $test->prepare($query);
		$statement->bindValue(":book_id", $book);
		$statement->bindValue(":chapter", $chapter);
		$statement->bindValue(":verse", $verse);
		$statement->bindValue(":content", $content);
		$statement->execute();
		$statement->closeCursor();

		// Store the ID of the recently inserted scripture -->
		$scripture_id = $test->lastInsertId();

		// Fill in the link table with $topics -->
		$count = 0;
		foreach ($topics as $topic) {
			$query = '	INSERT INTO link
								(scripture_id, topic_id)
							VALUES
								(:scripture_id, :topic_id)';
			$statement = $test->prepare($query);
			$statement->bindValue(":scripture_id", $scripture_id);
			$statement->bindValue(":topic_id", $topic["topic_id"]);
			$statement->execute();
			$statement->closeCursor();
	}

	// End and send the Transaction to the database -->
	$test->commit();
	echo "scripture has been posted";
}
insertScripture();
 
?>
<article>
	<HEAD>
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
				background-color: #FFF8DC;
			}
			table#t01 tr:nth-child(odd) {
			   background-color:	#FFFFF0;
			}
			table#t01 th	{
				background-color: red;
				color: white;
			}
		</style>
		<TITLE>
			Scripture Sent
		</TITLE>
	</HEAD>
	<BODY>
	<!-- below here is the tabs set up -->
		<div class="container">
		  <h2>Scriptures</h2>
		  <ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#home">All</a></li>
			<li><a data-toggle="tab" href="#menu1">Charity</a></li>
			<li><a data-toggle="tab" href="#menu2">Faith</a></li>
			<li><a data-toggle="tab" href="#menu3">Sacrifice</a></li>
		  </ul>

		  <div class="tab-content">
			<div id="home" class="tab-pane fade in active">
			  <h3>All Scriptures</h3>
				  <table id="t01">
						<tr>
							<th>Book</th>
							<th>Ch:Vs</th>
							<th>Content</th>
							<th>Topics</th>
						  </tr>
						<?php 	$scriptures=viewScriptures(); 
								foreach ($scriptures as $scripture): 
						?>
							<tr>
								
								<td><?php echo $scripture["name"]; ?></td>
								<td><?php echo $scripture["chapter"]; ?>:<?php echo $scripture["verse"]; ?></td>
								<td><?php echo $scripture["content"]; ?></td>	
								<td><?php 
										$scripture_temp = $scripture['scripture_id'];
										$topics=findTopicByScripture($scripture_temp);
										foreach($topics as $topic){
											echo $topic["topic_name"] . " "; 
										}
									?></td>
						<?php endforeach; ?>
								
							</tr>
					</table>
			</div>
			<div id="menu1" class="tab-pane fade">
			  <h3>Charity</h3>
				  <table id="t01">
						<tr>
							<th>Book</th>
							<th>Ch:Vs</th>
							<th>Content</th>
							<th>Topics</th>
						  </tr>
						<?php 	$scriptures=viewScripturesByTopic("3"); 
								foreach ($scriptures as $scripture): 
						?>
							<tr>
								
								<td><?php echo $scripture["name"]; ?></td>
								<td><?php echo $scripture["chapter"]; ?>:<?php echo $scripture["verse"]; ?></td>
								<td><?php echo $scripture["content"]; ?></td>	
								<td><?php 
										$scripture_temp = $scripture['scripture_id'];
										$topics=findTopicByScripture($scripture_temp);
										foreach($topics as $topic){
											echo $topic["topic_name"] . " "; 
										}
									?></td>
						<?php endforeach; ?>
								
							</tr>
					</table>
			</div>
			<div id="menu2" class="tab-pane fade">
				<h3>Faith</h3>
			</div>
			<div id="menu3" class="tab-pane fade">
			  <h3>Sacrifice</h3>
			  
			</div>
		  </div>
		</div>
	<!-- above here is the tabs set up -->
		<center>
			<a href="search_scripture.php"><h3>View Scriptures</h3></a>
			<a href="scriptureInsert.php"><h3>Add a scripture</h3></a>
			<a href="index.html"><h3>Home</h3></a>
		</center>
	</BODY>
</article>