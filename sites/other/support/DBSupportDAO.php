<?php

namespace support;
use Exception;
use PDO;
use SQLHelper;

//include "../../SQLHelper.php";
include "SupportDAO.php";

class DBSupportDAO implements SupportDAO {

	private $db;

	public function __construct() {
		$user = 'root';
		$pw = null;
		// SQLITE
		$dsn = 'sqlite:..\..\kompol.db';
		// MYSQL
		// $dsn = 'mysql:dbname=kompol;host=localhost';
		$helper = new SQLHelper();
		$helper->createSupportTable();
		$this->db = new PDO($dsn, $user, $pw);
	}

	function addSupportTicket($supportTicket) {
		try {
			$sql = 'INSERT INTO Support (uuid, firstName, lastName, email, issue, text)
					VALUES (:uuid, :firstName, :lastName, :email, :issue, :text)';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $supportTicket["uuid"]);
			$preparedSQL->bindValue(":firstName", $supportTicket["firstName"]);
			$preparedSQL->bindValue(":lastName", $supportTicket["lastName"]);
			$preparedSQL->bindValue(":email", $supportTicket["email"]);
			$preparedSQL->bindValue(":issue", $supportTicket["issue"]);
			$preparedSQL->bindValue(":text", $supportTicket["text"]);
			if ($preparedSQL->execute()) {
				echo "Supporttabelle aktualisiert";
			} else {
				echo "Supporttabelle nicht aktualisiert";
			}
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
		}
	}


}