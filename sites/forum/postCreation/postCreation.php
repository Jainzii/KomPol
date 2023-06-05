<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../main.css">
  <link rel="stylesheet" type="text/css" href="postCreation.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include "../../components/header/header.php"
    ?>

    <?php
    include "PostCreationController.php"
    ?>

    <!-- main content -->
    <main>
      <h2>Beitrag verfassen:</h2>
      <form action="?postCreation=1" method="post">
        <label>
          Kategorie:
          <select name="category" required>
            <option value="kommentar">Kommentar</option>
            <option value="initiative">Initiative</option>
          </select>
        </label>
        <label>
          Titel:
          <input type="text" name="title" required>
        </label>
        <label>
          Beitrag:
          <textarea name="content" rows="20" cols="50" required></textarea>
        </label>
        <input type="submit" value="Beitrag erstellen">
      </form>
    </main>

    <!-- footer -->
    <?php
    include "../../components/footer/footer.php"
    ?>
  </body>
</html>