<?php
//include_once "../FilePostDAO.php";
include_once "../DBPostDAO.php";
include_once "../DBRatingDAO.php";
include_once "../DBRatingDAO.php";
include_once "../../components/error/ErrorController.php";

//use posts\FilePostDAO;
use posts\DBPostDAO;
use posts\DBRatingDAO;

$errorController = new ErrorController();

$postDAO = new DBPostDAO();
$postList = $postDAO->getPosts();
if (!isset($postList)) {
    $errorController->addErrorMessage("PostListEmpty","Es gab einen Fehler beim Aufrufen der Forumsbeiträge");
}

$searchActive = isset($_GET["vor"]) || isset($_GET["nach"]) || isset($_GET["kategorie"]) || isset($_GET["name"]);

if ($searchActive && !$errorController->hasErrors()) {
    $postList = isset($_GET["vor"]) && $_GET["vor"] !== ""  ? array_filter($postList, function ($post){
        return strtotime($post["date"]) <= strtotime($_GET["vor"]);
    }) : $postList;

    $postList = isset($_GET["nach"]) && $_GET["nach"] !== ""  ? array_filter($postList, function ($post){
        return strtotime($post["date"]) >= strtotime($_GET["nach"]);
    }) : $postList;

    $postList = isset($_GET["kategorie"]) && $_GET["kategorie"] !== "" ? array_filter($postList, function ($post){
        return $post["category"] === $_GET["kategorie"];
    }) : $postList;

    $postList = isset($_GET["name"]) && $_GET["name"] !== "" ? array_filter($postList, function ($post){
        $pos = strpos(strtoupper($post["title"]), strtoupper($_GET["name"]));
        return is_int($pos);
    }) : $postList;
    unset($_GET["search"]);
}

$ratingDAO = new DBRatingDAO();
$postList = array_slice($postList, 0, 20);

foreach ($postList as $postKey => $postValue) {
    $newPost = $postValue;
    $newPost["title"] = htmlentities($newPost["title"]);
    $newPost["text"] = htmlentities($newPost["text"]);
    $newPost["likes"] = $ratingDAO->getLikeCount($postValue["uuid"]);
    if (!isset($newPost["likes"])) {
        $newPost["likes"] = 0;
        $errorController->addErrorMessage("RatingListEmpty","Es einen Fehler beim laden von manchen Bewertungen");
    }
    $newPost["dislikes"] = $ratingDAO->getDislikeCount($postValue["uuid"]);
    if (!isset($newPost["dislikes"])) {
        $newPost["dislikes"] = 0;
        $errorController->addErrorMessage("RatingListEmpty","Es einen Fehler beim laden von manchen Bewertungen");
    }
    $postList[$postKey] = $newPost;
}

if ($errorController->hasErrors()) {
    echo $errorController->showErrorBox();
}

?>
