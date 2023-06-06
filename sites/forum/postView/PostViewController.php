<?php

//include_once "../FilePostDAO.php";
//include_once "../FileCommentDAO.php";
//include_once "../../user/FileUserDAO.php";

use posts\DBCommentDAO;
use posts\DBPostDAO;
use posts\DBRatingDAO;
use user\DBUserDAO;

include_once "../DBPostDAO.php";
include_once "../DBCommentDAO.php";
include_once "../../user/DBUserDAO.php";
include_once "../DBRatingDAO.php";

if (!isset($_GET["id"])){
    header('Location: '. '../overview/forumOverview.php');
}

$userDAO = new DBUserDAO();
$postDAO = new DBPostDAO();
$commentDAO = new DBCommentDAO();
$ratingDAO = new DBRatingDAO();

$post = $postDAO->getPost($_GET["id"]);
$author = $userDAO->loadUserById($post["author"]);
$commentList = $commentDAO->getComments($_GET["id"]);

if (!isset($post)) {
	header('Location: '. '../overview/forumOverview.php');
}

$post["likes"] = $ratingDAO->getLikeCount($post["uuid"]);
$post["dislikes"] = $ratingDAO->getDislikeCount($post["uuid"]);

function createComment($commentList) {
  global $userDAO;
  global $commentDAO;
  global $ratingDAO;
  foreach ($commentList as $comment){
      $comment["likes"] = $ratingDAO->getLikeCount($comment["uuid"]);
      $comment["dislikes"] = $ratingDAO->getDislikeCount($comment["uuid"]);
	  $commenter = $userDAO->loadUserById($comment["author"]);
	?>

  <div class="comment">
    <div class="commentContent">
      <div class="userInfo">
        <img
          width="100"
          height="100"
          src="../../user/media/avatarDummy.png"
          alt = "Avatar">
        <p><?php echo isset($commenter["firstName"]) ? $commenter["firstName"] : "" ?></p>
        <p><?php echo isset($commenter["lastName"]) ? $commenter["lastName"] : "" ?></p>
      </div>
      <div class="postContent">
        <p><?php echo isset($comment["text"]) ? $comment["text"] : "" ?></p>
        <p> <?php echo isset($comment["likes"])? $comment["likes"] : 0; ?> Likes | <?php echo isset($comment["dislikes"])? $comment["dislikes"] : 0; ?> Dislikes</p>
        <button> Antworten </button>
      </div>
    </div>
	  <?php
    $newCommentList = $commentDAO->getComments($comment["uuid"]);
    createComment($newCommentList);
    ?>
  </div>

	<?php
  }
}


?>

