<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../main.css">
  <link rel="stylesheet" type="text/css" href="party.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include "../../components/header/header.php"
    ?>

    <?php
	  include "PartyController.php";
    ?>
    <!-- main content -->
    <main>
      <div class="partyInfo">
        <img width="300" height="200" src="<?php echo isset($party["logo"])? $party["logo"] : "../media/partyDummy.png"; ?>" alt = "Partei-Bild">
        <h2><?php echo isset($party["name"])? $party["name"] : "Parteiname"; ?></h2>
        <p><?php echo isset($party["text"])? $party["text"] : "Parteitext konnte nicht geladen werden."; ?></p>
      </div>
    </main>

    <!-- footer -->
    <?php
    include "../../components/footer/footer.php"
    ?>
  </body>
</html>