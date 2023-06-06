<?php
namespace posts;
include_once "PostDAO.php";
include_once "../../SQLHelper.php";

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
			// mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = 'INSERT INTO Post (uuid, title, text, author, category)
					VALUES (:uuid, :title, :text, :author, :category)';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $post["uuid"]);
			$preparedSQL->bindValue(":title", $post["title"]);
			$preparedSQL->bindValue(":text", $post["text"]);
			$preparedSQL->bindValue(":author", $post["author"]);
			$preparedSQL->bindValue(":category", $post["category"]);
			if ($preparedSQL->execute()) {
				$this->db->commit();
				return true;
			} else {
				echo "Posttabelle nicht aktualisiert";
			}
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
		}
		$this->db->rollBack();
		return false;
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
}