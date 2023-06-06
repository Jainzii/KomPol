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
      <div>
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
            <p><?php echo isset($post["likes"])? count($post["likes"]) : 0; ?> Likes | <?php echo isset($post["dislikes"])? count($post["dislikes"]) : 0; ?> Dislikes</p>
            <button>Antworten</button>
          </div>
        </section>
        <!-- answers  -->
        <section class="comments">
          <h3>Kommentare</h3>
          <?php if(isset($commentList) && $commentList !== [] ): ?>
            <?php foreach ($commentList as $comment) echo $comment["uuid"] ?>
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