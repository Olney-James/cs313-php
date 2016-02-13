<!--
Manages the Books tables.
 -->
<?php
function getBooks() {
	global $test;
	$query = '	SELECT * FROM Books
				ORDER BY book_id';
	$statement = $test->prepare($query);
	$statement->execute();
	$books = $statement->fetchAll();
	$statement->closeCursor();
	return $books;
}

function getBookByName($name) {
	global $test;
	$query = '	SELECT * FROM Books
				WHERE name = :name';
	$statement = $test->prepare($query);
	$statement->bindValue(":name", $name);
	$statement->execute();
	$book = $statement->fetch();
	$statement->closeCursor();
	return $book;
}

function insertBook($name) {
	global $test;
	$query = '	INSERT INTO Books (name)
				VALUES (:name)';
	$statement = $test->prepare($query);
	$statement->bindValue(":name", $name);
	$statement->execute();
	$result = $statement->rowCount();
	$statement->closeCursor();
	return $result;
}
?>