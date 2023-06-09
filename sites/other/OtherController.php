<?php

namespace sites\other;

use View;

class OtherController {

	private $request;
	private $template;

	public function __construct($request) {
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
	}

	public function work() {
		$view = new View();
		switch ($this->template){
			case 'support':
				$view->setTemplate("sites/other/support/support.php");
				break;
			case 'tutorial':
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