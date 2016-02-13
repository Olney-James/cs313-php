<article>
</article>
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
		exit();
	} 
	
}

$test = test();

function viewBooks() {
	global $test;
	$query = 'SELECT * FROM books
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
	<center>
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
		<a href="scriptureInsert.php"><h3>Add a scripture</h3></a>
		<a href="index.html"><h3>Home</h3></a>
	</center>
</article>
