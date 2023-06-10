<?php
session_start();

if (isset($_GET["logout"])) {
  unset($_SESSION["userId"]);
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>KomPol</title>
  <?php foreach ($this->stylesheets as $path):?>
  <link rel="stylesheet" type="text/css" href="<?php echo $path ?>">
  <?php endforeach; ?>
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<header>
    <div class="header">
        <div class="cityName">
            <a href="?view=newsOverview">
                <img width="80" height="80"
                     src = "sites/components/header/neuDoriasLogo.png"
                     alt = "Wappen von Neu Dorias">
                <h1>Neu Dorias</h1>
            </a>
        </div>
        <input id="menu-toggle" type="checkbox" />
        <label class='menu-button-container' for="menu-toggle">
            <div class='menu-button'><p>X</p></div>
        </label>
        <div class="authentication">
            <?php if(isset($_SESSION["userId"])): ?>
            <form action="?logout=true" method="post">
              <input type="submit" id="logoutButton" value="Abmelden">
            </form>
            <a href="?view=editProfile">
                <img width="24" height="24" src="sites/components/header/login.svg" alt = "Anmeldungs-Icon">
                <p>Nutzer bearbeiten</p>
            </a>
            <?php else: ?>
            <a href="?view=login">
                <img width="24" height="24" src="sites/components/header/login.svg" alt = "Anmeldungs-Icon">
                <p>Anmelden</p>
            </a>

            <?php endif; ?>
        </div>
        <nav>
            <a href="?view=newsOverview"> Neuigkeiten </a>
            <a href="?view=forumOverview"> Forum </a>
            <a href="?view=politics"> Kommunalpolitik </a>
            <a href="?view=tutorial"> Hilfe </a>
        </nav>
    </div>
</header>
<body>
