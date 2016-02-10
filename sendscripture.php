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
	/*trying Silvere's stuff*/
	function getTopicByName($name) {
	global $test;
	$query = '	SELECT * FROM Topics
				WHERE name = :name';
	$statement = $test->prepare($query);
	$statement->bindValue(":name", $name);
	$statement->execute();
	$topic = $statement->fetch();
	$statement->closeCursor();
	return $topic;
}
	
	foreach ($topics as $topic_name) {
			$topic = getTopicByName($topic_name);
			while ($topic === NULL) {
				$result = insertTopic($book);
				if ($result != 1) {
					$topic = getTopicByName($book);
				}
			}
			$topics[] = $topic;
		}
	
	
	
	
	/* my stuff 	*/
	foreach ($topics as $topic){
		echo $topic . " ";
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