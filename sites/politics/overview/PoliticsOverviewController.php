<?php

//include "../FilePartyDAO.php";
//use party\FilePartyDAO;

include "../DBPartyDAO.php";
use party\DBPartyDAO;

$partyDAO = new DBPartyDAO();
$partyList = $partyDAO->getParties();