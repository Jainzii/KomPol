<?php

//include "../FilePostDAO.php";
//include "../FileCommentDAO.php";
//include "../../user/FileUserDAO.php";

use posts\DBCommentDAO;
use posts\DBPostDAO;
use user\DBUserDAO;

include_once "../DBPostDAO.php";
include_once "../DBCommentDAO.php";
include_once "../../user/DBUserDAO.php";

if (!isset($_GET["id"])){
    header('Location: '. '../overview/forumOverview.php');
}

$userDAO = new DBUserDAO();
$postDAO = new DBPostDAO();
$commentDAO = new DBCommentDAO();

$post = $postDAO->getPost($_GET["id"]);
$author = $userDAO->loadUserById($post["author"]);
$commentList = $commentDAO->getComments($_GET["id"]);

function createComment($commentList) {
  foreach ($commentList as $comment){
    global $userDAO;
    global $commentDAO;
	  $commenter = $userDAO->loadUserById($comment["author"]);
	// after this next, plain HTML
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
        <p> <?php echo isset($comment["likes"])? count($comment["likes"]) : 0; ?> Likes | <?php echo isset($comment["dislikes"])? count($comment["dislikes"]) : 0; ?> Dislikes</p>
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

