<?php

//include_once "../FileUserDAO.php";
include_once "../DBUserDAO.php";
include_once "../../components/error/ErrorController.php";

//use user\FileUserDAO;
use user\DBUserDAO;

$errorController = new ErrorController();

/**
 *
 */
if(isset($_GET["registration"])) {
    if ($_POST["registrationCode"] !== "") {
        registerWithCode($_POST["email"], $_POST["password1"], $_POST["password2"], $_POST["registrationCode"]);
    } else {
        registerWithoutCode($_POST["email"], $_POST["password1"], $_POST["password2"]);
    }
    unset($_GET["registration"]);
}

/**
 *
 */
function registerWithoutCode($email, $password1, $password2){
	global $errorController;

    if ($password1 !== $password2) {
		$errorController->addErrorMessage("Register Error","Registrierung fehlgeschlagen. Die Passwörter stimmen nicht überein.");
		return null;
    }
    $userDAO = new DBUserDAO();

    $user = [];
    $user["email"] = $email;
    $user["password"] = password_hash($password1, PASSWORD_BCRYPT);
	$success = $userDAO->addUser($user);
	if (isset($success)) {
		$_SESSION["userId"] = $user["uuid"];
		header('Location: '. '../editProfile/editProfile.php');
	} else {
		$errorController->addErrorMessage("Register Error","Registrierung fehlgeschlagen.");
		return null;
	}
}

/**
 *
 */
function registerWithCode($email, $password1, $password2, $registrationCode){
	global $errorController;

    if ($password1 !== $password2) {
		$errorController->addErrorMessage("RegisterError","Registrierung fehlgeschlagen. Die Passwörter stimmen nicht überein.");
		return null;
    }
    $userDAO = new DBUserDAO();
    $userId = $userDAO->getIdByRegistrationCode($registrationCode);
    if (isset($userId)) {
        $user = $userDAO->loadUserById($userId);
        $user["email"] = $email;
        $user["password"] = password_hash($password1, PASSWORD_BCRYPT);
		$success = $userDAO->addUser($user);
		if (isset($success)) {
			$_SESSION["userId"] = $user["uuid"];
			header('Location: '. '../editProfile/editProfile.php');
		} else {
			$errorController->addErrorMessage("Register Error","Registrierung fehlgeschlagen.");
			return null;
		}
    }
}

if ($errorController->hasErrors()) {
	echo $errorController->showErrorBox();
}

?>