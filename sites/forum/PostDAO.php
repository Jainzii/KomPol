<?php

namespace posts;

interface PostDAO
{

    function addPost($post);
    function updatePost($post);
    function getPost($uuid);
    function getPosts();

}