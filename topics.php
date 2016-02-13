<!--
Manages the Topics tables.
 -->
<?php
function getTopics() {
	global $test;
	$query = '	SELECT * FROM Topics';
	$statement = $test->prepare($query);
	$statement->execute();
	$topics = $statement->fetchAll();
	$statement->closeCursor();
	return $topics;
}

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

function getTopicsByScripture($scripture_id) {
	global $test;
	$query = '	SELECT Topics.* FROM Topics
				INNER JOIN Scriptures_Topics st
				ON st.topic_id = Topics.topic_id
				WHERE st.scripture_id = :scripture_id';
	$statement = $test->prepare($query);
	$statement->bindValue(":scripture_id", $scripture_id);
	$statement->execute();
	$topics = $statement->fetchAll();
	$statement->closeCursor();
	return $topics;
}

function insertTopic($name) {
	global $test;
	$query = '	INSERT INTO Topics (name)
				VALUES (:name)';
	$statement = $test->prepare($query);
	$statement->bindValue(":name", $name);
	$statement->execute();
	$result = $statement->rowCount();
	$statement->closeCursor();
	return $result;
}
?>