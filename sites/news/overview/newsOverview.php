<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../main.css">
  <link rel="stylesheet" type="text/css" href="newsOverview.css">
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
      include "NewsOverviewController.php"
      ?>


      <!-- highlighted article -->
      <?php if(isset($articleList)): ?>
          <?php $article = $articleList[0] ?>
        <article class="highlightedArticle">
          <img
            width="1200"
            height="800"
            src="<?php echo isset($article->picturePath)? $article->picturePath : "../media/pictureDummy.png" ?>"
            alt = "Bild zum Artikel">
          <h2><?php echo isset($article->title)? $article->title : "Nicht vorhanden"; ?></h2>
          <p>
              <?php echo isset($article->contentPreview)? $article->contentPreview : "Nicht gefunden"; ?>
            <a href="../article/article.php?id=<?php echo isset($article->uuid)? $article->uuid : ""; ?>"> mehr lesen...</a>
          </p>
        </article>

      <?php else: ?>
        <h2>Artikel nicht gefunden</h2>
      <?php endif ?>

      <!-- list of other articles -->
      <div class="standardArtikel">
        <?php if(isset($articleList)): ?>
          <?php foreach($articleList as $article): ?>
            <?php if($article !== $articleList[0]): ?>
              <article>
                <img
                  width="300"
                  height="200"
                  src="<?php echo isset($article->picturePath)? $article->picturePath : "../media/pictureDummy.png" ?>"
                  alt = "Bild zum Artikel">
                <h3><?php echo isset($article->title)? $article->title : "Nicht vorhanden"; ?></h3>
                <p>
                  <?php echo isset($article->contentPreview)? $article->contentPreview : "Nicht gefunden"; ?>
                  <a href="../article/article.php?id=<?php echo isset($article->uuid)? $article->uuid : ""; ?>"> mehr lesen...</a>
                </p>
              </article>
            <?php endif ?>
          <?php endforeach; ?>
        <?php else: ?>
          <h2>Artikel nicht gefunden</h2>
        <?php endif ?>
      </div>
    </main>

    <!-- footer -->
    <?php
    include "../../components/footer/footer.php"
    ?>
  </body>
</html>