DROP DATABASE IF EXISTS dontpad_db;
CREATE DATABASE dontpad_db;
USE dontpad_db;

CREATE TABLE notes(
    identifier_note VARCHAR(50) PRIMARY KEY UNIQUE NOT NULL,
	text_note TEXT NULL,
    created_datetime_note DATETIME DEFAULT (CURTIME()) NULL
);

DELIMITER !!
DROP PROCEDURE IF EXISTS spNote_GetById!!
CREATE PROCEDURE spNote_GetById(IN identifier VARCHAR(50))
BEGIN
	SELECT n.identifier_note, n.text_note FROM notes AS n WHERE n.identifier_note = identifier;
END!!

DROP PROCEDURE IF EXISTS spNote_InsertNote!!
CREATE PROCEDURE spNote_InsertNote(IN identifier VARCHAR(50))
BEGIN
	INSERT INTO notes VALUES (identifier, NULL, CURTIME());
END!!

DROP PROCEDURE IF EXISTS spNote_UpdateNote!!
CREATE PROCEDURE spNote_UpdateNote(IN identifier VARCHAR(50), IN textNote TEXT)
BEGIN
	UPDATE notes AS n SET n.text_note = textNote WHERE n.identifier_note = identifier;
END!!
DELIMITER ;

