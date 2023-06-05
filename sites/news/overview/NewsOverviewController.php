<?php

//include "../FileArticleDAO.php";
include "../DBArticleDAO.php";

use news\DBArticleDAO;


$articleDAO = new DBArticleDAO();
$articleList = $articleDAO->getArticles();
