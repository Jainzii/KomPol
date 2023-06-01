<?php

include "../FileArticleDAO.php";

if (!isset($_GET["id"])){
    header('Location: '. '../overview/newsOverview.php');
}

$articleDAO = new FileArticleDAO();
$article = $articleDAO->getArticle($_GET["id"]);

