<?php

include_once "SupportDAO.php";
include_once "../../user/FileUserDAO.php";

use support\SupportDAO;

class FileSupportDAO implements SupportDAO
{

    function addSupportTicket($supportTicket) {
        $json = file_get_contents("support.json");
        $obj =  json_decode($json);
        $obj[] = $supportTicket;
        file_put_contents("support.json", json_encode($obj));
    }

}