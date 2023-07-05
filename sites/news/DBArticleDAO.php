<?php
namespace news;
include_once "ArticleDAO.php";
include_once "../../SQLHelper.php";

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
			$sql = "SELECT * FROM Article WHERE uuid = :uuid";
      $preparedSQL = $this->db->prepare($sql);
      $preparedSQL->bindValue(":uuid", $uuid);
      $preparedSQL->execute();
      foreach ($preparedSQL as $row) {
        return $row;
      }
      return null;
		} catch (Exception $ex) {
			return null;
		}
	}

	function getArticles() {
		try {
			$sql = "SELECT * FROM Article";
			return $this->db->query($sql)->fetchAll();
		} catch (Exception $ex) {
			return null;
		}
	}
}