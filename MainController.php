<?php

include "sites/footer/FooterController.php";
include "sites/forum/ForumController.php";
include "sites/news/NewsController.php";
include "sites/other/OtherController.php";
include "sites/politics/PoliticsController.php";
include "sites/user/UserController.php";

use sites\footer\FooterController;
use sites\forum\ForumController;
use sites\news\NewsController;
use sites\other\OtherController;
use sites\politics\PoliticsController;
use sites\user\UserController;

class MainController {

	private $request;
	private $template;
	private $footerController;
	private $forumController;
	private $newsController;
	private $userController;
	private $politicsController;
	private $otherController;

	public function __construct($request) {
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
		$this->footerController = new FooterController($request);
		$this->forumController = new ForumController($request);
		$this->newsController = new NewsController($request);
		$this->userController = new UserController($request);
		$this->politicsController = new PoliticsController($request);
		$this->otherController = new OtherController($request);
	}

	public function work() {
		global $footerController;
		global $forumController;
		global $newsController;
		global $userController;
		global $politicsController;
		global $otherController;
		switch ($this->template){
			case 'imprint':
			case 'privacyPolicy':
			case 'termsOfUse':
				return $footerController->work();
			case 'forumOverview':
			case 'createForumPost':
			case 'forumPost':
				return $forumController->work();
			case 'article':
			case 'newsOverview':
				return $newsController->work();
			case 'politics':
			case 'party':
				return $politicsController->work();
			case 'login':
			case 'registration':
			case 'editProfile':
				return $userController->work();
			case 'support':
			case 'tutorial':
			case 'home':
			default:
				return $otherController->work();
		}
	}


}