<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../main.css">
  <link rel="stylesheet" type="text/css" href="politicsOverview.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include_once "../../components/header/header.php"
    ?>

    <?php
    include_once "PoliticsOverviewController.php";
    ?>

    <!-- main content -->
    <main>
      <!-- container for parliament and party information -->
      <section class="parties">
        <h2>Aktuelles Parlament</h2>
        <!-- parliament -->
        <section class="parliament">
          <h3>Sitzverteilung</h3>
          <img width="300" height="200" src="../../other/tutorial/pictureDummy.png" alt="Bild zur Sitzverteilung des Parlaments">
        </section>
        <!-- parties -->

      </section>
      <section class="partyOverviewContainer">
        <?php if (isset($partyList)): ?>
          <?php foreach ($partyList as $party): ?>
            <section class="partyEntry">
              <img width="150" height="100" src="<?php echo isset($party["logo"])? $party["logo"] : "../media/partyDummy.png"; ?>" alt="Bild von <?php echo isset($party["name"])? $party["name"] : "Partei"; ?>">
              <h3><?php echo isset($party["name"])? $party["name"] : "Partei"; ?></h3>
              <p>
				        <?php echo isset($party["textPreview"])? $party["textPreview"] : "Parteitext konnte nicht geladen werden"; ?>
                <a href="../party/party.php?name=<?php echo isset($party["name"])? $party["name"] : ""; ?>"> mehr lesen... </a>
              </p>
            </section>
          <?php endforeach;?>
        <?php else: ?>
          <h2>Keine Parteien verfügbar</h2>
        <?php endif; ?>
      </section>

      <!-- container for politics information -->
      <section class="informations">
        <h2>Kommunalpolitik</h2>
        <div>
          <img width="300" height="200" src="../../other/tutorial/pictureDummy.png" alt = "Bild zu Kommunalpolitik">
          <p>
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
          </p>
        </div>
        <div>
          <img width="300" height="200" src="../../other/tutorial/pictureDummy.png" alt = "Bild zu Kommunalpolitik">
          <p>
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
          </p>
        </div>
      </section>
    </main>

    <!-- footer -->
    <?php
    include_once "../../components/footer/footer.php"
    ?>
  </body>
</html>