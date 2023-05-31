<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../../css/main.css">
  <link rel="stylesheet" type="text/css" href="support.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include "../../components/header/header.php"
    ?>


    <!-- main content -->
    <main>
      <h2>Support-Ticket einreichen:</h2>
      <form action="supportTicket.php" method="post">
        <!-- issue category -->
        <label>
          Anliegen:
          <select name="anliegen" required>
            <option value="anliegen1">Anliegen 1</option>
            <option value="anliegen2">Anliegen 2</option>
            <option value="anliegen3">Anliegen 3</option>
          </select>
        </label>
        <!-- support ticket  -->
        <label>
          Nachricht:
          <textarea name="nachricht" rows="20" cols="50" required></textarea>
        </label>
        <input type="submit" value="Nachricht abschicken">
      </form>
    </main>

    <!-- footer -->
    <?php
    include "../../components/footer/footer.php"
    ?>
  </body>
</html>