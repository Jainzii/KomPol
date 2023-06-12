<?php

namespace sites\footer;

use View;

class FooterController {

	private $request;
	private $template;

	public function __construct($request) {
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
	}

	public function work() {
		$view = new View();
		switch ($this->template){
			case 'imprint':
				$view->setTemplate("sites/footer/imprint/imprint.php");
				$view->addStylesheet("sites/footer/imprint/imprint.css");
				break;
			case 'privacyPolicy':
				$view->setTemplate("sites/footer/privacyPolicy/privacyPolicy.php");
				$view->addStylesheet("sites/footer/privacyPolicy/privacyPolicy.css");
				break;
			case 'termsOfUse':
				$view->setTemplate("sites/footer/termsOfUse/termsOfUse.php");
				$view->addStylesheet("sites/footer/termsOfUse/termsOfUse.css");
				break;
		}
		return $view->loadTemplate();
	}

}