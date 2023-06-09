<?php

namespace sites\user;

use View;

class UserController {

	private $request;
	private $template;

	public function __construct($request) {
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
	}

	public function work() {
		$view = new View();
		switch ($this->template){
			case 'login':
				$view->setTemplate("sites/user/login/login.php");
				break;
			case 'registration':
				$view->setTemplate("sites/user/registration/registration.php");
				break;
			case 'editProfile':
				$view->setTemplate("sites/user/editProfile/editProfile.php");
				break;
		}
		return $view->loadTemplate();
	}

}