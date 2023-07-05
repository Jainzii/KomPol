<?php

namespace party;
use Exception;
use PDO;
use SQLHelper;

include_once "PartyDAO.php";
include_once "../../SQLHelper.php";

class DBPartyDAO implements PartyDAO
{
	private $db;

	public function __construct() {
		$user = 'root';
		$pw = null;
		// SQLITE
		$dsn = 'sqlite:..\..\kompol.db';
		// MYSQL
		// $dsn = 'mysql:dbname=kompol;host=localhost';
		$helper = new SQLHelper();
		$helper->createPartyTable();
		$this->db = new PDO($dsn, $user, $pw);
	}

	function getParties() {
		try {
			$sql = "SELECT * FROM Party";
			return $this->db->query($sql)->fetchAll();
		} catch (Exception $ex) {
			return null;
		}
	}

	function getParty($name) {
		try {
			$sql = "SELECT * FROM Party WHERE name = :name";
      $preparedSQL = $this->db->prepare($sql);
      $preparedSQL->bindValue(":name", $name);
      $preparedSQL->execute();
      foreach ($preparedSQL as $row) {
        return $row;
      }
      return null;
		} catch (Exception $ex) {
			return null;
		}
	}
}