<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="../../../css/main.css">
  <link rel="stylesheet" type="text/css" href="politicsOverview.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    include "../../components/header/header.php"
    ?>


    <!-- main content -->
    <main>
      <!-- container for parliament and party information -->
      <section class="parties">
        <h2>Aktuelles Parlament</h2>
        <!-- parliament -->
        <section class="parliament">
          <h3>Sitzverteilung</h3>
          <img width="300" height="200" src="../../../images/site/pictureDummy.png" alt="Bild zur Sitzverteilung des Parlaments">
        </section>
        <!-- parties -->

      </section>
      <section class="partyOverviewContainer">
        <section class="partyEntry">
          <img width="150" height="100" src="../media/partyDummy.png" alt="Bild von Partei 1">
          <h3>Partei 1</h3>
          <p>
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem
            <a href="../party/party.php"> mehr lesen... </a>
          </p>
        </section>
        <section class="partyEntry">
          <img width="150" height="100" src="../media/partyDummy.png" alt="Bild von Partei 1">
          <h3>Partei 2</h3>
          <p>
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem
            <a href="../party/party.php"> mehr lesen... </a>
          </p>
        </section>
        <section class="partyEntry">
          <img width="150" height="100" src="../media/partyDummy.png" alt="Bild von Partei 1">
          <h3>Partei 3</h3>
          <p>
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem
            <a href="../party/party.php"> mehr lesen... </a>
          </p>
        </section>
      </section>

      <!-- container for politics information -->
      <section class="informations">
        <h2>Kommunalpolitik</h2>
        <div>
          <img width="300" height="200" src="../../../images/site/pictureDummy.png" alt = "Bild zu Kommunalpolitik">
          <p>
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
          </p>
        </div>
        <div>
          <img width="300" height="200" src="../../../images/site/pictureDummy.png" alt = "Bild zu Kommunalpolitik">
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