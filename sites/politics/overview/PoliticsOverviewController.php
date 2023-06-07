<?php

//include_once "../FilePartyDAO.php";
//use party\FilePartyDAO;

include_once "../DBPartyDAO.php";
include_once "../../components/error/ErrorController.php";
use party\DBPartyDAO;

$errorController = new ErrorController();

$partyDAO = new DBPartyDAO();
$partyList = $partyDAO->getParties();
if (!isset($partyList)) {
	$errorController->addErrorMessage("PartyError", "Fehler beim Laden der Parteien.");
}

if ($errorController->hasErrors()) {
	echo $errorController->showErrorBox();
}