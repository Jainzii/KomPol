<?php

namespace sites\politics\data;

use Exception;
use PDO;
use sites\SQLHelper;

include_once "PartyDAO.php";
include_once "sites/SQLHelper.php";

class DBPartyDAO implements PartyDAO
{
	private $db;

	public function __construct() {
		$user = 'root';
		$pw = null;
		// SQLITE
		$dsn = 'sqlite:sites\kompol.db';
		// MYSQL
		// $dsn = 'mysql:dbname=kompol;host=localhost';
		$helper = new SQLHelper();
		$helper->createPartyTable();
		$this->db = new PDO($dsn, $user, $pw);
	}

	function getParties() {
		try {
			$this->db->beginTransaction();
			$sql = "SELECT * FROM Party";
			$this->db->commit();
			return $this->db->query($sql)->fetchAll();
		} catch (Exception $ex) {
			$this->db->rollBack();
			return null;
		}
	}

	function getParty($name) {
		try {
			$this->db->beginTransaction();
			$sql = "SELECT * FROM Party WHERE name = '" . $name . "'";
			$test = $this->db->query($sql);
			$party = $test->fetchAll();
			$this->db->commit();
			return array_pop($party);
		} catch (Exception $ex) {
			$this->db->rollBack();
			return null;
		}
	}
}