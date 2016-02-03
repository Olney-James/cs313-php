<?php
function test() {
	$server  = '127.0.0.1';
	$database = 'scriptures';
	$username = 'php';
	$password = 'php-pass';
	$dsn = 'mysql:host='.$server.';dbname='.$database;
	$options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);

	try{
		$g1db = new PDO($dsn, $username, $password, options);

	}
	catch (PDOException $ex){
		echo 'Error!:' . $ex->getMessage();
		die();
	}
		
		return $g1db;
}

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
