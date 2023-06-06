<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <link rel="stylesheet" type="text/css" href="sites/main.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
  <body>
    <!-- header -->
    <?php
    $projectPath = "";
    include_once "sites/components/header/header.php"
    ?>

    <!-- main content -->
    <main>
      <h1>Willkommen auf der Website von der Stadt Neu Dorias</h1>
      <p>
        Auf dieser Seite können finden aktuelle Nachrichten für Ihre Kommune. Sie können sich hier mit anderen
        Einwohnern austauschen, gemeinsam politische Themen diskutieren und sich auch die aktuelle Lage ihrer
        Kommunalpolitik ansehen.
        Für die aktuellen Nachrichten klicken Sie <a href="sites/news/overview/newsOverview.php">hier</a>.
      </p>
    </main>

    <!-- footer -->
    <?php
    $projectPath = "";
    include_once "sites/components/footer/footer.php"
    ?>
  </body>
</html>