<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../../css/main.css">
  <link rel="stylesheet" type="text/css" href="editProfile.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include "../../components/header/header.php"
    ?>

    <!-- main content -->
    <main>

        <!-- change details -->
        <section class="changeDetails">
          <h2>Daten ändern</h2>
          <form action="profileEdit.php" method="post" enctype="multipart/form-data">
            <img
              width="100"
              height="100"
              src="../media/avatarDummy.png"
              alt = "Jetziger Avatar">

            <input
              type="file"
              name="avatar"
              accept="image/png, image/jpeg">
            <label>
              E-Mail:
              <input type="email" name="e-mail" required>
            </label>
            <label>
              Vorname:
              <input type="text" name="vorname" required>
            </label>
            <label>
              Nachname:
              <input type="text" name="nachname" required>
            </label>
            <input type="submit" value="Daten ändern">
          </form>
        </section>

        <!-- change password -->
        <section class="changePassword">
          <h2>Passwort ändern</h2>
          <form action="profileEdit.php" method="post">
            <label>
              Altes Passwort:
              <input type="password" name="altesPassword" required>
            </label>
            <label>
              Neues Passwort:
              <input type="password" name="neuesPassword" required>
            </label>
            <label>
              Neues Passwort wiederholen:
              <input type="password" name="passwortWiederholen" required>
            </label>
            <input type="submit" value="Passwort ändern">
          </form>
        </section>

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