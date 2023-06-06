<?php

include_once "CommentDAO.php";
use posts\CommentDAO;

class FileCommentDAO implements CommentDAO
{
    function addComment($comment){
        $json = file_get_contents("../comment.json");
        $commentList =  json_decode($json);
        $commentList[] = $comment;
        file_put_contents("../comment.json", json_encode($commentList));
    }
    function updateComment($comment){
        $json = file_get_contents("../comment.json");
        $commentList =  json_decode($json);
        $commentList = isset($commentList) ? $commentList : [];
        foreach ($commentList as $oldComment) {
            if ($oldComment->uuid === $comment->uuid) {
                $oldComment->text = $comment->text;
                $oldComment->likes = $comment->likes;
                $oldComment->dislikes = $comment->dislikes;
            }
        }
				file_put_contents("../comment.json", json_encode($commentList));
    }
    function getComments($answerTo){
        $json = file_get_contents("../comment.json");
        $commentList =  json_decode($json);
        $commentList = isset($commentList) ? $commentList : [];
        $resultList = [];
        foreach ($commentList as $comment) {
            if ($comment->answerTo === $answerTo) {
                $resultList[] = $comment;
            }
        }
        return $resultList;
    }
}