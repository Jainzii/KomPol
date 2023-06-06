<?php

namespace posts;

interface CommentDAO
{
    function addComment($comment);
    //function updateComment($comment);
    function getComments($answerTo);
}