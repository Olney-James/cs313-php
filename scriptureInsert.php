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
	
	function viewtopics() {
		global $test;
		$query = 'SELECT * FROM topics
		ORDER BY topic_name ASC';
		$statement = $test->prepare($query);
		$statement->execute();
		$topics = $statement->fetchAll();
		$statement->closeCursor();
		return $topics;
	}
	$topics = viewtopics();
	
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
	<HEAD>
		<style>
		</style>
		<TITLE>
			Scripture Insert
		</TITLE>
	</HEAD>
	<BODY>
		<H1>Scripture Insert</H1>
		<form action="sendscripture.php" method="post">
			Book:
			<input type="text" name="book" size="50" maxlength="100">
			Chapter: 
			<input type="text" name="chapter" size="1" maxlength="3">
			Verse: 
			<input type="text" name="verse" size="1" maxlength="3"><br>
			Content:<br>
			<textarea name='content' rows="4" cols="100" ></textarea>
			<br>
			<label>Select Topic</label></br>

				<?php foreach ($topics as $topic): ?>
					<input type="checkbox" name="topic[]" value="<?php echo $topic["topic_id"]; ?>"><?php echo $topic["topic_name"]; ?><br>
				<?php endforeach; ?>
			<input type="submit" value="Send" class="btn btn-default">
		</form>
	</BODY>
</article>