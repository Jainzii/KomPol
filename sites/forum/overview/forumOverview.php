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
      <!-- search -->
      <section>
        <form action="forumSearch.php" method="get">
          <div class="formOptions">
            <label class="userInput">
              Titel:
              <input type="text" name="name">
            </label>
            <label class="userInput">
              Vor:
              <input type="date" name="vor">
            </label>
            <label class="userInput">
              Nach:
              <input type="date" name="nach">
            </label>
            <label class="userInput">
              Kategorie:
              <select name="kategorie">
                <option value="kommentar">Kommentar</option>
                <option value="nachricht">Nachricht</option>
                <option value="initiative">Initiative</option>
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
      <article>
        <div class="post">
          <p class="category">Kategoriegrößerheheh</p>
          <div class="postContent">
            <a href="../postView/postView.php">
              <h2>Titel des ersten Forumbeitrags</h2>
            </a>
            <p>Vorschau des Forumbeitragstexts</p>
          </div>
          <p>XXXX Likes | XXXX Dislikes</p>
        </div>
      </article>
      <!-- second example forum post -->
      <article>
        <div class="post">
          <p class="category">Kategorie</p>
          <div class="postContent">
            <a href="../postView/postView.php"> <h2>Titel des zweiten Forumbeitrags</h2> </a>
            <p>Vorschau des Forumbeitragstexts</p>
          </div>
          <p>XXXX Likes | XXXX Dislikes</p>
        </div>
      </article>
    </main>

    <!-- footer -->
    <footer>
      <nav>
        <a href="../../footer/imprint/imprint.php"> Impressum </a>
        <a href="../../footer/privacyPolicy/privacyPolicy.php"> Datenschutz </a>
        <a href="../../footer/termsOfUse/termsOfUse.php"> Nutzungsbedingungen </a>
        <a href="../../other/support/support.php"> Support </a>
      </nav>
    </footer>
  </body>
</html>