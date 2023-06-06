<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../main.css">
  <link rel="stylesheet" type="text/css" href="article.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include_once "../../components/header/header.php"
    ?>

    <!-- main content -->
    <?php
    include_once "ArticleController.php"
    ?>

    <main>
      <?php if(isset($article)): ?>
        <div class="mainBox">
          <img
            width="600"
            height="400"
            src="<?php echo isset($article["picturePath"])? $article["picturePath"] : "../media/pictureDummy.png" ?>"
            alt = "Bild zum Artikel">
          <h2><?php echo isset($article["title"])? $article["title"] : "Nicht vorhanden"; ?></h2>
          <p>
              <?php echo isset($article["content"])? $article["content"] : "Nicht gefunden"; ?>
          </p>
        </div>
	  <?php else: ?>
        <h2>Artikel nicht gefunden</h2>
	  <?php endif ?>
    </main>

    <!-- footer -->
    <?php
    include_once "../../components/footer/footer.php"
    ?>
  </body>
</html>