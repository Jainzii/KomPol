<?php
namespace news;
include "ArticleDAO.php";
include "../../SQLHelper.php";

use Exception;
use PDO;
use SQLHelper;

class DBArticleDAO implements ArticleDAO
{
	private $db;

	function __construct(){
		$user = 'root';
		$pw = null;
		// SQLITE
		$dsn = 'sqlite:..\..\kompol.db';
		// MYSQL
		// $dsn = 'mysql:dbname=kompol;host=localhost';
		$helper = new SQLHelper();
		$helper->createArticleTable();
		$helper->closeConnection();
		$this->db = new PDO($dsn, $user, $pw);
	}

	function getArticle($uuid) {
		try {
			$sql = "SELECT * FROM Article WHERE uuid = '" . $uuid . "'";
			$test = $this->db->query($sql);
			$article= $test->fetchAll();
			return array_pop($article);
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
			return null;
		}
	}

	function getArticles() {
		try {
			$sql = "SELECT * FROM Article";
			return $this->db->query($sql)->fetchAll();
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
			return [];
		}
	}
}