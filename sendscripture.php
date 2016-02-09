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
	
	$book_id='';
	$chapter='';
	$verse='';
	$content='';
	$topics='';/*array*/
	/*
	function insertScripture(){
		$stmt = $pdo->prepare('INSERT INTO scriptures(book_id, chapter, verse,) VALUES(:book_id, :chapter, :verse)');
		$stmt->execute(array(':book_id' => $book_id, ':chapter' => $chapter, ':verse' => $verse ));
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