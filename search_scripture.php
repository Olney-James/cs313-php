<?php
function test() {
	$server  = 'localhost';
	$database = 'scriptures';
	$username = 'php';
	$password = 'php-pass';
	$dsn = 'mysql:host='.$server.';dbname='.$database.';port=8080';
	$options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);

	try{
		$g1db = new PDO($dsn, $username, $password);

	}
	catch (PDOException $ex){
		echo 'Error!:' . $ex->getMessage();
		die();
	}
	
	return $g1db;
}

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
