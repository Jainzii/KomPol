<?php

//include_once "../FileUserDAO.php";
include_once "../DBUserDAO.php";

//use user\FileUserDAO;
use user\DBUserDAO;

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
    if ($password1 !== $password2) {
        return;
    }
    $userDAO = new DBUserDAO();

    $user = [];
    $user["email"] = $email;
    $user["password"] = password_hash($password1, PASSWORD_BCRYPT);
	$success = $userDAO->addUser($user);
	if ($success) {
		$_SESSION["userId"] = $user["uuid"];
		header('Location: '. '../editProfile/editProfile.php');
	}
}

/**
 *
 */
function registerWithCode($email, $password1, $password2, $registrationCode){
    if ($password1 !== $password2) {
        return;
    }
    $userDAO = new DBUserDAO();
    $userId = $userDAO->getIdByRegistrationCode($registrationCode);
    if (isset($userId)) {
        $user = $userDAO->loadUserById($userId);
        $user["email"] = $email;
        $user["password"] = password_hash($password1, PASSWORD_BCRYPT);
		$success = $userDAO->addUser($user);
		if ($success) {
			$_SESSION["userId"] = $user["uuid"];
			header('Location: '. '../editProfile/editProfile.php');
		}
    }
}

?>