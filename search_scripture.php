<?php
function test() {
	
	$server  = 'localhost:8080';
	$database = 'scriptures';
	$username = 'php';
	$password = 'php-pass';
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
/* test stuff */
	$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
	$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br />\n";
	/* test stuff */

$test = test();

function viewBooks() {
	global $test;
	$query = 'SELECT * FROM Books
	ORDER BY book_id';
	$statement = $test->prepare($query);
	$statement->execute();
	$books = $statement->fetchAll();
	$statement->closeCursor();
	return $books;
}

$books = viewBooks();
?>
<article>
	<h1>Search Scripture</h1>
	<form action="ScripturesDB.php" method="post">
		<label>Select Book</label>
		<select class="form-control" name="book" >
			<option value="all">All</option>
			<?php foreach ($books as $book): ?>
				<option value="<?php echo $book["book_id"]; ?>"><?php echo $book["name"]; ?></option>
			<?php endforeach; ?>
		</select>
		<input type="submit" value="Send" class="btn btn-default">
	</form>
</article>
