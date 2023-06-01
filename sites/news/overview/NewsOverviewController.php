<?php

include "../FileArticleDAO.php";


$articleDAO = new FileArticleDAO();
$articleList = $articleDAO->getArticles();

