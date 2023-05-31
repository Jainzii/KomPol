<?php

include "../FileUserDAO.php";

if (!isset($_SESSION["userId"])){
    header('Location: '. '../login/login.php');
}

if(isset($_GET["changeDetails"])) {
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : "";
    $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : "";
    changeDetails($_POST["email"], $_POST["firstName"], $_POST["lastName"]);
}

function changeDetails($email, $firstName, $lastName) {

    $userDAO = new FileUserDAO();

    $user = $userDAO->loadUserById($_SESSION["userId"]);
    $user->firstName = $firstName;
    $user->lastName = $lastName;
    $user->email = $email;
    $userDAO->updateUser($user);

}

if(isset($_GET["changePassword"])) {
    $oldPassword = isset($_POST["oldPassword"]) ? $_POST["oldPassword"] : "";
    $newPassword1 = isset($_POST["newPassword1"]) ? $_POST["newPassword1"] : "";
    $newPassword2 = isset($_POST["newPassword2"]) ? $_POST["newPassword2"] : "";
    changePassword($_POST["oldPassword"], $_POST["newPassword1"], $_POST["newPassword2"]);
}


function changePassword($oldPassword, $newPassword1, $newPassword2) {
    if (!$newPassword1 == $newPassword2) {
        return;
    }

    $userDAO = new FileUserDAO();

    $user = $userDAO->loadUserById($_SESSION["userId"]);

    if(password_verify($oldPassword, $user->password)) {
        $user->password = password_hash($newPassword1, PASSWORD_BCRYPT);
        $userDAO->updateUser($user);
    }

}



?>