<?php

//include "FileSupportDAO.php";
include "DBSupportDAO.php";
//include "../../user/FileUserDAO.php";
include "../../user/DBUserDAO.php";

use support\DBSupportDAO;
//use user\FileUserDAO;
use user\DBUserDAO;

if(isset($_GET["supportTicket"])) {
    $issue = isset($_POST["issue"]) ? $_POST["issue"] : "";
    $text = isset($_POST["text"]) ? $_POST["text"] : "";
    sendSupportTicket($_POST["issue"], $_POST["text"]);
}

function sendSupportTicket($issue, $text) {
    if(isset($_SESSION["userId"])) {
        $userDAO = new DBUserDAO();
        $user = $userDAO->loadUserById($_SESSION["userId"]);

        $FileSupportDAO = new DBSupportDAO();
		$ticketId = uniqid("s_", true);

        $ticket = [];
        $ticket["uuid"] = $ticketId;
        $ticket["firstName"] = $user["firstName"];
        $ticket["lastName"] = $user["lastName"];
        $ticket["email"] = $user["email"];
        $ticket["issue"] = $issue;
        $ticket["text"] = $text;

        $FileSupportDAO->addSupportTicket($ticket);
    }

}

?>