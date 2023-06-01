<?php

include "ArticleDAO.php";

class FileArticleDAO implements ArticleDAO
{

    function getArticle($uuid) {
        $json = file_get_contents("../article.json");
        $articleList =  json_decode($json);
        $articleList = isset($articleList) ? $articleList : [];
        foreach ($articleList as $article) {
            if ($article->uuid == $uuid) {
                return $article;
            }
        }
        return null;
    }

    function getArticles() {
        $json = file_get_contents("../article.json");
        $articleList =  json_decode($json);
        return isset($articleList) ? $articleList : [];
    }

}