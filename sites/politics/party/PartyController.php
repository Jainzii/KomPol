<?php

//include_once "../FilePartyDAO.php";
include_once "../DBPartyDAO.php";

//use party\FilePartyDAO;
use party\DBPartyDAO;

if (!isset($_GET["name"])){
	header('Location: '. '../overview/politicsOverview.php');
}

$partyDAO = new DBPartyDAO();
$party = $partyDAO->getParty($_GET["name"]);

if (!isset($party)){
	header('Location: '. '../overview/politicsOverview.php');
}