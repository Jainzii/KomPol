<?php

//include_once "../FilePartyDAO.php";
//use party\FilePartyDAO;

include_once "../DBPartyDAO.php";
use party\DBPartyDAO;

$partyDAO = new DBPartyDAO();
$partyList = $partyDAO->getParties();