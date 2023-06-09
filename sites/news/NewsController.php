<?php

namespace sites\news;

use View;

class NewsController {

	private $request;
	private $template;

	public function __construct($request) {
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
	}

	public function work() {
		$view = new View();
		switch ($this->template){
			case 'article':
				$view->setTemplate("sites/news/article/article.php");
				break;
			case 'newsOverview':
				$view->setTemplate("sites/news/overview/newsOverview.php");
				break;
		}
		return $view->loadTemplate();
	}

}