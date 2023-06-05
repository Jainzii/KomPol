<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../main.css">
  <link rel="stylesheet" type="text/css" href="../authentication.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include "../../components/header/header.php"
    ?>

    <?php
    include "RegisterController.php";
    ?>

    <!-- main content -->
    <main>
      <h2>Registrieren</h2>
      <form action="?registration=1" method="post">
        <label>
          E-Mail:
          <input type="email" name="email" required>
        </label>
        <label>
          Passwort:
          <input type="password" name="password1" required>
        </label>
        <label>
          Passwort wiederholen:
          <input type="password" name="password2" required>
        </label>
        <label>
          Registrierungscode:
          <input type="text" name="registrationCode">
        </label>
        <input type="submit" name="submit" value="Registrieren">
        <p>Bereits einen Account? <a href="../login/login.php">Hier anmelden</a></p>
      </form>
    </main>

    <!-- footer -->
    <?php
    include "../../components/footer/footer.php"
    ?>
  </body>
</html>