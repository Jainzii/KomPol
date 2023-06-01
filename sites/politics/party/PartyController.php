<?php

include "../FilePartyDAO.php";

if (!isset($_GET["name"])){
	header('Location: '. '../overview/politicsOverview.php');
}

$partyDAO = new FilePartyDAO();
$party = $partyDAO->getParty($_GET["name"]);

if (!isset($party)){
	header('Location: '. '../overview/politicsOverview.php');
}