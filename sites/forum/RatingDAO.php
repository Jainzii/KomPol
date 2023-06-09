<?php

namespace sites\forum;

interface RatingDAO
{
	function hasLiked($postId,$userId);
	function addLike($postId,$userId);
	function removeLike($postId,$userId);
	function getLikeCount($postId);

	function hasDisliked($postId,$userId);
	function addDislike($postId,$userId);
	function removeDislike($postId,$userId);
	function getDislikeCount($postId);

}