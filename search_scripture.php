<?php
function test() {
	$server  = 'localhost';
	$database = 'scriptures';
	$username = 'php';
	$password = 'php-pass';
	$dsn = 'localhost:8080'.$server.'scriptures'.$database;
	$options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);

	$g1db = new PDO('mysql:host=localhost:8080;dbname=scriptures', $username, $password);
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