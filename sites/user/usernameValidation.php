<?php

include_once "DBUserDAO.php";

use user\DBUserDAO;

$username = $_GET["username"];

if (!empty($username)) {
    $userDB = new DBUserDAO();
    $userWithNameList = $userDB->checkIfUsernameIsTaken($username);
    echo empty($userWithNameList);
}

?>