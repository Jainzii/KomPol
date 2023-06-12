<?php

namespace sites\politics;

include_once "data/PoliticsModel.php";

use sites\politics\data\PoliticsModel;
use View;

class PoliticsController {

	private $request;
	private $template;
	private $politicsModel;

	public function __construct($request) {
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
		$this->politicsModel = new PoliticsModel($request);
	}

	public function work() {
		$view = new View();
		switch ($this->template){
			case 'politics':
				$partyList = $this->politicsModel->getParties();
				$view->assign("partyList", $partyList);
				$view->assign("showParties", isset($partyList) && $partyList !== []);

				$view->addStylesheet("sites/politics/overview/politicsOverview.css");
				$view->setTemplate("sites/politics/overview/politicsOverview.php");
				break;
			case 'party':
				$partyName = $this->request['name'];
				$party = $this->politicsModel->getParty($partyName);
				$view->assign("name", $party["name"]);
				$view->assign("text", $party["text"]);
				$view->assign("logo", $party["logo"]);

				$view->addStylesheet("sites/politics/party/party.css");
				$view->setTemplate("sites/politics/party/party.php");
				break;
		}
		return $view->loadTemplate();
	}

}