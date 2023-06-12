<?php

namespace sites\news\data;
include_once "ArticleDAO.php";
include_once "sites/SQLHelper.php";

use Exception;
use PDO;
use sites\SQLHelper;

class DBArticleDAO implements ArticleDAO {
	private $db;

	public function __construct(){
		$user = 'root';
		$pw = null;
		// SQLITE
		$dsn = 'sqlite:sites\kompol.db';
		// MYSQL
		// $dsn = 'mysql:dbname=kompol;host=localhost';
		$helper = new SQLHelper();
		$helper->createArticleTable();
		$helper->closeConnection();
		$this->db = new PDO($dsn, $user, $pw);
	}

	function getArticle($uuid) {
		try {
			$this->db->beginTransaction();
			$sql = "SELECT * FROM Article WHERE uuid = '" . $uuid . "'";
			$test = $this->db->query($sql);
			$article= $test->fetchAll();

			$this->db->commit();
			return array_pop($article);
		} catch (Exception $ex) {
			$this->db->rollBack();
			return null;
		}
	}

	function getArticles() {
		try {
			$this->db->beginTransaction();
			$sql = "SELECT * FROM Article";
			$query = $this->db->query($sql);
			$articleList = $query->fetchAll();
			$this->db->commit();
			return $articleList;
		} catch (Exception $ex) {
			$this->db->rollBack();
			return null;
		}
	}
}