<?php

namespace sites\news;

interface ArticleDAO
{

	function getArticle($uuid);
	function getArticles();

}