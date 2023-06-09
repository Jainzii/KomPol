<?php

namespace sites\forum;

interface CommentDAO
{
    function addComment($comment);
    //function updateComment($comment);
    function getComments($answerTo);
}