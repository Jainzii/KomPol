<?php

namespace sites\other;

include_once "data/SupportModel.php";

use View;
use sites\other\data\SupportModel;

class OtherController {

	private $request;
	private $template;
	private $supportModel;

	public function __construct($request) {
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
		$this->supportModel = new SupportModel($request);
	}

	public function work() {
		$view = new View();
		switch ($this->template){
			case 'support':
				$supportModel = new SupportModel($this->request);
				$supportModel->sendSupportTicket();
				$view->assign("isSignedIn", isset($_SESSION["userId"]));
				$view->addStylesheet("sites/other/support/support.css");
				$view->setTemplate("sites/other/support/support.php");
				break;
			case 'tutorial':
				$view->addStylesheet("sites/other/tutorial/tutorial.css");
				$view->setTemplate("sites/other/tutorial/tutorial.php");
				break;
			case 'home':
			default:
				$view->setTemplate("sites/other/home/home.php");
				break;
		}
		return $view->loadTemplate();
	}

}