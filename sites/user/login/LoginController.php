<?php
include "../FileUserDAO.php";

if (isset($_GET["login"])) {
    $email = isset($_POST["e-mail"]) ? $_POST["e-mail"] : "";
    $password = isset($_POST["passwort"]) ? $_POST["passwort"] : "";
    $error = false;
    $userDAO = new FileUserDAO();

    if ($email) {
        $user = $userDAO ->loadUserByEmail($email);

        if (isset($user) && password_verify($password, $user->password)) {
            $_SESSION["userId"] = $user->uuid;
            header('Location: '. '../../news/overview/newsOverview.php');
            die();
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
} else {
    $email = "";
    $password = "";
}

?>