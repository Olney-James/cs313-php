CREATE DATABASE scriptures;
USE scriptures;
CREATE TABLE Books (
	book_id TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(25) NOT NULL,
	PRIMARY KEY (book_id)
) ENGINE = INNODB;

CREATE TABLE Scriptures (
	scripture_id TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
	book_id TINYINT(3) UNSIGNED NOT NULL,
	chapter TINYINT(3) UNSIGNED NOT NULL,
	verse TINYINT(3) UNSIGNED NOT NULL,
	content TEXT NOT NULL,
	PRIMARY KEY (scripture_id),
	FOREIGN KEY (book_id) REFERENCES Books (book_id)
) ENGINE = INNODB;

INSERT INTO Books(name) VALUES('John');
INSERT INTO Books(name) VALUES('Doctrine and Covenants');
INSERT INTO Books(name) VALUES('Mosiah');
INSERT INTO Scriptures(book_id, chapter, verse, content) VALUES(1, 1, 5, "And the light shineth in darkness; and the darkness comprehendeth it not.");
INSERT INTO Scriptures(book_id, chapter, verse, content) VALUES(2, 88, 49, "The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when ye shall comprehend even God, being quickened in him and by him.");
INSERT INTO Scriptures(book_id, chapter, verse, content) VALUES(2, 93, 28, "He that keepeth his commandments receiveth truth and light, until he is glorified in truth and knoweth all things.");
INSERT INTO Scriptures(book_id, chapter, verse, content) VALUES(3, 16, 9, "He is the light and life of the world; yea, a light that is endless, that can never be darkened; yea, and also a light which is endless, that there can be no more death.");