<?php

namespace sites\news;

include_once "sites/news/data/NewsModel.php";

use sites\news\data\NewsModel;
use View;

class NewsController {

	private $request;
	private $template;
	private $newsModel;

	public function __construct($request) {
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
		$this->newsModel = new NewsModel($request);
	}

	public function work() {
		$view = new View();
		switch ($this->template){
			case 'article':
				$articleId = $this->request['id'];
				$article = $this->newsModel->getArticle($articleId);
				$view->assign("title", $article["title"]);
				$view->assign("content", $article["content"]);
				$view->assign("picturePath", $article["picturePath"]);

				$view->addStylesheet("sites/news/article/article.css");
				$view->setTemplate("sites/news/article/article.php");


				break;
			case 'newsOverview':
				$articleList = $this->newsModel->getArticles();
				$firstArticle = array_shift($articleList);

				$view->assign("showHighlightedArticle", isset($firstArticle) && $articleList !== null);
				$view->assign("firstArticle", $firstArticle);
				$view->assign("articleList", $articleList);
				$view->addStylesheet("sites/news/overview/newsOverview.css");
				$view->setTemplate("sites/news/overview/newsOverview.php");
				break;
		}
		return $view->loadTemplate();
	}

}