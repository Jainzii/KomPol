<?php

namespace posts;
use Exception;
use PDO;
use SQLHelper;

include_once "RatingDAO.php";
include_once "../../SQLHelper.php";

class DBRatingDAO implements RatingDAO {

	private $db;

	public function __construct() {
		$user = 'root';
		$pw = null;
		// SQLITE
		$dsn = 'sqlite:..\..\kompol.db';
		// MYSQL
		// $dsn = 'mysql:dbname=kompol;host=localhost';
		$helper = new SQLHelper();
		$helper->createLikeTable();
		$helper->createDislikeTable();
		$helper->closeConnection();
		$this->db = new PDO($dsn, $user, $pw);
	}

	function hasLiked($postId,$userId)
	{
		try {
			$sql = "SELECT uuid FROM Like WHERE uuid = '" . $postId . "' AND user = '" . $userId . "'";
			$test = $this->db->query($sql);
			$ids = $test->fetchAll();
			return !empty($ids);
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
			return false;
		}
	}

	function addLike($postId,$userId)
	{
		try {
			// mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = 'INSERT INTO Like (uuid, user)
					VALUES (:uuid, :user)';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $postId);
			$preparedSQL->bindValue(":user", $userId);
			echo $postId . " " . $userId;
			if ($preparedSQL->execute()) {
				$this->db->commit();
				echo "Posttabelle aktualisiert";
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

	function removeLike($postId,$userId)
	{
		try {
			// mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = "DELETE FROM Like WHERE uuid = '" . $postId . "' AND user = '" . $userId . "'";
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $postId);
			$preparedSQL->bindValue(":userId", $userId);
			if ($preparedSQL->execute()) {
				$this->db->commit();
				echo "Posttabelle aktualisiert";
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

	function getLikeCount($postId)
	{
		try {
			$sql = "SELECT COUNT(uuid) FROM Like WHERE uuid = '" . $postId . "'";
			$test = $this->db->query($sql);
			$counts = $test->fetchColumn();
			return $counts;
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
			return 0;
		}
	}

	function hasDisliked($postId,$userId)
	{
		try {
			$sql = "SELECT uuid FROM Dislike WHERE uuid = '" . $postId . "' AND user = '" . $userId . "'";
			$test = $this->db->query($sql);
			$ids = $test->fetch();
			return !empty($ids);
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
			return false;
		}
	}

	function addDislike($postId,$userId)
	{
		try {
			// mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = 'INSERT INTO Dislike (uuid, user)
					VALUES (:uuid, :user)';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $postId);
			$preparedSQL->bindValue(":user", $userId);
			if ($preparedSQL->execute()) {
				$this->db->commit();
				echo "Posttabelle aktualisiert";
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

	function removeDislike($postId,$userId)
	{
		try {
			// mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = "DELETE FROM Dislike WHERE uuid = '" . $postId . "' AND user = '" . $userId . "'";
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $postId);
			$preparedSQL->bindValue(":userId", $userId);
			if ($preparedSQL->execute()) {
				$this->db->commit();
				echo "Posttabelle aktualisiert";
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

	function getDislikeCount($postId)
	{
		try {
			$sql = "SELECT COUNT(uuid) FROM Dislike WHERE uuid = '" . $postId . "'";
			$test = $this->db->query($sql);
			$counts = $test->fetchColumn();;
			return $counts;
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
			return 0;
		}
	}
}