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
            if (isset($user["uuid"])) {
                $sql = 'UPDATE User SET email = :email, username= :username, password = :password WHERE uuid = :uuid';
            } else {
                $user["uuid"] = uniqid("u_", true);
                $sql = 'INSERT INTO User (uuid, email, username, password)
					VALUES (:uuid, :email, :username, :password)';
            }
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $user["uuid"]);
			$preparedSQL->bindValue(":email", $user["email"]);
			$preparedSQL->bindValue(":username", $user["username"]);
			$preparedSQL->bindValue(":password", $user["password"]);
			if ($preparedSQL->execute()) {
				$this->db->commit();
				return true;
			} else {
				$this->db->rollBack();
				return null;
			}
		} catch (Exception $ex) {
			$this->db->rollBack();
			return null;
		}
	}

	function updateUser($user)
	{
		try {
			// mySQL TRANSACTION ISOLATION LEVEL hinzufügen
			$this->db->beginTransaction();
			$sql = 'UPDATE User SET email = :email, password = :password, username = :username, firstName = :firstName, lastName = :lastName, 
                avatar = :avatar WHERE uuid = :uuid';
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $user["uuid"]);
			$preparedSQL->bindValue(":email", $user["email"]);
			$preparedSQL->bindValue(":password", $user["password"]);
			$preparedSQL->bindValue(":firstName", $user["firstName"]);
			$preparedSQL->bindValue(":username", $user["username"]);
			$preparedSQL->bindValue(":lastName", $user["lastName"]);
			$preparedSQL->bindValue(":avatar", $user["avatar"]);
			if ($preparedSQL->execute()) {
				$this->db->commit();
				return true;
			} else {
				$this->db->rollBack();
				return null;
			}
		} catch (Exception $ex) {
			$this->db->rollBack();
			return null;
		}
	}

	function loadUserByEmail($email)
	{
		try {
			$sql = "SELECT * FROM User WHERE email = '" . $email . "'";
			$test = $this->db->query($sql);
			$user = $test->fetchAll();
			return array_pop($user);
		} catch (Exception $ex) {
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
			return null;
		}
	}

	function getIdByRegistrationCode($registrationCode)
	{
		try {
			$sql = "SELECT uuid FROM User WHERE registrationCode = '" . $registrationCode . "'";
			$test = $this->db->query($sql);
            return $test->fetchColumn();
		} catch (Exception $ex) {
			return null;
		}
	}

    function checkIfUsernameIsTaken($username) {
        try {
            $sql = "SELECT uuid FROM User WHERE username = '" . $username . "'";
            $test = $this->db->query($sql);
            return $test->fetchColumn();
        } catch (Exception $ex) {
            return null;
        }
    }
}
?>