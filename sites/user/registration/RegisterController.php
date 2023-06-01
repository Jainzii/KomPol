<?php

include "../FileUserDAO.php";

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
    if (!$password1 == $password2) {
        return;
    }
    $userDAO = new FileUserDAO();

    $user = [];
    $user["uuid"] = uniqid("u_", true);
    $user["email"] = $email;
    $user["password"] = password_hash($password1, PASSWORD_BCRYPT);
    $userDAO->addUser($user);
}

/**
 *
 */
function registerWithCode($email, $password1, $password2, $registrationCode){
    if (!$password1 == $password2) {
        return;
    }
    $userDAO = new FileUserDAO();
    $userId = $userDAO->getIdByRegistrationCode($registrationCode);
    if (isset($userId)) {
        $user = $userDAO->loadUserById($userId);
        $user->uuid = uniqid("u_", true);
        $user->email = $email;
        $user->password = password_hash($password1, PASSWORD_BCRYPT);
        $userDAO->updateUser($user);
    }
}

?>