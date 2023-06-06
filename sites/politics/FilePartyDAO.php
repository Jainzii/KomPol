<?php

namespace party;
include_once "PartyDAO.php";

class FilePartyDAO implements PartyDAO
{
	function getParties()
	{
		$json = file_get_contents("../party.json");
		$partyList =  json_decode($json);
		return isset($partyList) ? $partyList : [];
	}

	function getParty($name)
	{
		$json = file_get_contents("../party.json");
		$partyList =  json_decode($json);
		foreach ($partyList as $party) {
			if ($party->name === $name) return $party;
		}
		return null;
	}
}