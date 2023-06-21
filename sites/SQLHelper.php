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
		$this->createCommentTable();
	}

	function createUserTable(){
		$this->createPartyTable();
		$sql = "CREATE TABLE IF NOT EXISTS User (
    		uuid VARCHAR(255) PRIMARY KEY,
    		email VARCHAR(255) UNIQUE,
    		password VARCHAR,
    		avatar VARCHAR,
        username VARCHAR,
    		firstName VARCHAR(255),
    		lastName VARCHAR(255),
    		party VARCHAR(255),
    		registrationCode VARCHAR(255),
    		FOREIGN KEY (party) REFERENCES Party(name)
		)";
		if ($this->db->exec($sql)) {
			return true;
		} else {
			return false;
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
			return true;
		} else {
			return false;
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
		$result = $this->db->exec($sql);
		$this->createLikeTable();
		$this->createDislikeTable();
		return $result;
	}

	function createCommentTable(){
		$this->createPostTable();
		$sql = "CREATE TABLE IF NOT EXISTS Comment (
    		uuid VARCHAR(255) PRIMARY KEY,
    		answerTo VARCHAR,
    		text VARCHAR,
    		date DATE DEFAULT CURRENT_DATE,
    		author VARCHAR,
    		CONSTRAINT FK_User FOREIGN KEY (author) REFERENCES User(uuid)
		)";
		if ($this->db->exec($sql)) {
			return true;
		} else {
			return false;
		}
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
			return true;
		} else {
			return false;
		}
	}

	function createLikeTable(){
		$sql = "CREATE TABLE IF NOT EXISTS Like (
    		uuid VARCHAR(255),
    		user VARCHAR(255),
    		CONSTRAINT PK_Like PRIMARY KEY (uuid,user),
    		CONSTRAINT PK_LikeUser FOREIGN KEY (user) REFERENCES User(uuid)
		)";
		if ($this->db->exec($sql)) {
			return true;
		} else {
			return false;
		}
	}

	function createDislikeTable(){
		$sql = "CREATE TABLE IF NOT EXISTS Dislike (
    		uuid VARCHAR(255),
    		user VARCHAR(255),
    		CONSTRAINT PK_Dislike PRIMARY KEY (uuid,user),
    		CONSTRAINT PK_LikeUser FOREIGN KEY (user) REFERENCES User(uuid)
		)";
		if ($this->db->exec($sql)) {
			return true;
		} else {
			return false;
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
			return true;
		} else {
			return false;
		}
	}

	function closeConnection() {
		$this->db = null;
	}
}

