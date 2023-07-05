<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../main.css">
  <link rel="stylesheet" type="text/css" href="editProfile.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include_once "../../components/header/header.php";
    ?>

    <!-- main content -->
    <main>
        <?php
        include_once "EditProfileController.php";
        ?>

        <!-- change details -->
        <section class="changeDetails">
          <h2>Daten ändern</h2>
          <form action="?changeDetails=1" method="post" enctype="multipart/form-data">
            <img
              id="userAvatar"
              width="100"
              height="100"
              src="<?php echo isset($user["avatar"])? $user["avatar"] : "../media/avatarDummy.png" ?>"
              alt = "Jetziger Avatar">

            <input id="avatarInput"
              type="file"
              name="avatar"
              accept="image/png, image/jpeg">
            <script src="dragAndDropAvatar.js"></script>
              <label>
                  E-Mail:
                  <input type="email" name="email" value="<?php echo isset($user["email"])? $user["email"] : "" ?>" required>
              </label>
              <label>
                  Benutzername:
                  <input type="text" name="username" class="usernameInput" value="<?php echo isset($user["username"])? $user["username"] : "" ?>" required>
                  <script src="../usernameValidation/usernameValidation.js" ></script>
                  <div id="feedbackContainer"></div>
              </label>
            <label>
              Vorname:
              <input type="text" name="firstName" value="<?php echo isset($user["firstName"])? $user["firstName"] : "" ?>" required>
            </label>
            <label>
              Nachname:
              <input type="text" name="lastName" value="<?php echo isset($user["lastName"])? $user["lastName"] : "" ?>" required>
            </label>
            <label hidden>
              Token:
              <input type="text" value="<?php echo isset($csrfToken)? $csrfToken : "" ?>" name="csrfToken">
            </label>
            <input type="submit" value="Daten ändern">
          </form>
        </section>

        <!-- change password -->
        <section class="changePassword">
          <h2>Passwort ändern</h2>
          <form action="?changePassword=1" method="post">
            <label>
              Altes Passwort:
              <input type="password" name="oldPassword" required>
            </label>
            <label>
              Neues Passwort:
              <input type="password" name="newPassword1" required>
            </label>
            <label>
              Neues Passwort wiederholen:
              <input type="password" name="newPassword2" required>
            </label>
            <label hidden>
              Token:
              <input type="text" value="<?php echo isset($csrfToken)? $csrfToken : "" ?>" name="csrfToken">
            </label>
            <input type="submit" value="Passwort ändern">
          </form>
        </section>

    </main>

    <!-- footer -->
    <?php
    include_once "../../components/footer/footer.php"
    ?>
  </body>
</html>