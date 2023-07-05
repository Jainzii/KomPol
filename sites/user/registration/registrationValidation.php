<?php

use user\DBUserDAO;

include_once "../DBUserDAO.php";

$email = urldecode($_GET["email"]);
$userId = urldecode($_GET["id"]);

$userDAO = new DBUserDAO();

if ($userDAO->validateUser($userId, $email)) {
    header('Location: '. '../editProfile/editProfile.php');
} else {
    header('Location: '. 'registration.php');
}

?>
