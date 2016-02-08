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
		<form action="ScripturesDB.php" method="post">
			<label>Select Topic</label>
			<select class="form-control" name="topic" >
				<?php foreach ($topics as $topic): ?>
					<option value="<?php echo $topic["topic_id"]; ?>"><?php echo $topic["topic_name"]; ?></option>
				<?php endforeach; ?>
			</select>
			<input type="submit" value="Send" class="btn btn-default">
		</form>
	</BODY>
</article>