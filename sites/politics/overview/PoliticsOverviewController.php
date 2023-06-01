<?php

include "../FilePartyDAO.php";

$partyDAO = new FilePartyDAO();
$partyList = $partyDAO->getParties();