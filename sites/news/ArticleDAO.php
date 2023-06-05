<?php

namespace news;

interface ArticleDAO
{

	function getArticle($uuid);
	function getArticles();

}