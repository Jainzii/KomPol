<?php

//include_once "../FileArticleDAO.php";
include_once "../DBArticleDAO.php";
include_once "../../components/error/ErrorController.php";

use news\DBArticleDAO;

$errorController = new ErrorController();

$articleDAO = new DBArticleDAO();
$articleList = $articleDAO->getArticles();
if (!isset($articleList)) {
	$errorController->addErrorMessage("NoArticlesFound", "Es gab einen Fehler beim Laden der Artikel.");
}

if ($errorController->hasErrors()) {
	echo $errorController->showErrorBox();
}
