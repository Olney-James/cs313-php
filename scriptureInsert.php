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
	</BODY>
</article>