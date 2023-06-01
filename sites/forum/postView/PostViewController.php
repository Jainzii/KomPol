<?php

include "../FilePostDAO.php";
include "../FileCommentDAO.php";
include "../../user/FileUserDAO.php";

if (!isset($_GET["id"])){
    header('Location: '. '../overview/forumOverview.php');
}

$userDAO = new FileUserDAO("../../user/");
$postDAO = new FilePostDAO();
$commentDAO = new FileCommentDAO();

$post = $postDAO->getPost($_GET["id"]);
$author = $userDAO->loadUserById($post->author);
$commentList = $commentDAO->getComments($_GET["id"]);

function test($commentList) {
  echo "Hallo";
}

function createComment($commentList) {
  foreach ($commentList as $comment){
    global $userDAO;
    global $commentDAO;
	  $commenter = $userDAO->loadUserById($comment->author);
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
        <p><?php echo isset($commenter->firstName) ? $commenter->firstName : "" ?></p>
        <p><?php echo isset($commenter->lastName) ? $commenter->lastName : "" ?></p>
      </div>
      <div class="postContent">
        <p><?php echo isset($comment->text) ? $comment->text : "" ?></p>
        <p> <?php echo isset($comment->likes)? count($comment->likes) : 0; ?> Likes | <?php echo isset($comment->dislikes)? count($comment->dislikes) : 0; ?> Dislikes</p>
        <button> Antworten </button>
      </div>
    </div>
	  <?php
    $newCommentList = $commentDAO->getComments($comment->uuid);
    createComment($newCommentList);
    ?>
  </div>

	<?php
  }// back to PHP
	// .. some more PHP stuff
	return;
}

function createComments($commentList) {
  global $userDAO;
  echo "eins";
  ob_start(); ?>
  <?php foreach($commentList as $comment): ?>
    <?php
    echo isset($userDAO) ? "Hallo" : "Bruh";
		echo "eins";
    $commenter = $userDAO->loadUserById($comment->author);
    if (isset($commenter)):
    ?>
    <div class="comment">
      <div class="commentContent">
        <div class="userInfo">
          <img
            width="100"
            height="100"
            src="../../user/media/avatarDummy.png"
            alt = "Avatar">
          <p><?php echo isset($commenter->firstName) ? $commenter->firstName : "" ?></p>
          <p><?php echo isset($commenter->firstName) ? $commenter->firstName : "" ?></p>
        </div>
        <div class="postContent">
          <p><?php echo isset($comment->text) ? $comment->text : "" ?></p>
          <p> <?php echo isset($comment->likes)? count($comment->likes) : 0; ?> Likes | <?php echo isset($comment->dislikes)? count($comment->dislikes) : 0; ?> Dislikes</p>
          <button> Antworten </button>
        </div>
      </div>
    </div>
    <?php

    ?>
    <?php endif; ?>
  <?php endforeach; ?>
  <?php

  return ob_get_clean();
} ?>

