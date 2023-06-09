<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../main.css">
  <link rel="stylesheet" type="text/css" href="support.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include_once "../../components/header/header.php"
    ?>

    <?php
    include_once "supportController.php"
    ?>

    <!-- main content -->
    <main>
      <h2>Support-Ticket einreichen:</h2>
      <form action="?supportTicket=1" method="post">
        <!-- issue category -->
        <label>
          Anliegen:
          <select name="issue" required>
            <option value="anliegen1">Anliegen 1</option>
            <option value="anliegen2">Anliegen 2</option>
            <option value="anliegen3">Anliegen 3</option>
          </select>
        </label>
        <!-- support ticket  -->
        <label>
          Nachricht:
          <textarea name="text" rows="20" cols="50" required></textarea>
        </label>
        <label hidden class="token">
          Token:
          <input type="text" value="<?php echo isset($csrfToken)? $csrfToken : "" ?>" name="csrfToken">
        </label>
        <input type="submit" value="Nachricht abschicken">
      </form>
    </main>

    <!-- footer -->
    <?php
    include_once "../../components/footer/footer.php"
    ?>
  </body>
</html>