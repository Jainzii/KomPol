<?php

namespace sites\news\data;

include_once "DBArticleDAO.php";

class NewsModel {

	private $articleDB;
	private $data;

	public function __construct($data) {
		$this->articleDB = new DBArticleDAO();
		$this->data = $data;
	}

	public function getArticles() {
		$articleList = $this->articleDB->getArticles();
		// verify articles
		if (!isset($articleList) || $articleList == null) {
			return [];
		}

		foreach ($articleList as $articleKey => $articleValue) {
			$safeArticle = $articleValue;
			if (!isset($safeArticle["uuid"]) || $safeArticle["uuid"] == null){
				$safeArticle = null;
			} else {
				$title = $safeArticle["title"];
				$safeArticle["title"] = isset($title) && $title !== "" ? $title : "Titel konnte nicht geladen werden.";
				$contentPreview = $safeArticle["contentPreview"];
				$safeArticle["contentPreview"] = isset($contentPreview) && $contentPreview !== "" ? $contentPreview : "Inhalt konnte nicht geladen werden.";
				$picturePath = $safeArticle["picturePath"];
				$safeArticle["picturePath"] = isset($picturePath) && $picturePath !== "" ? $picturePath : "sites/news/media/pictureDummy.png";
			}

			$articleList[$articleKey] = $safeArticle;
		}

		if (!isset($articleList) && $articleList !== []) {
			$_SESSION["errors"]["Article Error"] = "Es gab einen Fehler beim Laden der Artikel.";
		}
		return $articleList;
	}

	public function getArticle($uuid) {
		$article = $this->articleDB->getArticle($uuid);
		$article["title"] = isset($article["title"]) && $article["title"] !== ""? $article["title"]: "Titel konnte nicht geladen werden.";
		$article["content"] = isset($article["content"]) && $article["content"] !== ""? $article["content"]: "Inhalt konnte nicht geladen werden.";
		$article["picturePath"] = isset($article["picturePath"]) && $article["picturePath"] !== ""? $article["picturePath"]: "sites/news/media/pictureDummy.png";

		if (!isset($article)){
			header('Location: '. '?view=newsOverview');
		}
		return $article;
	}

}