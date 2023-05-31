<?php
include "FilePostDAO.php";

class FilePostDAO implements PostDAO
{
    function addPost($post){
        $json = file_get_contents("../user.json");
        $postList =  json_decode($json);
        $postList[count($postList)] = $post;
        file_put_contents("../user.json", json_encode($postList));
    }

    function updatePost($post){
        $json = file_get_contents("../user.json");
        $postList =  json_decode($json);
        $postList = isset($postList) ? $postList : [];
        foreach ($postList as $oldPost) {
            if ($oldPost->uuid === $post->uuid) {
                $oldPost->text = $post->text;
                $oldPost->titel = $post->titel;
                $oldPost->category = $post->category;
                $oldPost->likes = $post->likes;
                $oldPost->dislikes = $post->dislikes;
                $oldPost->date = $post->date;
                $oldPost->author = $post->author;
            }
        }
    }

    function getPost($uuid){
        $json = file_get_contents("../user.json");
        $postList =  json_decode($json);
        $postList = isset($postList) ? $postList : [];
        foreach ($postList as $post) {
            if ($post->uuid == $uuid) {
                return $post;
            }
        }
        return null;
    }

    function getPosts($uuid){
        $json = file_get_contents("../user.json");
        $postList =  json_decode($json);
        return isset($postList) ? $postList : [];
    }

}