<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../main.css">
  <link rel="stylesheet" type="text/css" href="../authentication.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include_once "../../components/header/header.php"
    ?>

    <?php
    include_once "RegisterController.php";
    ?>

    <!-- main content -->
    <main>
      <h2>Registrieren</h2>
      <form action="?registration=1" method="post">
        <label>
          Benutzername:
          <input class="usernameInput" type="text" name="username" required>
            <script src="../usernameValidation/usernameValidation.js" ></script>
          <div id="feedbackContainer"></div>
        </label>
        <label>
          E-Mail:
          <input type="email" name="email" id="registrationEmail" required>
        </label>
        <label>
          Passwort:
          <input type="password" name="password1" id="registrationPassword" required>
        </label>
        <label>
          Passwort wiederholen:
          <input type="password" name="password2" id="registrationPasswordRepeat" required>
        </label>
        <label>
          Registrierungscode:
          <input type="text" name="registrationCode" id="registrationCode">
        </label>
        <input type="submit" name="submit" id="registerButton" value="Registrieren" disabled>
        <p>Bereits einen Account? <a href="../login/login.php">Hier anmelden</a></p>
      </form>
    </main>
    <script src="validation/script.js"></script>

    <!-- footer -->
    <?php
    include_once "../../components/footer/footer.php"
    ?>
  </body>
</html>