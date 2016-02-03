<?php
function test() {
	
	$server  = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
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

/* test stuff 
	$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
	$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br />\n";
	 test stuff */
	
$test = test();

function viewScriptures() {
	global $test;
	$query = 'SELECT Scriptures.chapter, Scriptures.verse, Scriptures.content, Books.name
	FROM Scriptures
	INNER JOIN Books
	ON Scriptures.book_id = Books.book_id
	ORDER BY Books.name';
	$statement = $test->prepare($query);
	$statement->execute();
	$scriptures = $statement->fetchAll();
	$statement->closeCursor();
	return $scriptures;
}

function viewScripturesByBook($book_id = "-1") {
	global $test;
	if ($book_id == "-1") {
		$scriptures = viewScriptures();
	} else {
		$query = 'SELECT Scriptures.chapter, Scriptures.verse, Scriptures.content, Books.name
		FROM Scriptures
		INNER JOIN Books
		ON Scriptures.book_id = Books.book_id
		WHERE Scriptures.book_id = :book_id
		ORDER BY Books.name';
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
			</li>
		<?php endforeach; ?>
	</ul>
</article>
