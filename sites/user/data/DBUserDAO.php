<?php

namespace sites\user\data;
include_once "UserDAO.php";
include_once "sites/SQLHelper.php";

use Exception;
use PDO;
use sites\SQLHelper;

class DBUserDAO implements UserDAO {
	private $db;

	public function __construct() {
		$user = 'root';
		$pw = null;
		// SQLITE
		$dsn = 'sqlite:sites\kompol.db';
		// MYSQL
		// $dsn = 'mysql:dbname=kompol;host=localhost';
		$helper = new SQLHelper();
		$helper->createUserTable();
		$helper->closeConnection();
		$this->db = new PDO($dsn, $user, $pw);
	}

	function registerUserWithCode($user) {
		try {
			// TODO: mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = 'UPDATE User SET email = :email, password = :password, registrationCode = :registrationCode WHERE uuid = :uuid';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":email", $user["email"]);
			$preparedSQL->bindValue(":password", $user["password"]);
			$preparedSQL->bindValue(":registrationCode", null);
			if ($preparedSQL->execute()) {
				$this->db->commit();
				return true;
			} else {
				$this->db->rollBack();
				return false;
			}
		} catch (Exception $ex) {
			$this->db->rollBack();
			return false;
		}
	}

	function registerUserWithoutCode($user) {
		try {
			// TODO: mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = 'INSERT INTO User (uuid, email, password, firstName, lastName)
				VALUES (:uuid, :email, :password, :firstName, :lastName)';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $user["uuid"]);
			$preparedSQL->bindValue(":email", $user["email"]);
			$preparedSQL->bindValue(":password", $user["password"]);
			$preparedSQL->bindValue(":firstName", $user["firstName"]);
			$preparedSQL->bindValue(":lastName", $user["lastName"]);
			if ($preparedSQL->execute()) {
				$this->db->commit();
				return true;
			} else {
				$this->db->rollBack();
				return false;
			}
		} catch (Exception $ex) {
			$this->db->rollBack();
			return false;
		}
	}

	function updateUser($user)
	{
		try {
			// TODO: mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = 'UPDATE User SET email = :email, password = :password, firstName = :firstName, lastName = :lastName, 
                avatar = :avatar WHERE uuid = :uuid';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $user["uuid"]);
			$preparedSQL->bindValue(":email", $user["email"]);
			$preparedSQL->bindValue(":password", $user["password"]);
			$preparedSQL->bindValue(":firstName", $user["firstName"]);
			$preparedSQL->bindValue(":lastName", $user["lastName"]);
			$preparedSQL->bindValue(":avatar", $user["avatar"]);
			if ($preparedSQL->execute()) {
				$this->db->commit();
				return true;
			} else {
				$this->db->rollBack();
				return false;
			}
		} catch (Exception $ex) {
			$this->db->rollBack();
			return false;
		}
	}

	function loadUserByEmail($email)
	{
		try {
			// TODO: mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = "SELECT * FROM User WHERE email = '" . $email . "'";
			$query = $this->db->query($sql);
			$user = $query->fetchAll();

			$this->db->commit();
			return array_pop($user);
		} catch (Exception $ex) {
			$this->db->rollBack();
			return null;
		}
	}

	function loadUserById($uuid)
	{
		try {
			// TODO: mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = "SELECT * FROM User WHERE uuid = '" . $uuid . "'";
			$query = $this->db->query($sql);
			$user = $query->fetchAll();

			$this->db->commit();
			return array_pop($user);
		} catch (Exception $ex) {
			$this->db->rollBack();
			return null;
		}
	}

	function getUserByRegistrationCode($registrationCode)
	{
		try {
			// TODO: mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = "SELECT * FROM User WHERE registrationCode = '" . $registrationCode . "'";
			$query = $this->db->query($sql);
			$user = $query->fetchAll();

			$this->db->commit();
            return array_pop($user);
		} catch (Exception $ex) {
			$this->db->rollBack();
			return null;
		}
	}
}
?>