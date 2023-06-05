<?php

include "SupportDAO.php";
include "../../user/FileUserDAO.php";

class FileSupportDAO implements SupportDAO
{

    function addSupportTicket($supportTicket) {
        $json = file_get_contents("support.json");
        $obj =  json_decode($json);
        $obj[] = $supportTicket;
        file_put_contents("support.json", json_encode($obj));
    }

}