<?php

//include_once "../FilePostDAO.php";
include_once "../DBPostDAO.php";

//use posts\FilePostDAO;
use posts\DBPostDAO;

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

    $postDAO = new DBPostDAO();

    $post = [];
    $post["uuid"] = uniqid("p_",true);
    $post["title"] = $title;
    $post["text"] = $content;
    $post["likes"] = [];
    $post["dislikes"] = [];
    $post["date"] = date("d-m-Y");
    $post["author"] = $_SESSION["userId"];
    $post["category"] = $category;

    if ($postDAO->addPost($post)){
		header('Location: '. '../postView/postView.php?id=' . urlencode($post["uuid"]));
	} else {
		// Fehlermeldung
	}
}