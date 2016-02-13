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
		<style>
		</style>
		<TITLE>
			Scripture Sent
		</TITLE>
	</HEAD>
	<BODY>
		<center>
			<a href="search_scripture.php"><h3>View Scriptures</h3></a>
			<a href="scriptureInsert.php"><h3>Add a scripture</h3></a>
			<a href="index.html"><h3>Home</h3></a>
		</center>
	</BODY>
</article>