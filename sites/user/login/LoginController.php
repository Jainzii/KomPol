<?php

//include_once "../FileUserDAO.php";
include_once "../DBUserDAO.php";
include_once "../../components/error/ErrorController.php";

//use user\FileUserDAO;
use user\DBUserDAO;

$errorController = new ErrorController();

if (isset($_GET["login"])) {
    $email = isset($_POST["e-mail"]) ? $_POST["e-mail"] : "";
    $password = isset($_POST["passwort"]) ? $_POST["passwort"] : "";
    $error = false;

	$userDAO = new DBUserDAO();

    if ($email) {
        $user = $userDAO->loadUserByEmail($email);
        if (isset($user) && password_verify($password, $user["password"])) {
            $_SESSION["userId"] = $user["uuid"];
            header('Location: '. '../../news/overview/newsOverview.php');
            die();
        } else {
            $errorController->addErrorMessage("LoginError","Email oder Passwort falsch.");
			return null;
        }
    } else {
		$errorController->addErrorMessage("LoginError","Email oder Passwort falsch.");
		return null;
    }
} else {
    $email = "";
    $password = "";
}

if ($errorController->hasErrors()) {
	echo $errorController->showErrorBox();
}

?>