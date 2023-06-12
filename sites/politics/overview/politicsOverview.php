<main>
  <!-- container for parliament and party information -->
  <section class="parties">
    <h2>Aktuelles Parlament</h2>
    <!-- parliament -->
    <section class="parliament">
      <h3>Sitzverteilung</h3>
      <img width="300" height="200" src="sites/other/tutorial/pictureDummy.png" alt="Bild zur Sitzverteilung des Parlaments">
    </section>
    <!-- parties -->

  </section>
  <section class="partyOverviewContainer">
    <?php if ($this->data["showParties"]): ?>
      <?php foreach ($this->data["partyList"] as $party): ?>
        <section class="partyEntry">
          <img width="150"
               height="100"
               src="<?php echo $party["logo"] ?>"
               alt="Bild von <?php echo $party["name"] ?>">
          <h3><?php echo $party["name"] ?></h3>
          <p>
			  <?php echo $party["text"] ?>
            <a href="?view=party&name=<?php echo $party["name"] ?>"> mehr lesen... </a>
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
      <img width="300" height="200" src="sites/other/tutorial/pictureDummy.png" alt = "Bild zu Kommunalpolitik">
      <p>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
        At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
        At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
      </p>
    </div>
    <div>
      <img width="300" height="200" src="sites/other/tutorial/pictureDummy.png" alt = "Bild zu Kommunalpolitik">
      <p>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
        At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
        At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
      </p>
    </div>
  </section>
</main>