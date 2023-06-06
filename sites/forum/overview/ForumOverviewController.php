<?php
//include_once "../FilePostDAO.php";
include_once "../DBPostDAO.php";
include_once "../DBRatingDAO.php";

//use posts\FilePostDAO;
use posts\DBPostDAO;
use posts\DBRatingDAO;

$postDAO = new DBPostDAO();
$postList = $postDAO->getPosts();

$searchActive = isset($_GET["vor"]) || isset($_GET["nach"]) || isset($_GET["kategorie"]) || isset($_GET["name"]);

if ($searchActive) {
    $postList = $postDAO->getPosts();

    $postList = isset($_GET["vor"]) && $_GET["vor"] !== ""  ? array_filter($postList, function ($post){
        return strtotime($post->date) <= strtotime($_GET["vor"]);
    }) : $postList;

    $postList = isset($_GET["nach"]) && $_GET["nach"] !== ""  ? array_filter($postList, function ($post){
        return strtotime($post->date) >= strtotime($_GET["nach"]);
    }) : $postList;

    $postList = isset($_GET["kategorie"]) && $_GET["kategorie"] !== "" ? array_filter($postList, function ($post){
        return $post->category === $_GET["kategorie"];
    }) : $postList;

    $postList = isset($_GET["name"]) && $_GET["name"] !== "" ? array_filter($postList, function ($post){
        $pos = strpos(strtoupper($post->title), strtoupper($_GET["name"]));
        return is_int($pos);
    }) : $postList;
    unset($_GET["search"]);
}

$postList = array_slice($postList, 0, 20);

?>
