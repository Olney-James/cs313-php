<!--
Manages the Scriptures tables.
 -->
<?php
function getScriptures() {
	global $test;
	$query = '	SELECT Scriptures.*, Books.name
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

function getScripturesByBook($book_id = "-1") {
	global $test;
	if ($book_id == "-1") {
		$scriptures = getScriptures();
	} else {
		$query = '	SELECT Scriptures.scripture_id, Scriptures.chapter, Scriptures.verse, Scriptures.content, Books.name
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

function insertScripture($scripture, $topics) {
	global $test;

	// Begin a new Transaction -->
	$test->beginTransaction();
	
	// First insert the scripture -->
	$query = '	INSERT INTO Scriptures
						(book_id, chapter, verse, content)
					VALUES
						(:book_id, :chapter, :verse, :content)';
	$statement = $test->prepare($query);
	$statement->bindValue(":book_id", $scripture["book_id"]);
	$statement->bindValue(":chapter", $scripture["chapter"]);
	$statement->bindValue(":verse", $scripture["verse"]);
	$statement->bindValue(":content", $scripture["content"]);
	$statement->execute();
	$statement->closeCursor();

	// Store the ID of the recently inserted scripture -->
	$scripture_id = $test->lastInsertId();

	// Fill in the link table with $topics -->
	$count = 0;
	foreach ($topics as $topic) {
		$query = '	INSERT INTO Scriptures_Topics
							(scripture_id, topic_id)
						VALUES
							(:scripture_id, :topic_id)';
		$statement = $test->prepare($query);
		$statement->bindValue(":scripture_id", $scripture_id);
		$statement->bindValue(":topic_id", $topic["topic_id"]);
		$statement->execute();
		$statement->closeCursor();
	}

	// End and send the Transaction to the database -->
	$test->commit();
}
?>