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
        registerWithCode($_POST["email"], $_POST["username"] ,$_POST["password1"], $_POST["password2"], $_POST["registrationCode"]);
    } else {
        registerWithoutCode($_POST["email"], $_POST["username"], $_POST["password1"], $_POST["password2"]);
    }
    unset($_GET["registration"]);
}

/**
 *
 */
function registerWithoutCode($email, $username, $password1, $password2){
	global $errorController;
	if (!validatePassword($password1, $password2) || !validateEmail($email)) {
		return null;
	}

    $userDAO = new DBUserDAO();

    $user = [];
    $user["email"] = $email;
    $user["username"] = $username;
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
function registerWithCode($email, $username, $password1, $password2, $registrationCode){
	global $errorController;
	if (!validateEmail($email) || !validatePassword($password1, $password2) || !validateCode($registrationCode)) {
		return null;
	}

    $userDAO = new DBUserDAO();
    $userId = $userDAO->getIdByRegistrationCode($registrationCode);
    if (isset($userId)) {
        $user = $userDAO->loadUserById($userId);
        $user["email"] = $email;
        $user["username"] = $username;
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

function validatePassword($password1, $password2) {
	global $errorController;
	$valid = true;
	if ($password1 !== $password2) {
		$valid = false;
		$errorController->addErrorMessage("Register Error","Registrierung fehlgeschlagen. Die Passwörter stimmen nicht überein.");
	}
	if (strlen($password1) < 8) {
		$valid = false;
		$errorController->addErrorMessage("Register Error","Registrierung fehlgeschlagen. Das Password ist zu kurz.");
	}
	if (!preg_match('~[0-9]+~', $password1)) {
		$valid = false;
		$errorController->addErrorMessage("Register Error","Registrierung fehlgeschlagen. Das Password enthält keine Nummer.");
	}
	if (!preg_match('~[A-ZÖÄÜ]+~', $password1)) {
		$valid = false;
		$errorController->addErrorMessage("Register Error","Registrierung fehlgeschlagen. Das Password enthält keinen Großbuchstaben.");
	}
	if (!preg_match('~[a-zA-ZÄÜÖ0-9]+~', $password1)) {
		$valid = false;
		$errorController->addErrorMessage("Register Error","Registrierung fehlgeschlagen. Das Password enthält kein Sonderzeichen.");
	}
	return $valid;
}

function validateEmail($email) {
	global $errorController;
	$valid = true;
	if (!preg_match('~[a-zA-ZÄÜÖ0-9]+~', $email)) {
		$valid = false;
		$errorController->addErrorMessage("Register Error","Registrierung fehlgeschlagen. Das E-Mail-Format ist nicht valide");
	}
	return $valid;
}

function validateCode($code) {
	global $errorController;
	$valid = true;
	if (!preg_match('~[a-zA-ZÄÜÖ0-9]+~', $code)) {
		$valid = false;
		$errorController->addErrorMessage("Register Error","Registrierung fehlgeschlagen. Das Code-Format ist nicht valide.");
	}
	return $valid;
}

if ($errorController->hasErrors()) {
	echo $errorController->showErrorBox();
}

?>