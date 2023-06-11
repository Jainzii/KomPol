<?php

namespace sites\user;

include_once "data/UserModel.php";

use View;
use sites\user\data\UserModel;

class UserController {

	private $request;
	private $template;
	private $userModel;

	public function __construct($request) {
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
		$this->userModel = new UserModel($request);
	}

	public function work() {
		$view = new View();
		switch ($this->template){
			case 'login':
				$this->userModel->login();
				$email = isset($this->request["loginEmail"]) ? $this->request["loginEmail"] : "";
				$password = isset($this->request["loginPassword"]) ? $this->request["loginPassword"] : "";
				$view->assign("email", $email);
				$view->assign("password", $password);
				$view->addStylesheet("sites/user/authentication.css");
				$view->setTemplate("sites/user/login/login.php");
				break;
			case 'registration':
				$this->userModel->register();

				$email = isset($this->request["registerEmail"]) ? $this->request["registerEmail"] : "";
				$password = isset($this->request["registerPassword"]) ? $this->request["registerPassword"] : "";
				$passwordRepeat = isset($this->request["registerPasswordRepeat"]) ? $this->request["registerPasswordRepeat"] : "";
				$code = isset($this->request["registerCode"]) ? $this->request["registerCode"] : "";

				$view->assign("email", $email);
				$view->assign("password", $password);
				$view->assign("passwordRepeat", $passwordRepeat);
				$view->assign("code", $code);

				$view->addStylesheet("sites/user/authentication.css");
				$view->setTemplate("sites/user/registration/registration.php");
				break;
			case 'editProfile':
				$updatedUser = $this->userModel->editProfile();

				$avatar = isset($updatedUser["avatar"]) ? $updatedUser["avatar"] : "sites/user/media/avatarDummy.png";
				$email = isset($updatedUser["email"]) ? $updatedUser["email"] : "";
				$firstName = isset($updatedUser["firstName"]) ? $updatedUser["firstName"] : "";
				$lastName = isset($updatedUser["lastName"]) ? $updatedUser["lastName"] : "";

				$view->assign("avatar",$avatar);
				$view->assign("email",$email);
				$view->assign("firstName",$firstName);
				$view->assign("lastName",$lastName);

				$view->addStylesheet("sites/user/editProfile/editProfile.css");
				$view->setTemplate("sites/user/editProfile/editProfile.php");
				break;
		}
		return $view->loadTemplate();
	}

}