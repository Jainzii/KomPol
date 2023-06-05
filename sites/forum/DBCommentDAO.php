<?php
namespace posts;
include "CommentDAO.php";
include "../../SQLHelper.php";
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

		$helper = new \SQLHelper();

		$this->db = new PDO($dsn, $user, $pw);
	}

	function addComment($comment)
	{
		try {
			$sql = 'INSERT INTO Post (uuid, title, text, author, category)
					VALUES (:uuid, :title, :text, :author, :category)';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $comment["uuid"]);
			$preparedSQL->bindValue(":title", $comment["title"]);
			$preparedSQL->bindValue(":text", $comment["text"]);
			$preparedSQL->bindValue(":author", $comment["author"]);
			$preparedSQL->bindValue(":category", $comment["category"]);
			if ($preparedSQL->execute()) {
				echo "Posttabelle aktualisiert";
			} else {
				echo "Posttabelle nicht aktualisiert";
			}
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
		}
	}

	function updateComment($comment)
	{
		// TODO: Implement updateComment() method.
	}

	function getComments($answerTo)
	{
		// TODO: Implement getComments() method.
	}
}