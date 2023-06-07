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

if (!isset($post)) {
	header('Location: '. '../overview/forumOverview.php');
}

if (isset($_POST["like"])) {
  $userId = $_SESSION["userId"];
  $postId = $_POST["ratedComment"];
  if ($ratingDAO->hasDisliked($postId,$userId)){
    $ratingDAO->removeDislike($postId,$userId);
  }
	$ratingDAO->hasLiked($postId,$userId)? $ratingDAO->removeLike($postId,$userId) : $ratingDAO->addLike($postId,$userId);
}

if (isset($_POST["dislike"])) {
	$userId = $_SESSION["userId"];
	$postId = $_POST["ratedComment"];
	if ($ratingDAO->hasLiked($postId,$userId)){
		$ratingDAO->removeLike($postId,$userId);
	}
  $ratingDAO->hasDisliked($postId,$userId)? $ratingDAO->removeDislike($postId,$userId) : $ratingDAO->addDislike($postId,$userId);
}

if (isset($_POST["activateCommentBox"])) {
	$_GET["openCommentBox"] = $_POST["answerTo"];
}

if (isset($_POST["sendComment"])) {
	$commentContent = $_POST["comment"];
	$postId = $_POST["answerTo"];
  $userId = $_SESSION["userId"];
  $commentId = uniqid("c_", true);

  if (isset($userId) && isset($postId) && isset($commentContent)) {
    $comment["text"] = htmlentities($commentContent);
	  $comment["answerTo"] = $postId;
	  $comment["author"] = $userId;
	  $comment["uuid"] = $commentId;

	  $commentDAO->addComment($comment);
  }
	unset($_GET["openCommentBox"]);
}

$commentList = $commentDAO->getComments($_GET["id"]);

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
		  <?php if (isset($_SESSION["userId"])):?>
        <form class="rating" action="?id=<?php echo isset($_GET["id"]) ? $_GET["id"] : "" ?>" method="post">
          <input type="text" name="ratedComment" value="<?php echo isset($comment["uuid"]) ? $comment["uuid"] : "" ?>" hidden>
          <input type="submit" name="like" value="<?php echo isset($comment["likes"])? $comment["likes"] : 0; ?> Likes">
          <input type="submit" name="dislike" value="<?php echo isset($comment["dislikes"])? $comment["dislikes"] : 0; ?> Dislikes">
        </form>

        <form class="answer" action="?id=<?php echo isset($_GET["id"]) ? $_GET["id"] : "" ?>" method="post">
          <input type="text" name="answerTo" value="<?php echo isset($comment["uuid"]) ? $comment["uuid"] : "" ?>" hidden>
				<?php if (isset($_GET["openCommentBox"]) && $_GET["openCommentBox"] === $comment["uuid"]): ?>
          <label>
            Kommentar erfassen:
            <textarea rows="10" name="comment" required></textarea>
          </label>
          <input type="submit" name="sendComment" value="Kommentar senden">
        <?php else: ?>
          <input type="submit" name="activateCommentBox" value="Antworten">
				<?php endif; ?>
        </form>
		  <?php else: ?>
        <div class="rating">
          <p><?php echo isset($comment["likes"])? $comment["likes"] : 0; ?> Likes</p>
          <p><?php echo isset($comment["dislikes"])? $comment["dislikes"] : 0; ?> Dislikes</p>
        </div>
		  <?php endif; ?>
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

