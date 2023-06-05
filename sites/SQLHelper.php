<?php

class SQLHelper {

	private $db;

	function __construct() {
		$user = 'root';
		$pw = null;
		// SQLITE
		$dsn = 'sqlite:..\..\kompol.db';
		// MYSQL
		// $dsn = 'mysql:dbname=kompol;host=localhost';
		$this->db = new PDO($dsn, $user, $pw);
	}

	function createUserTable(){
		$this->createPartyTable();
		$sql = "CREATE TABLE IF NOT EXISTS User (
    		uuid VARCHAR(255) PRIMARY KEY,
    		email VARCHAR(255) UNIQUE,
    		password VARCHAR,
    		avatar VARCHAR,
    		firstName VARCHAR(255),
    		lastName VARCHAR(255),
    		party VARCHAR(255),
    		registrationCode VARCHAR(255),
    		FOREIGN KEY (party) REFERENCES Party(name)
		)";
		if ($this->db->exec($sql)) {
			echo "Usertabelle angelegt";
		} else {
			echo "Usertabelle nicht angelegt";
		}
	}

	function createPartyTable(){
		$sql = "CREATE TABLE IF NOT EXISTS Party (
    		name VARCHAR(255) PRIMARY KEY,
    		text VARCHAR,
    		textPreview VARCHAR,
    		logo VARCHAR
		)";
		if ($this->db->exec($sql)) {
			echo "Parteitabelle angelegt";
		} else {
			echo "Parteitabelle nicht angelegt";
		}
	}

	function createPostTable(){
		$this->createUserTable();
		$sql = "CREATE TABLE IF NOT EXISTS Post (
    		uuid VARCHAR(255) PRIMARY KEY,
    		title VARCHAR,
    		text VARCHAR,
    		date DATE DEFAULT CURRENT_DATE,
    		author VARCHAR,
    		category VARCHAR,
    		CONSTRAINT FK_User FOREIGN KEY (author) REFERENCES User(uuid)
		)";
		if ($this->db->exec($sql)) {
			echo "Posttabelle angelegt";
		} else {
			echo "Posttabelle nicht angelegt";
		}
		$this->createLikeTable();
		$this->createDislikeTable();
	}

	function createArticleTable(){
		$sql = "CREATE TABLE IF NOT EXISTS Article (
    		uuid VARCHAR(255),
    		title VARCHAR,
    		contentPreview VARCHAR,
    		content VARCHAR,
    		picturePath VARCHAR(255),
    		CONSTRAINT PK_Like PRIMARY KEY (uuid)
		)";
		if ($this->db->exec($sql)) {
			echo "Artikeltabelle angelegt";
		} else {
			echo "Artikeltabelle nicht angelegt";
		}
	}

	function createCommentTable(){
		// TODO: implement
	}

	private function createLikeTable(){
		$sql = "CREATE TABLE IF NOT EXISTS Like (
    		uuid VARCHAR(255),
    		user VARCHAR(255),
    		CONSTRAINT PK_Like PRIMARY KEY (uuid,user),
    		CONSTRAINT FK_LikePost FOREIGN KEY (uuid) REFERENCES Post(uuid),
    		CONSTRAINT PK_LikeUser FOREIGN KEY (user) REFERENCES User(uuid)
		)";
		if ($this->db->exec($sql)) {
			echo "Liketabelle angelegt";
		} else {
			echo "Liketabelle nicht angelegt";
		}
	}

	private function createDislikeTable(){
		$sql = "CREATE TABLE IF NOT EXISTS Dislike (
    		uuid VARCHAR(255),
    		user VARCHAR(255),
    		CONSTRAINT PK_Dislike PRIMARY KEY (uuid,user),
    		CONSTRAINT FK_LikePost FOREIGN KEY (uuid) REFERENCES Post(uuid),
    		CONSTRAINT PK_LikeUser FOREIGN KEY (user) REFERENCES User(uuid)
		)";
		if ($this->db->exec($sql)) {
			echo "Disliketabelle angelegt";
		} else {
			echo "Disliketabelle nicht angelegt";
		}
	}

	function createSupportTable() {
		$sql = "CREATE TABLE IF NOT EXISTS Support (
    		uuid VARCHAR(255) PRIMARY KEY,
    		firstName VARCHAR,
    		lastName VARCHAR,
    		email VARCHAR,
    		issue VARCHAR,
    		text VARCHAR
		)";
		if ($this->db->exec($sql)) {
			echo "Supporttabelle angelegt";
		} else {
			echo "Supporttabelle nicht angelegt";
		}
	}

	function closeConnection() {
		$this->db = null;
	}
}

