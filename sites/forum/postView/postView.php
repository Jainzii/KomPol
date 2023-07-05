<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../main.css">
  <link rel="stylesheet" type="text/css" href="postView.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>

  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v17.0" nonce="EurVMpmB"></script>

    <!-- header -->
    <?php
    include_once "../../components/header/header.php"
    ?>

    <?php
    include_once "PostViewController.php"
    ?>

    <!-- main content -->
    <main>
      <!-- post and answers -->
      <div class="content">
        <!-- post  -->
        <section class="post">
          <div class="userInfo">
            <img
              width="100"
              height="100"
              src="../../user/media/avatarDummy.png"
              alt = "Avatar">
            <p><?php echo isset($author["firstName"]) ? $author["firstName"] : "" ?></p>
            <p><?php echo isset($author["lastName"]) ? $author["lastName"] : "" ?></p>
          </div>
          <div class="postContent">
            <h2><?php echo isset($post["title"]) ? $post["title"] : "Beitragstitel" ?></h2>
            <p><?php echo isset($post["text"]) ? $post["text"] : "Beitrag konnte leider nicht geladen werden." ?></p>

            <?php if (isset($_SESSION["userId"])):?>
            <form class="rating" action="?id=<?php echo isset($post["uuid"]) ? $post["uuid"] : "" ?>" method="post">
              <input type="hidden" name="ratedComment" value="<?php echo isset($post["uuid"]) ? $post["uuid"] : "" ?>" hidden>
              <input type="submit" name="like" value="<?php echo isset($post["likes"])? $post["likes"] : 0; ?> Likes">
              <input type="submit" name="dislike" value="<?php echo isset($post["dislikes"])? $post["dislikes"] : 0; ?> Dislikes">
            </form>

            <form class="answer" action="?id=<?php echo isset($post["uuid"]) ? $post["uuid"] : "" ?>" method="post">
              <input id="answerTo" type="hidden" name="answerTo" value="<?php echo isset($post["uuid"]) ? $post["uuid"] : "" ?>" hidden>
              <?php if (isset($_GET["openCommentBox"]) && $_GET["openCommentBox"] === $post["uuid"]): ?>
              <label>
                Kommentar verfassen:
                <textarea rows="10" name="comment" required></textarea>
              </label>
              <label hidden class="token">
                Token:
                <input type="text" value="<?php echo isset($csrfToken)? $csrfToken : "" ?>" name="csrfToken">
              </label>
              <input type="submit" name="sendComment" value="Kommentar senden">
              <?php else: ?>
              <input type="submit" name="activateCommentBox" value="Antworten">
              <?php endif; ?>
            </form>

			      <?php else: ?>
            <div class="rating">
              <p><?php echo isset($post["likes"])? $post["likes"] : 0; ?> Likes</p>
              <p><?php echo isset($post["dislikes"])? $post["dislikes"] : 0; ?> Dislikes</p>
            </div>
            <?php endif; ?>
            <div id="shareButtonContainer">
              <div id="jsDependantShareButtonContainer" hidden>
                <!-- Twitter share button -->
                <?php $shortenedTitle = isset($post["title"]) ? $post["title"] : "";
                  $shortenedTitle = strlen($shortenedTitle) > 126 ? substr($shortenedTitle, 0, 126) . "..." : $shortenedTitle
                ?>
                <a href="https://twitter.com/share?ref_src=twsrc%5Etfw"
                   id="twitterShareButton"
                   class="twitter-share-button"
                   data-size="large"
                   data-text="Schau dir den Beitrag von Neu Dorias an: <?php echo $shortenedTitle ?>"
                   data-dtn=true
                   data-hashtags="NeuDorias"
                   data-show-count="false">
                  Teilen!
                </a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

                <!-- Facebook share button -->
                <div class="fb-share-button"
                     id="facebookShareButton"
                     data-href="https://www.neuDorias.de/KomPol/sites/forum/postView/postView.php?id=<?php echo isset($post["uuid"]) ? $post["uuid"] : "" ?>"
                     data-layout="button"
                     data-size="large">
                  <?php $facebookLink = "https://www.facebook.com/sharer/sharer.php?u=" . "https://www.neuDorias.de/KomPol/sites/forum/postView/postView.php?id=" . isset($post["uuid"]) ? $post["uuid"] : "" . "&amp;src=sdkpreparse"?>
                  <a target="_blank"
                     href="<?php echo $facebookLink ?>"
                     class="fb-xfbml-parse-ignore">
                    Teilen
                  </a>
                </div>
              </div>
              <script src="ShareButtons.js"></script>
            </div>

          </div>
        </section>
        <!-- answers  -->
        <section class="comments">
          <h3>Kommentare</h3>
          <?php if(isset($commentList) && $commentList !== [] ): ?>
            <?php createComment($commentList) ?>
          <?php else: ?>
            <h4>Keine Kommentare</h4>
          <?php endif ?>
        </section>
      </div>
      <!-- party opinions -->
      <section class="partyOpinions">
        <h3>Meinung der Parteien</h3>
        <div class="opinionsContainer">
          <img width="32" height="32" src="partyCircle.svg" alt = "Parteikreis">
          <img width="32" height="32" src="partyCircle.svg" alt = "Parteikreis">
          <img width="32" height="32" src="partyCircle.svg" alt = "Parteikreis">
          <img width="32" height="32" src="partyCircle.svg" alt = "Parteikreis">
        </div>
      </section>
    </main>

    <!-- footer -->
    <?php
    include_once "../../components/footer/footer.php"
    ?>
  </body>
</html>