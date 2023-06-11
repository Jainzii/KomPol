<?php

namespace sites\user\data;

class UserModel {

	private $userDB;
	private $data;

	public function __construct($data) {
		$this->userDB = new DBUserDAO();
		$this->data = $data;
	}

	public function login() {
		if (isset($this->data["loginSubmit"])) {
			$email = isset($this->data["loginEmail"]) ? $this->data["loginEmail"] : "";
			$password = isset($this->data["loginPassword"]) ? $this->data["loginPassword"] : "";
			unset($this->data["loginSubmit"]);

			$user = $this->userDB->loadUserByEmail($email);
			if (isset($user) && password_verify($password, $user["password"])){
				$_SESSION["userId"] = $user["uuid"];
				$_SESSION["info"]["LoginSuccess"] = "Erfolgreich angemeldet!";
				header('Location: '. 'index.php?view=newsOverview');
			} else {
				$_SESSION["errors"]["LoginFailure"] = "Email oder Passwort falsch.";
			}
		}
	}

	public function register() {
		if (isset($this->data["register"])) {
			// check input
			$email = isset($this->data["registerEmail"]) ? $this->data["registerEmail"] : "";
			$password = isset($this->data["registerPassword"]) ? $this->data["registerPassword"] : "";
			$passwordRepeat = isset($this->data["registerPasswordRepeat"]) ? $this->data["registerPasswordRepeat"] : "";
			$code = isset($this->data["registerCode"]) ? $this->data["registerCode"] : null;
			unset($this->data["register"]);

			// check if passwords match
			if ($password !== $passwordRepeat) {
				$_SESSION["errors"]["Register Error"] = "Registrierung fehlgeschlagen. Die Passwörter stimmen nicht überein.";
				return null;
			}

			// check if user already exists
			if ($this->userDB->loadUserByEmail($email) !== null) {
				$_SESSION["errors"]["Register Error"] = "Registrierung fehlgeschlagen.";
				return null;
			}

			// register user
			$success = false;
			$user = [];
			if (isset($code) && $code !== "") {
				$user = $this->userDB->getUserByRegistrationCode($code);
				$user["email"] = $email;
				$user["password"] = password_hash($password, PASSWORD_BCRYPT);
				if ($this->userDB->registerUserWithCode($user)) {
					$success = true;
				}
			} else {
				$user["uuid"] = uniqid("u_", true);
				$user["email"] = $email;
				$user["password"] = password_hash($password, PASSWORD_BCRYPT);
				$user["firstName"] = "Vorname";
				$user["lastName"] = "Nachname";
				$_SESSION["info"]["test"] = print_r($user);
				if ($this->userDB->registerUserWithoutCode($user)) {
					$success = true;
				}
			}

			// handle whether registration was successful or not
			if ($success) {
				$_SESSION["userId"] = $user["uuid"];
				$_SESSION["info"]["RegisterSuccess"] = "Erfolgreich registriert!";
				header('Location: '. 'index.php?view=newsOverview');
			} else {
				$_SESSION["errors"]["Register Error"] = "Registrierung fehlgeschlagen.";
			}
		}
	}

	public function editProfile() {
		if (!isset($_SESSION["userId"])){
			$_SESSION["errors"]["EditProfile"] = "Bitte melden Sie sich an, um Ihr Profil zu bearbeiten";
			header('Location: '. 'index.php?view=login');
		}

		$user = $this->userDB->loadUserById($_SESSION["userId"]);
		if (!isset($user)){
			$_SESSION["errors"]["EditProfile"] = "Fehler beim Laden der Nutzerdaten. Bitte kontaktieren Sie den Support.";
		}

		if (isset($this->data["detailsSubmit"])){
			$avatarName = basename($_FILES["avatar"]["name"]) !== "" ? basename($_FILES["avatar"]["name"]) . "_" . $_SESSION["userId"] : null;
			if (isset($avatarName)){
				$target_file = "sites/user/media/" . $avatarName;
				if (file_exists($target_file)) {
					unlink($target_file);
				}
				move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
				unset($_FILES["avatar"]);
				$user["avatar"] = $target_file !== "" ? $target_file: $user["avatar"];
			}

			// verify other data
			$newEmail = $this->data["changeEmail"];
			$newFirstName = $this->data["changeFirstName"];
			$newLastName = $this->data["changeLastName"];
			$user["email"] = isset($newEmail) && $newEmail !== "" ? $newEmail: $user["email"] ;
			$user["firstName"] = isset($newFirstName) && $newFirstName !== "" ? $newFirstName: $user["firstName"];
			$user["lastName"] = isset($newLastName) && $newLastName !== "" ? $newLastName: $user["lastName"];

			if ($this->userDB->updateUser($user)) {
				$_SESSION["info"]["EditProfile"] = "Daten aktualisiert.";
			} else {
				$_SESSION["errors"]["EditProfile"] = "Fehler beim Aktualisieren der Daten.";
			}
		}

		if (isset($this->data["passwordSubmit"])){
			$oldPassword = $this->data["oldPassword"];
			$newPassword = $this->data["newPassword"];
			$newPasswordRepeat = $this->data["newPasswordRepeat"];

			if ($newPassword !== $newPasswordRepeat) {
				$_SESSION["errors"]["EditProfile"] = "Passwort und Passwort-Wiederholen sind unterschiedlich.";
				return $user;
			}

			if (password_verify($oldPassword, $user["password"])){
				$user["password"] = password_hash($newPassword, PASSWORD_BCRYPT);
				if ($this->userDB->updateUser($user)) {
					$_SESSION["info"]["EditProfile"] = "Passwort aktualisiert.";
				} else {
					$_SESSION["errors"]["EditProfile"] = "Fehler beim Aktualisieren des Passworts.";
				}
			} else {
				$_SESSION["errors"]["EditProfile"] = "Altes Passwort ist falsch.";
			}
		}
		return $user;
	}
}