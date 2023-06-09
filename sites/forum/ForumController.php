<?php

namespace sites\forum;

use View;

class ForumController {

	private $request;
	private $template;

	public function __construct($request) {
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
	}

	public function work() {
		$view = new View();
		switch ($this->template){
			case 'forumOverview':
				$view->setTemplate("sites/forum/overview/forumOverview.php");
				break;
			case 'createForumPost':
				$view->setTemplate("sites/forum/postCreation/postCreation.php");
				break;
			case 'forumPost':
				$view->setTemplate("sites/forum/postView/postView.php");
				break;
		}
		return $view->loadTemplate();
	}

}