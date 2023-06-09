<?php

namespace sites\politics;

use View;

class PoliticsController {

	private $request;
	private $template;

	public function __construct($request) {
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
	}

	public function work() {
		$view = new View();
		switch ($this->template){
			case 'politics':
				$view->setTemplate("sites/politics/overview/politicsOverview.php");
				break;
			case 'party':
				$view->setTemplate("sites/footer/party/party.php");
				break;
		}
		return $view->loadTemplate();
	}

}