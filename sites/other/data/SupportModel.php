<?php

namespace sites\other\data;

include_once "sites/other/data/DBSupportDAO.php";
include_once "sites/user/data/DBUserDAO.php";

use sites\user\data\DBUserDAO;

class SupportModel {

	private $userDB;
	private $supportDB;
	private $data;

	public function __construct($data) {
		$this->userDB = new DBUserDAO();
		$this->supportDB = new DBSupportDAO();
		$this->data = $data;
	}

	public function sendSupportTicket() {
		if (isset($this->data["supportTicket"])
			&& $this->data["supportTicket"] == 1
		){
			$ticket = [];
			$ticket["uuid"] = uniqid("s_", true);
			$ticket["issue"] = $this->data["ticketIssue"];
			$ticket["text"] = $this->data["ticketText"];
			if (isset($_SESSION["userId"])) {
				$user = $this->userDB->loadUserById($_SESSION["userId"]);
				if (isset($user)) {
					$ticket["email"] = $user["email"];
				} else {
					$_SESSION["errors"]["Support"] = "Fehler beim Laden der Nutzerdaten";
					return;
				}
			} else {
				$ticket["email"] = $this->data["ticketEmail"];
			}
			if (!$this->supportDB->addSupportTicket($ticket)) {
				$_SESSION["errors"]["Support"] = "Fehler beim Senden des Tickets";
			} else {
				$_SESSION["info"]["Support"] = "Support-Ticket abgesendet.";
			}
		}
	}
}