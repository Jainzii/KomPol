<?php
namespace posts;
include_once "CommentDAO.php";
include_once "../../SQLHelper.php";
use PDO;
use SQLHelper;
use Exception;

class DBCommentDAO implements CommentDAO {

	private $db;

	public function __construct() {
		$user = 'root';
		$pw = null;

		// SQLITE
		$dsn = 'sqlite:..\..\kompol.db';

		// MYSQL
		// $dsn = 'mysql:dbname=kompol;host=localhost';

		$helper = new SQLHelper();
		$helper->createCommentTable();
		$helper->closeConnection();

		$this->db = new PDO($dsn, $user, $pw);
	}

	function addComment($comment) {
		try {
			// mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = 'INSERT INTO Comment (uuid, answerTo, text, author)
					VALUES (:uuid, :answerTo, :text, :author)';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $comment["uuid"]);
			$preparedSQL->bindValue(":answerTo", $comment["answerTo"]);
			$preparedSQL->bindValue(":text", $comment["text"]);
			$preparedSQL->bindValue(":author", $comment["author"]);
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

	function getComments($answerTo) {
		try {
			$sql = "SELECT * FROM Comment WHERE answerTo = '" . $answerTo . "'";
			$test = $this->db->query($sql);
			$party = $test->fetchAll();
			return $party;
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
			return null;
		}
	}
}