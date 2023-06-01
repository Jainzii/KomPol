<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../../css/main.css">
  <link rel="stylesheet" type="text/css" href="forumOverview.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include "../../components/header/header.php"
    ?>

    <!-- main content -->
    <main>
      <?php
      include "ForumOverviewController.php"
      ?>
      <!-- search -->
      <section>
        <form action="?search=1" method="get">
          <div class="formOptions">
            <label>

              <input type="checkbox" checked hidden>
            </label>
            <label class="userInput">
              Titel:
              <input type="text" name="name" value="<?php echo isset($_GET["name"])? $_GET["name"] : ""?>">
            </label>
            <label class="userInput">
              Vor:
              <input type="date" name="vor" value="<?php echo isset($_GET["vor"])? $_GET["vor"] : ""?>">
            </label>
            <label class="userInput">
              Nach:
              <input type="date" name="nach" value="<?php echo isset($_GET["nach"])? $_GET["nach"] : ""?>">
            </label>
            <label class="userInput">
              Kategorie:
              <select name="kategorie">
                  <?php $_GET["kategorie"] = isset($_GET["kategorie"])? $_GET["kategorie"] : ""?>
                <option value="" <?php echo $_GET["kategorie"] === "" ? "selected": "" ?>>Beliebig</option>
                <option value="kommentar" <?php echo $_GET["kategorie"] === "kommentar" ? "selected": "" ?>>Kommentar</option>
                <option value="nachricht" <?php echo $_GET["kategorie"] === "nachricht" ? "selected": "" ?>>Nachricht</option>
                <option value="initiative" <?php echo $_GET["kategorie"] === "initiative" ? "selected": "" ?>>Initiative</option>
              </select>
            </label>
          </div>
          <input type="submit" value="Suche">
        </form>
        <a href="../postCreation/postCreation.php">
          <img src="../../../images/site/plusSign.svg" alt="plus sign" width="16" height="16">
          Beitrag erstellen
        </a>
      </section>
      <!-- first example forum post -->
      <?php if(isset($postList)): ?>
        <?php foreach($postList as $post): ?>
          <article>
            <div class="post">
              <p class="category"><?php echo isset($post->category)? $post->category : "Kommentar"; ?></p>
              <div class="postContent">
                <a href="../postView/postView.php?id=<?php echo isset($post->uuid)? $post->uuid : ""; ?>">
                  <h2><?php echo isset($post->title)? $post->title : "Nicht vorhanden"; ?></h2>
                </a>
                <p><?php echo isset($post->text)? $post->text : "Der Text konnte aufgrund technischer Probleme nicht geladen werden."; ?></p>
              </div>
              <p><?php echo isset($post->likes)? count($post->likes) : 0; ?> Likes | <?php echo isset($post->dislikes)? count($post->dislikes) : 0; ?> Dislikes</p>
            </div>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <h2>Keine Forumsbeiträge vorhanden</h2>
      <?php endif ?>
    </main>

    <!-- footer -->
    <?php
    include "../../components/footer/footer.php"
    ?>
  </body>
</html>