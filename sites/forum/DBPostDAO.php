<?php
namespace posts;
include "PostDAO.php";
include "../../SQLHelper.php";

use Exception;
use PDO;
use SQLHelper;

class DBPostDAO implements PostDAO {

	private $db;

	public function __construct() {
		$user = 'root';
		$pw = null;
		// SQLITE
		$dsn = 'sqlite:..\..\kompol.db';
		// MYSQL
		// $dsn = 'mysql:dbname=kompol;host=localhost';
		$helper = new SQLHelper();
		$helper->createPostTable();
		$helper->closeConnection();
		$this->db = new PDO($dsn, $user, $pw);
	}

	function addPost($post) {
		try {
			$sql = 'INSERT INTO Post (uuid, title, text, author, category)
					VALUES (:uuid, :title, :text, :author, :category)';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $post["uuid"]);
			$preparedSQL->bindValue(":title", $post["title"]);
			$preparedSQL->bindValue(":text", $post["text"]);
			$preparedSQL->bindValue(":author", $post["author"]);
			$preparedSQL->bindValue(":category", $post["category"]);
			if ($preparedSQL->execute()) {
				echo "Posttabelle aktualisiert";
			} else {
				echo "Posttabelle nicht aktualisiert";
			}
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
		}
	}

	function updatePost($post) {
		try {
			$sql = 'UPDATE Post
					SET title = :title, text = :text, category = :category
					WHERE uuid = :uuid';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":title", $post->title);
			$preparedSQL->bindValue(":text", $post->text);
			$preparedSQL->bindValue(":category", $post->category);
			$preparedSQL->bindValue(":uuid", $post->author->uuid);

			if ($preparedSQL->execute()) {
				echo "Post aktualisiert";
			} else {
				echo "Post nicht aktualisiert";
			}
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
		}
	}

	function getPost($uuid) {
		try {
			$sql = "SELECT * FROM Post WHERE uuid = '" . $uuid . "'";
			$test = $this->db->query($sql);
			$party = $test->fetchAll();
			return array_pop($party);
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
			return null;
		}
	}

	function getPosts() {
		try {
			$sql = "SELECT * FROM Post";
			return $this->db->query($sql)->fetchAll();
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
			return [];
		}
	}

	function likePost($userId, $post) {
		$sql = "SELECT * FROM Like WHERE uuid = :postId AND user = :userId";
		$preparedSQL = $this->db->prepare($sql);
		$preparedSQL->bindValue(":postId", $post["uuid"]);
		$preparedSQL->bindValue(":userId", $userId);
		$executedSQL = $preparedSQL->execute();
		echo isset($executedSQL);

	}

	function dislikePost($user) {

	}
}