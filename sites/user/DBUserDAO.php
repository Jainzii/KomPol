<?php

namespace user;
include_once "UserDAO.php";
include_once "../../SQLHelper.php";

use Exception;
use PDO;
use SQLHelper;


class DBUserDAO implements UserDAO {
	private $db;

	public function __construct() {
		$user = 'root';
		$pw = null;
		// SQLITE
		$dsn = 'sqlite:..\..\kompol.db';
		// MYSQL
		// $dsn = 'mysql:dbname=kompol;host=localhost';
		$helper = new SQLHelper();
		$helper->closeConnection();
		$this->db = new PDO($dsn, $user, $pw);
	}

	function addUser($user)
	{
		try {
			// mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = 'INSERT INTO User (uuid, email, password)
					VALUES (:uuid, :email, :password)';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $user["uuid"]);
			$preparedSQL->bindValue(":email", $user["email"]);
			$preparedSQL->bindValue(":password", $user["password"]);
			if ($preparedSQL->execute()) {
				$this->db->commit();
				return true;
			} else {
				echo "Usertabelle nicht aktualisiert";
			}
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
		}
		$this->db->rollBack();
		return false;
	}

	function updateUser($user)
	{
		try {
			// mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = 'UPDATE User SET email = :email, password = :password, firstName = :firstName, lastName = :lastName, 
                avatar = :avatar, party = :party WHERE uuid = :uuid';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $user["uuid"]);
			$preparedSQL->bindValue(":email", $user["email"]);
			$preparedSQL->bindValue(":password", $user["password"]);
			$preparedSQL->bindValue(":firstName", $user["firstName"]);
			$preparedSQL->bindValue(":lastName", $user["lastName"]);
			$preparedSQL->bindValue(":avatar", $user["avatar"]);
			$preparedSQL->bindValue(":party", $user["party"]);
			if ($preparedSQL->execute()) {
				$this->db->commit();
				return true;
			} else {
				echo "Usertabelle nicht aktualisiert";
			}
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
		}
		$this->db->rollBack();
		return false;
	}

	function loadUserByEmail($email)
	{
		try {
			$sql = "SELECT * FROM User WHERE email = '" . $email . "'";
			$test = $this->db->query($sql);
			$user = $test->fetchAll();
			return array_pop($user);
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
			return null;
		}
	}

	function loadUserById($uuid)
	{
		try {
			$sql = "SELECT * FROM User WHERE uuid = '" . $uuid . "'";
			$test = $this->db->query($sql);
			$user = $test->fetchAll();
			return array_pop($user);
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
			return null;
		}
	}

	function getIdByRegistrationCode($registrationCode)
	{
		try {
			$sql = "SELECT uuid FROM User WHERE registrationCode = '" . $registrationCode . "'";
			$test = $this->db->query($sql);
			$ids = $test->fetchAll();
			return array_pop($ids);
		} catch (Exception $ex) {
			echo "Fehler :" . $ex->getMessage();
			return null;
		}
	}
}
?>