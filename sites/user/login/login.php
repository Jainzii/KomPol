<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../../css/main.css">
  <link rel="stylesheet" type="text/css" href="../authentication.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include "../../components/header/header.php"
    ?>

    <?php
    include "../LoginController.php";
    ?>

    <!-- main content -->
    <main>
      <h2>Anmelden</h2>
      <form action="?login=1" method="post">
        <label>
          E-Mail:
          <input type="email" name="e-mail" value="<?php echo $email ?>" required>
        </label>
        <label>
          Passwort:
          <input type="password" name="passwort" value="<?php echo $password ?>" required>
        </label>
        <input type="submit" value="Anmelden">
        <p>Noch keinen Account? <a href="../registration/registration.php">Hier registrieren</a></p>
      </form>
      <div class="hinweis">
        <p> <a href="../editProfile/editProfile.php"> HIER GEHT ES ZUR PROFIL BEARBEITUNGSSEITE (TEMPORÄR BIS AUTHENTIFIZIERUNG IMPLEMENTIERT IST) </a> </p>
      </div>
    </main>

    <!-- footer -->
    <?php
    include "../../components/footer/footer.php"
    ?>
  </body>
</html>