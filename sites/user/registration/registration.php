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


    <!-- main content -->
    <main>
      <h2>Registrieren</h2>
      <form action="registration.php" method="post">
        <label>
          E-Mail:
          <input type="email" name="e-mail" required>
        </label>
        <label>
          Passwort:
          <input type="password" name="passwort" required>
        </label>
        <label>
          Passwort wiederholen:
          <input type="password" name="passwortWiederholung" required>
        </label>
        <label>
          Registrierungscode:
          <input type="text" name="registrierungscode" required>
        </label>
        <input type="submit" value="Registrieren">
        <p>Bereits einen Account? <a href="../login/login.php">Hier anmelden</a></p>
      </form>
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