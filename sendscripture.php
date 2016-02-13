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
	
	function viewScriptures() {
	global $test;
	$query = 'SELECT scriptures.scripture_id, scriptures.chapter, scriptures.verse, scriptures.content, books.name
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
		<TITLE>
			Scripture Sent
		</TITLE>
	</HEAD>
	<BODY>
	<!-- below here is the tabs set up -->
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
			  <h3>All Scriptures</h3>
				  <table id="t01">
						<tr>
							<th>Book</th>
							<th>Chapter:Verse</th>
							<th>Content</th>
							<th>Topics</th>
						  </tr>
						<?php 	$scriptures=viewScriptures(); 
								foreach ($scriptures as $scripture): 
						?>
							<tr>
								
								<td><?php echo $scripture["book"]; ?></td>
								<td><?php echo $scripture["chapter"]; ?>:<?php echo $scripture["verse"]; ?></td>
								<td><?php echo $scripture["content"]; ?></td>							
						<?php endforeach; ?>
								<td><?php 
								$topics=findTopicByScripture($scripture["scripture_id"]);
								foreach($topics as $topic){
									echo $topic["topic_name"] . " "; 
								}
									?></td>
							</tr>
					</table>
			</div>
			<div id="menu1" class="tab-pane fade">
			  <h3>Charity</h3>
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