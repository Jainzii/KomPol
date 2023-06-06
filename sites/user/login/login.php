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
    include_once "../../components/header/header.php"
    ?>

    <?php
    include_once "LoginController.php";
    ?>

    <!-- main content -->
    <main>
      <h2>Anmelden</h2>
      <form action="?login=1" method="post">
        <label>
          E-Mail:
          <input type="email" name="e-mail" value="<?php echo isset($email)? $email : "" ?>" required>
        </label>
        <label>
          Passwort:
          <input type="password" name="passwort" value="<?php echo isset($password)? $password : "" ?>"" required>
        </label>
        <input type="submit" name="submit" value="Anmelden">
        <p>Noch keinen Account? <a href="../registration/registration.php">Hier registrieren</a></p>
      </form>
    </main>

    <!-- footer -->
    <?php
    include_once "../../components/footer/footer.php"
    ?>
  </body>
</html>