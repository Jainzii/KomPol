<?php

include "../FilePostDAO.php";
include "../../user/FileUserDAO.php";

if (!isset($_SESSION["userId"])){
    header('Location: '. '../overview/forumOverview.php');
}

if (isset($_GET["postCreation"])) {
    $title = isset($_POST["title"]) ? $_POST["title"] : "";
    $category = isset($_POST["category"]) ? $_POST["category"] : "";
    $content = isset($_POST["content"]) ? $_POST["content"] : "";
    submitForumPost($_POST["title"], $_POST["category"], $_POST["content"]);
}

function submitForumPost($title, $category, $content ) {


    $userDAO = new FileUserDAO("../../user/");
    $user = $userDAO->loadUserById($_SESSION["userId"]);

    $postDAO = new FilePostDAO();

    $post = [];
    $post["uuid"] = uniqid("p_",true);
    $post["title"] = $title;
    $post["text"] = $content;
    $post["likes"] = [];
    $post["dislikes"] = [];
    $post["date"] = date("d-m-Y");
    $post["author"] = $user->uuid;
    $post["category"] = $category;

    $postDAO->addPost($post);
    header('Location: '. '../overview/forumOverview.php');
}