<?php

namespace sites\news\data;

interface ArticleDAO
{

	function getArticle($uuid);
	function getArticles();

}