<?php

//include_once "../FileUserDAO.php";
include_once "../DBUserDAO.php";
include_once "../../components/error/ErrorController.php";

//use user\FileUserDAO;
use user\DBUserDAO;

$errorController = new ErrorController();

if (!isset($_SESSION["userId"])){
    header('Location: '. '../login/login.php');
}

$userDAO = new DBUserDAO();
$user = $userDAO->loadUserById($_SESSION["userId"]);

if (!isset($user)){
	header('Location: '. '../login/login.php');
}

if(isset($_GET["changeDetails"])) {
	$avatarName = basename($_FILES["avatar"]["name"]) !== "" ? basename($_FILES["avatar"]["name"]) . "_" . $_SESSION["userId"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : "";
    $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : "";
    changeDetails($avatarName,$email, $username, $firstName, $lastName);
}

function changeDetails($avatarName, $email, $username, $firstName, $lastName) {
	global $user;
	global $userDAO;
	global $errorController;

	if (!empty($userDAO->checkIfUsernameIsTaken($username))) {
		$errorController->addErrorMessage("UsernameTaken", "Benutzername bereist vergeben.");
		return;
	}

	if (isset($avatarName)){
		$target_file = "../media/" . $avatarName;
		if (file_exists($target_file)) {
			unlink($target_file);
		}
		move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
		unset($_FILES["avatar"]);
		$user["avatar"] = $target_file;
	}
    $user["firstName"] = $firstName;
    $user["lastName"] = $lastName;
    $user["email"] = $email;
    $user["username"] = $username;
    $success = $userDAO->updateUser($user);
	if (!isset($success)) {
		$errorController->addErrorMessage("UserUpdateError", "Fehler beim Aktualisieren der Nutzerdaten.");
	}
}

if(isset($_GET["changePassword"])) {
    $oldPassword = isset($_POST["oldPassword"]) ? $_POST["oldPassword"] : "";
    $newPassword1 = isset($_POST["newPassword1"]) ? $_POST["newPassword1"] : "";
    $newPassword2 = isset($_POST["newPassword2"]) ? $_POST["newPassword2"] : "";
    changePassword($_POST["oldPassword"], $_POST["newPassword1"], $_POST["newPassword2"]);
}


function changePassword($oldPassword, $newPassword1, $newPassword2) {
	global $errorController;
    if ($newPassword1 !== $newPassword2) {
		$errorController->addErrorMessage("EditProfileError","Änderung fehlgeschlagen. Die Passwörter stimmen nicht überein.");
        return null;
    }
	global $user;
	global $userDAO;

    if(password_verify($oldPassword, $user["password"])) {
        $user["password"] = password_hash($newPassword1, PASSWORD_BCRYPT);
		$success = $userDAO->updateUser($user);
		if (!isset($success)) {
			$errorController->addErrorMessage("UserUpdateError", "Fehler beim Aktualisieren der Nutzerdaten.");
		}
    } else {
		$errorController->addErrorMessage("EditProfileError","Änderung fehlgeschlagen. Das alte Passwort ist falsch.");
		return null;
	}

}

if ($errorController->hasErrors()) {
	echo $errorController->showErrorBox();
}

?>