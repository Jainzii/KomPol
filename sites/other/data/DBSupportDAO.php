<?php

namespace sites\other\data;

include_once "sites/SQLHelper.php";
include_once "SupportDAO.php";

use Exception;
use PDO;
use sites\SQLHelper;

class DBSupportDAO implements SupportDAO
{

	private $db;

	public function __construct()
	{
		$user = 'root';
		$pw = null;
		// SQLITE
		$dsn = 'sqlite:sites/kompol.db';
		// MYSQL
		// $dsn = 'mysql:dbname=kompol;host=localhost';
		$helper = new SQLHelper();
		$helper->createSupportTable();
		$this->db = new PDO($dsn, $user, $pw);
	}

	function addSupportTicket($supportTicket)
	{
		try {
			// mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = 'INSERT INTO Support (uuid, email, issue, text)
					VALUES (:uuid, :email, :issue, :text)';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $supportTicket["uuid"]);
			$preparedSQL->bindValue(":email", $supportTicket["email"]);
			$preparedSQL->bindValue(":issue", $supportTicket["issue"]);
			$preparedSQL->bindValue(":text", $supportTicket["text"]);
			if ($preparedSQL->execute()) {
				$this->db->commit();
				return false;
			} else {
				$this->db->rollBack();
				return false;
			}
		} catch (Exception $ex) {
			$this->db->rollBack();
			return false;
		}
	}

}