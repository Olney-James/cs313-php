<?php
	function test() {
		
		$server  = getenv('OPENSHIFT_MYSQL_DB_HOST');
		$database = 'scriptures';
		$username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
		$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
		$dsn = 'mysql:host='.$server.';dbname='.$database;

		try{
			$g1db = new PDO($dsn, $username, $password);
			echo "database connected";
			return $g1db;
		}
		catch (PDOException $ex){
			echo 'Error!:' . $ex->getMessage();
			die();
		} 		
	}	
	$test = test();
	
	$book=filter_input(INPUT_POST, "book", FILTER_SANITIZE_STRING);
	$chapter=filter_input(INPUT_POST, "chapter", FILTER_SANITIZE_STRING);
	$verse=filter_input(INPUT_POST, "verse", FILTER_SANITIZE_STRING);
	$content=filter_input(INPUT_POST, "content", FILTER_SANITIZE_STRING);
	$topics=filter_input(INPUT_POST, "topic", FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);/*array*/
	
	echo " ".$book." ".$chapter." ".$verse." ".$content." ";
	/*trying Silvere's stuff
	
function viewTopicNames() {
	global $test;
	$query = 'SELECT name
	FROM topics;';
	$statement = $test->prepare($query);
	$statement->execute();
	$topic_names = $statement->fetchAll();
	$statement->closeCursor();
	return $topic_names;
}
 my stuff 	*/
	foreach ($topics as $topic_name){
		echo $topic[$topic_name];
	}

	/*
	function insertScripture(){
		$stmt = $pdo->prepare('INSERT INTO scriptures(book, chapter, verse,) VALUES(:book, :chapter, :verse)');
		$stmt->execute(array(':book' => $book, ':chapter' => $chapter, ':verse' => $verse ));
		$scripture_id = $pdo->lastInsertId();
		$stmt->closeCursor();
		return $scripture_id;
	}
	$scripture_id = insertScripture();
	
	function insertTopic() {
		foreach ($topics as $topic):
			$stmt = $pdo->prepare('INSERT INTO link(scripture_id, topic_id) VALUES(:scripture_id, :topicId)';
			$stmt->execute(array(':scripture_id' => $scripture_id, ':topicId' => $topic));
		end foreach;
	} */
?>