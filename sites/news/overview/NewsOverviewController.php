<?php

//include_once "../FileArticleDAO.php";
include_once "../DBArticleDAO.php";

use news\DBArticleDAO;


$articleDAO = new DBArticleDAO();
$articleList = $articleDAO->getArticles();
