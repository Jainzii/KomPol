<main>
  <!-- highlighted article -->
  <?php if($this->data["showHighlightedArticle"]): ?>
    <article class="highlightedArticle">
      <img
        width="1200"
        height="800"
        src="<?php echo $this->data["firstArticle"]["picturePath"] ?>"
        alt = "Bild zum Artikel">
      <h2><?php echo $this->data["firstArticle"]["title"] ?></h2>
      <p>
		  <?php echo $this->data["firstArticle"]["contentPreview"] ?>
        <a href="?view=article&id=<?php echo $this->data["firstArticle"]["uuid"] ?>"> mehr lesen...</a>
      </p>
    </article>
  <?php else: ?>
    <h2>Es konnten keine Artikel geladen werden</h2>
  <?php endif ?>

  <!-- list of other articles -->
  <div class="standardArtikel">
    <?php foreach($this->data["articleList"] as $article): ?>
      <article>
        <img
          width="300"
          height="200"
          src="<?php echo $article["picturePath"] ?>"
          alt = "Bild zum Artikel">
        <h3><?php echo $article["title"] ?></h3>
        <p>
			    <?php echo $article["contentPreview"] ?>
          <a href="?view=article&id=<?php echo $article["uuid"] ?>"> mehr lesen...</a>
        </p>
      </article>
    <?php endforeach; ?>
  </div>
</main>