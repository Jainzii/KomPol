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
              $sql = 'UPDATE User SET username= :username, password = :password WHERE uuid = :uuid';
            } else {
              $user["uuid"] = uniqid("u_", true);
              $sql = 'INSERT INTO User (uuid, username, password)
					VALUES (:uuid, :username, :password)';
            }
			$preparedSQL = $this->db->prepare($sql);
			$preparedSQL->bindValue(":uuid", $user["uuid"]);
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

  function validateUser($uuid, $email) {
    $sql = 'UPDATE User SET email = :email WHERE uuid = :uuid';
    $preparedSQL = $this->db->prepare($sql);
    $preparedSQL->bindValue(":uuid", $uuid);
    $preparedSQL->bindValue(":email", $email);
    if ($preparedSQL->execute()) {
      return true;
    } else {
      return false;
    }
  }

  function generateCSRFToken($uuid) {
    try {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $csrfToken = '';
      for ($i = 0; $i < 64; $i++) {
        $csrfToken .= $characters[rand(0, $charactersLength - 1)];
      }
      $sql = 'UPDATE User SET CSRFToken = :token WHERE uuid = :uuid';
      $preparedSQL = $this->db->prepare($sql);
      $preparedSQL->bindValue(":uuid", $uuid);
      $preparedSQL->bindValue(":token", $csrfToken);
      if ($preparedSQL->execute()) {
        return $csrfToken;
      } else {
        return null;
      }
    } catch (Exception $ex) {
      return null;
    }
  }

  function checkCSRFToken($uuid, $csrfToken) {
    $sql = 'SELECT uuid FROM USER WHERE uuid = :uuid AND CSRFToken = :token';
    $preparedSQL = $this->db->prepare($sql);
    $preparedSQL->bindValue(":uuid", $uuid);
    $preparedSQL->bindValue(":token", $csrfToken);
    $preparedSQL->execute();
    foreach ($preparedSQL as $row) {
      return !empty($row);
    }
    return false;
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
			$sql = "SELECT * FROM User WHERE email = :email";
      $preparedSQL = $this->db->prepare($sql);
      $preparedSQL->bindValue(":email", $email);
      $preparedSQL->execute();
      foreach ($preparedSQL as $row) {
        return $row;
      }
      return null;
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
			$sql = "SELECT uuid FROM User WHERE registrationCode = :registrationCode";
      $preparedSQL = $this->db->prepare($sql);
      $preparedSQL->bindValue(":registrationCode", $registrationCode);
      $preparedSQL->execute();
      foreach ($preparedSQL as $row) {
        return $row;
      }
      return null;
		} catch (Exception $ex) {
			return null;
		}
	}

  function getIdByUsername($username)
  {
    try {
      $sql = "SELECT uuid FROM User WHERE username = :username";
      $preparedSQL = $this->db->prepare($sql);
      $preparedSQL->bindValue(":username", $username);
      $preparedSQL->execute();
      foreach ($preparedSQL as $row) {
        return $row;
      }
      return null;
    } catch (Exception $ex) {
      return null;
    }
  }

  function checkIfUsernameIsTaken($username) {
      try {
          $sql = "SELECT uuid FROM User WHERE username = :username";
          $preparedSQL = $this->db->prepare($sql);
          $preparedSQL->bindValue(":username", $username);
          $preparedSQL->execute();
          foreach ($preparedSQL as $row) {
            return $row[0];
          }
          return null;
      } catch (Exception $ex) {
          return null;
      }
  }
}
?>