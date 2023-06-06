<?php

use news\DBArticleDAO;

include_once "../DBArticleDAO.php";

if (!isset($_GET["id"])){
    header('Location: '. '../overview/newsOverview.php');
}

$articleDAO = new DBArticleDAO();
$article = $articleDAO->getArticle($_GET["id"]);

if (!isset($article)){
	header('Location: '. '../overview/newsOverview.php');
}

