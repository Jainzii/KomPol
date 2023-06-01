<?php

include "FileSupportDAO.php";


if(isset($_GET["supportTicket"])) {
    $issue = isset($_POST["issue"]) ? $_POST["issue"] : "";
    $text = isset($_POST["text"]) ? $_POST["text"] : "";
    sendSupportTicket($_POST["issue"], $_POST["text"]);
}


function sendSupportTicket($issue, $text) {
    $userDAO = new FileUserDAO("../../user/");
    $user = $userDAO->loadUserById($_SESSION["userId"]);

    $FileSupportDAO = new FileSupportDAO();

    $ticket = [];
    $ticket["firstName"] = $user->firstName;
    $ticket["lastName"] = $user->lastName;
    $ticket["email"] = $user->email;
    $ticket["issue"] = $issue;
    $ticket["text"] = $text;

    $FileSupportDAO->addSupportTicket($ticket);
}

?>