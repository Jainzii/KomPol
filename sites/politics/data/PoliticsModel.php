<?php

namespace sites\politics\data;

include_once "DBPartyDAO.php";

class PoliticsModel {

	private $politicsDB;
	private $data;

	public function __construct($data) {
		$this->politicsDB = new DBPartyDAO();
		$this->data = $data;
	}

	public function getParties() {
		$partyList = $this->politicsDB->getParties();
		// verify parties
		if (!isset($partyList) || $partyList == null) {
			return [];
		}

		foreach ($partyList as $partyKey => $partyValue) {
			$safeParty = $partyValue;
			if (!isset($safeParty["name"]) || $safeParty["name"] == null){
				$safeParty = null;
			} else {
				$contentPreview = $safeParty["textPreview"];
				$safeParty["textPreview"] = isset($contentPreview) && $contentPreview !== "" ? $contentPreview : "Inhalt konnte nicht geladen werden.";
				$picturePath = $safeParty["logo"];
				$safeParty["logo"] = isset($picturePath) && $picturePath !== "" ? $picturePath : "sites/news/media/pictureDummy.png";
			}

			$partyList[$partyKey] = $safeParty;
		}

		if (!isset($partyList) && $partyList !== []) {
			$_SESSION["errors"]["Party Error"] = "Es gab einen Fehler beim Laden der Partei-Seite.";
		}
		return $partyList;
	}

	public function getParty($name) {
		$party = $this->politicsDB->getParty($name);
		$party["text"] = isset($party["text"]) && $party["text"] !== ""? $party["text"]: "Titel konnte nicht geladen werden.";
		$party["logo"] = isset($party["logo"]) && $party["logo"] !== ""? $party["logo"]: "sites/politics/media/partyDummy.png";

		if (!isset($party)){
			header('Location: '. '?view=politics');
		}
		return $party;
	}

}