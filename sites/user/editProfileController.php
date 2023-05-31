<?php

include "../FileUserDAO.php";

if (!isset($_SESSION["userId"])){
    header('Location: '. '../login/login.php');
}

if(isset($_GET["changeDetails"])) {
    echo "Penisblut";
    echo $_POST["firstName"];

    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : "";
    $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : "";
    changeDetails($_POST["email"], $_POST["firstName"], $_POST["lastName"]);
    echo "Penisblut";
}

function changeDetails($email, $firstName, $lastName) {

    $userDAO = new FileUserDAO();

    $user = $userDAO->loadUserById($_SESSION["userId"]);
    $user->firstName = $firstName;
    $user->lastNAme = $lastName;
    $user->email = $email;
    $userDAO->updateUser($user);

}




function changePassword($oldPassword, $newPassword1, $newPassword2) {

    $userDAO = new FileUserDAO();

    $user = $userDAO->loadUserById($_SESSION["userId"]);
    $user->firstName = $firstName;
    $user->lastNAme = $lastName;
    $user->email = $email;
    $userDAO->updateUser($user);

}



?>