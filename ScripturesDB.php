<?php
function test() {
	
	$server  = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$database = 'scriptures';
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
	WHERE link.scripture_id = $scripture';
	$statement = $test->prepare($query);
	$statement->execute();
	$topics = $statement->fetchAll();
	$statement->closeCursor();
	return $topics;
}

function findTopicByTopic_id($topic_id){
	global $test;
	$query = 'SELECT topic_name FROM topics
	WHERE topic_id = $topic_id';
	$statement = $test->prepare($query);
	$statement->execute();
	$topics = $statement->fetchAll();
	$statement->closeCursor();
	return $topics;
}

function viewScripturesByBook($book_id = "-1") {
	global $test;
	if ($book_id == "-1") {
		$scriptures = viewScriptures();
	} else {
		$query = 'SELECT scriptures.scripture_id, scriptures.chapter, scriptures.verse, scriptures.content, books.name
		FROM scriptures
		INNER JOIN books
		ON scriptures.book_id = books.book_id
		WHERE scriptures.book_id = :book_id
		ORDER BY books.name';
		$statement = $test->prepare($query);
		$statement->bindValue(":book_id", $book_id);
		$statement->execute();
		$scriptures = $statement->fetchAll();
		$statement->closeCursor();
	}
	return $scriptures;
}

$book = filter_input(INPUT_POST, 'book');

if (!isset($book) || $book == "all"){
	$scriptures = viewScriptures();
} else {
	$scriptures = viewScripturesByBook($book);
}
?>
<article>
	<h1>Scripture Resources</h1>
	<ul>
		<?php foreach ($scriptures as $scripture): ?>
			<li>
				<strong>
					<?php echo $scripture['name']; ?>&nbsp;
					<?php echo $scripture['chapter']; ?>:
					<?php echo $scripture['verse']; ?>
				</strong>
				 - <?php echo $scripture['content']; ?>
				 <strong>
					<?php 
					echo $scripture['scripture_id'];
					$scripture_temp = $scripture['scripture_id'];
					$topics = findTopicByScripture($scripture_temp);
					print_r($topics);
					foreach($topics as $topic){
						echo $topic;
					} 
					?>
				 </strong>
			</li>
		<?php endforeach; ?>
	</ul>
</article>
<article>
	<BODY>
		<center>
			<a href="search_scripture.php"><h3>View Scriptures</h3></a>
			<a href="scriptureInsert.php"><h3>Add a scripture</h3></a>
			<a href="index.html"><h3>Home</h3></a>
		</center>
	</BODY>
</article>
